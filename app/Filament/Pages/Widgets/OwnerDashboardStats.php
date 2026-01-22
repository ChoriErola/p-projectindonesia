<?php

namespace App\Filament\Pages\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OwnerDashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_price');
        $paidOrders = Order::whereIn('status', ['paid completed', 'completed'])->count();
        $pendingOrders = Order::where('status', 'confirmed')->count();
        $inProgressOrders = Order::where('status', 'paid in progress')->count();

        return [
            Stat::make('Total Order', $totalOrders)
                ->description('Semua order yang telah dibuat')
                ->icon('heroicon-o-document-text')
                ->color('info'),
            
            Stat::make('Total Pendapatan', 'Rp ' . number_format($totalRevenue, 0, ',', '.'))
                ->description('Total harga dari semua order')
                ->icon('heroicon-o-banknotes')
                ->color('success'),
            
            Stat::make('Order Terbayar', $paidOrders)
                ->description('Order dengan status paid completed / completed')
                ->icon('heroicon-o-check-circle')
                ->color('success'),
            
            Stat::make('Order Pending', $pendingOrders)
                ->description('Order yang baru dikonfirmasi')
                ->icon('heroicon-o-clock')
                ->color('warning'),

            Stat::make('Order Proses', $inProgressOrders)
                ->description('Order dalam proses pembayaran')
                ->icon('heroicon-o-arrow-path')
                ->color('info'),
        ];
    }
}
