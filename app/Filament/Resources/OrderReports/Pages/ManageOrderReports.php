<?php

namespace App\Filament\Resources\OrderReports\Pages;

use App\Filament\Resources\OrderReports\OrderReportResource;
use App\Models\Order;
use App\Models\Package;
use App\Models\Services;
use App\Models\User;
use Filament\Actions\CreateAction;
use Filament\Actions\Action;
use Filament\Resources\Pages\ManageRecords;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Support\Icons\Heroicon;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ManageOrderReports extends ManageRecords
{
    protected static string $resource = OrderReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('exportData')
                ->label('Export PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->form([
                    DatePicker::make('start_date')
                        ->label('Tanggal Mulai')
                        ->required()
                        ->default(now()->startOfMonth()),

                    DatePicker::make('end_date')
                        ->label('Tanggal Selesai')
                        ->required()
                        ->default(now()),

                    Select::make('export_type')
                        ->label('Tipe Export')
                        ->options([
                            'all' => 'Semua Data',
                            'by_customer' => 'Pelanggan',
                            'by_service' => 'Paket/Layanan',
                            'by_status' => 'Status',
                        ])
                        ->required()
                        ->default('all'),

                    Select::make('customer_ids')
                        ->label('Filter Pelanggan (Opsional)')
                        ->multiple()
                        ->searchable()
                        ->preload()
                        ->options(fn () => Order::distinct('user_id')
                            ->pluck('user_id')
                            ->mapWithKeys(function ($userId) {
                                $user = User::find($userId);
                                return $user ? [$userId => $user->name] : [];
                            })),

                    Select::make('package_ids')
                        ->label('Filter Paket (Opsional)')
                        ->multiple()
                        ->searchable()
                        ->preload()
                        ->options(fn () => Package::pluck('name', 'id')),

                    Select::make('service_ids')
                        ->label('Filter Layanan (Opsional)')
                        ->multiple()
                        ->searchable()
                        ->preload()
                        ->options(fn () => Services::pluck('name', 'id')),
                ])
                ->action(function (array $data) {
                    return $this->exportPdf($data);
                }),
        ];
    }

    protected function exportPdf(array $data)
    {
        $start = Carbon::parse($data['start_date'])->startOfDay();
        $end = Carbon::parse($data['end_date'])->endOfDay();
        $exportType = $data['export_type'];

        $query = Order::with(['customer', 'package', 'services'])
            ->whereBetween('event_date', [$start, $end]);

        // Apply customer filter if selected
        if (!empty($data['customer_ids'])) {
            $query->whereIn('user_id', $data['customer_ids']);
        }

        // Apply package filter if selected
        if (!empty($data['package_ids'])) {
            $query->whereIn('package_id', $data['package_ids']);
        }

        // Apply service filter if selected
        if (!empty($data['service_ids'])) {
            $query->whereHas('services', function ($q) use ($data) {
                $q->whereIn('service_id', $data['service_ids']);
            });
        }

        $orders = $query->orderBy('event_date', 'desc')->get();

        $summary = [
            'total_orders' => $orders->count(),
            'total_revenue' => $orders->sum('total_price'),
            'paid_completed' => $orders->where('status', 'paid completed')->sum('total_price'),
            'paid_in_progress' => $orders->where('status', 'paid in progress')->sum('total_price'),
            'unpaid' => $orders->where('status', 'confirmed')->sum('total_price'),
        ];

        $reportData = match ($exportType) {
            'by_customer' => $this->summarizeByCustomer($orders),
            'by_service' => $this->summarizeByService($orders),
            'by_status' => $this->summarizeByStatus($orders),
            default => ['orders' => $orders],
        };

        // Get customer names if filter is applied
        $selectedCustomerNames = [];
        if (!empty($data['customer_ids'])) {
            $selectedCustomerNames = User::whereIn('id', $data['customer_ids'])
                ->pluck('name')
                ->toArray();
        }

        $pdf = Pdf::loadView('pdf.order-report', [
            'start_date' => $start->translatedFormat('d F Y'),
            'end_date' => $end->translatedFormat('d F Y'),
            'export_type' => $exportType,
            'summary' => $summary,
            'report_data' => $reportData,
            'orders' => $orders,
            'selected_customers' => $selectedCustomerNames,
        ]);

        return response()->streamDownload(
            fn () => print($pdf->output()),
            "laporan-pesanan-{$start->format('Y-m-d')}-{$end->format('Y-m-d')}.pdf"
        );
    }

    private function summarizeByCustomer($orders)
    {
        return $orders->groupBy('user_id')->map(function ($customerOrders) {
            $customer = $customerOrders->first()->customer;
            return [
                'customer_name' => $customer->name,
                'customer_phone' => $customer->phone ?? '-',
                'total_orders' => $customerOrders->count(),
                'total_amount' => $customerOrders->sum('total_price'),
                'orders' => $customerOrders,
            ];
        })->values();
    }

    private function summarizeByService($orders)
    {
        $summary = [];
        foreach ($orders as $order) {
            $packageName = $order->package->name ?? 'N/A';
            if (!isset($summary[$packageName])) {
                $summary[$packageName] = [
                    'package_name' => $packageName,
                    'total_orders' => 0,
                    'total_amount' => 0,
                    'orders' => [],
                ];
            }
            $summary[$packageName]['total_orders']++;
            $summary[$packageName]['total_amount'] += $order->total_price;
            $summary[$packageName]['orders'][] = $order;
        }
        return array_values($summary);
    }

    private function summarizeByStatus($orders)
    {
        $statuses = ['confirmed', 'paid in progress', 'paid completed', 'completed', 'cancelled'];
        $summary = [];

        foreach ($statuses as $status) {
            $statusOrders = $orders->where('status', $status);
            if ($statusOrders->isNotEmpty()) {
                $summary[] = [
                    'status' => $this->translateStatus($status),
                    'count' => $statusOrders->count(),
                    'total_amount' => $statusOrders->sum('total_price'),
                    'orders' => $statusOrders,
                ];
            }
        }
        return $summary;
    }

    private function translateStatus($status)
    {
        return match ($status) {
            'confirmed' => 'Unpaid / Confirmed',
            'paid in progress' => 'Paid In Progress',
            'paid completed' => 'Paid Completed',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            default => ucfirst($status),
        };
    }

    public function getTitle(): string
    {
        return 'Laporan Pesanan';
    }
}
