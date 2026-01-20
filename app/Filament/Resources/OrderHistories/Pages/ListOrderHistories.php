<?php

namespace App\Filament\Resources\OrderHistories\Pages;

use App\Filament\Resources\OrderHistories\OrderHistoriesResource;
use App\Models\Order;
use App\Models\OrderHistories;
use App\Models\User;
use Filament\Actions\CreateAction;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ListOrderHistories extends ListRecords
{
    protected static string $resource = OrderHistoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('exportHistories')
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
                            'by_order' => 'Pesanan',
                            'by_status' => 'Status',
                            'by_user' => 'Pelanggan',
                        ])
                        ->required()
                        ->default('all'),

                    Select::make('order_ids')
                        ->label('Filter Pesanan (Opsional)')
                        ->multiple()
                        ->searchable()
                        ->preload()
                        ->options(function () {
                            return Order::with('customer')
                                ->get()
                                ->mapWithKeys(function ($order) {
                                    return [$order->id => $order->order_code . ' - ' . ($order->customer->name ?? 'N/A')];
                                });
                        }),

                    // Select::make('user_ids')
                    //     ->label('Filter Pelanggan (Opsional)')
                    //     ->multiple()
                    //     ->searchable()
                    //     ->preload()
                    //     ->options(function () {
                    //         $userIds = OrderHistories::query()
                    //             ->distinct('changed_by')
                    //             ->pluck('changed_by');
                    //         return User::whereIn('id', $userIds)
                    //             ->pluck('name', 'id');
                    //     }),
                ])
                ->action(function (array $data) {
                    return $this->exportPdf($data);
                }),
            // CreateAction::make(),
        ];
    }

    protected function exportPdf(array $data)
    {
        $start = Carbon::parse($data['start_date'])->startOfDay();
        $end = Carbon::parse($data['end_date'])->endOfDay();
        $exportType = $data['export_type'];

        $query = OrderHistories::with(['order', 'changer'])
            ->whereBetween('created_at', [$start, $end]);

        // Apply order filter if selected
        if (!empty($data['order_ids'])) {
            $query->whereIn('order_id', $data['order_ids']);
        }

        // Apply user filter if selected
        if (!empty($data['user_ids'])) {
            $query->whereIn('changed_by', $data['user_ids']);
        }

        $histories = $query->orderBy('created_at', 'desc')->get();

        $summary = [
            'total_changes' => $histories->count(),
            'total_orders_affected' => $histories->groupBy('order_id')->count(),
            'status_changes' => [
                'confirmed' => $histories->where('new_status', 'confirmed')->count(),
                'paid_in_progress' => $histories->where('new_status', 'paid in progress')->count(),
                'paid_completed' => $histories->where('new_status', 'paid completed')->count(),
                'completed' => $histories->where('new_status', 'completed')->count(),
                'cancelled' => $histories->where('new_status', 'cancelled')->count(),
            ],
        ];

        $reportData = match ($exportType) {
            'by_order' => $this->summarizeByOrder($histories),
            'by_status' => $this->summarizeByStatus($histories),
            'by_user' => $this->summarizeByUser($histories),
            default => ['histories' => $histories],
        };

        // Get order and user names if filter is applied
        $selectedOrderNames = [];
        $selectedUserNames = [];
        
        if (!empty($data['order_ids'])) {
            $selectedOrderNames = Order::whereIn('id', $data['order_ids'])
                ->pluck('order_code')
                ->toArray();
        }

        if (!empty($data['user_ids'])) {
            $selectedUserNames = User::whereIn('id', $data['user_ids'])
                ->pluck('name')
                ->toArray();
        }

        $pdf = Pdf::loadView('pdf.order-histories', [
            'start_date' => $start->translatedFormat('d F Y'),
            'end_date' => $end->translatedFormat('d F Y'),
            'export_type' => $exportType,
            'summary' => $summary,
            'report_data' => $reportData,
            'histories' => $histories,
            'selected_orders' => $selectedOrderNames,
            'selected_users' => $selectedUserNames,
        ]);

        return response()->streamDownload(
            fn () => print($pdf->output()),
            "laporan-riwayat-pesanan-{$start->format('Y-m-d')}-{$end->format('Y-m-d')}.pdf"
        );
    }

    private function summarizeByOrder($histories)
    {
        return $histories->groupBy('order_id')->map(function ($orderHistories) {
            $order = $orderHistories->first()->order;
            return [
                'order_code' => $order->order_code ?? 'N/A',
                'customer_name' => $order->customer->name ?? 'N/A',
                'total_changes' => $orderHistories->count(),
                'histories' => $orderHistories,
            ];
        })->values();
    }

    private function summarizeByStatus($histories)
    {
        $statuses = ['confirmed', 'paid in progress', 'paid completed', 'completed', 'cancelled'];
        $summary = [];

        foreach ($statuses as $status) {
            $statusHistories = $histories->where('new_status', $status);
            if ($statusHistories->isNotEmpty()) {
                $summary[] = [
                    'status' => $this->translateStatus($status),
                    'count' => $statusHistories->count(),
                    'histories' => $statusHistories,
                ];
            }
        }
        return $summary;
    }

    private function summarizeByUser($histories)
    {
        return $histories->groupBy('changed_by')->map(function ($userHistories) {
            $user = $userHistories->first()->changer;
            return [
                'user_name' => $user->name ?? 'N/A',
                'total_changes' => $userHistories->count(),
                'histories' => $userHistories,
            ];
        })->values();
    }

    private function translateStatus($status)
    {
        return match ($status) {
            'confirmed' => 'Belum Bayar',
            'paid in progress' => 'Proses Pembayaran',
            'paid completed' => 'Lunas',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => ucfirst($status),
        };
    }
}

