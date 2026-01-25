<?php

namespace App\Filament\Resources\OwnerOrders\Infolists;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Components\Section;

class OrderDetailsInfolist
{
    public static function configure(): array
    {
        return [
            Section::make('Informasi Pesanan')
                ->schema([
                    TextEntry::make('order_code')
                        ->label('Kode Order'),
                    TextEntry::make('customer.name')
                        ->label('Pelanggan'),
                    TextEntry::make('event_date')
                        ->label('Tanggal Acara')
                        ->date('d M Y'),
                    TextEntry::make('acara')
                        ->label('Nama Acara'),
                    TextEntry::make('alamat')
                        ->label('Alamat'),
                    TextEntry::make('notes')
                        ->label('Catatan Pesanan')
                ])->columns(2),

            Section::make('Paket dan Layanan')
                ->schema([
                    TextEntry::make('package.name')
                        ->label('Paket'),
                    TextEntry::make('total_price')
                        ->label('Total Harga')
                        ->formatStateUsing(fn ($state) =>
                            'Rp ' . number_format($state, 0, ',', '.')
                        ),
                    TextEntry::make('services_display')
                        ->label('Layanan (Dipilih)')
                        ->getStateUsing(function ($record) {
                            if (! $record || ! $record->exists) {
                                return '-';
                            }
                            $services = $record->services()->get();
                            if ($services->isEmpty()) {
                                return 'Tidak ada layanan terpilih';
                            }
                            $serviceList = $services->map(function ($service) {
                                return '• ' . $service->service_name;
                            })->toArray();
                            return implode("\n", $serviceList);
                        })
                        ->columnSpanFull()
                        ->markdown(),
                ])->columns(2),

            Section::make('Detail Pembayaran')
                ->schema([
                    TextEntry::make('status')
                        ->label('Status Order')
                        ->badge()
                        ->color(fn ($state) => match ($state) {
                            'pending' => 'secondary',
                            'confirmed' => 'warning',
                            'paid in progress' => 'info',
                            'paid completed' => 'success',
                            'completed' => 'success',
                            'cancelled' => 'danger',
                            default => 'secondary',
                        }),
                    TextEntry::make('amount_paid')
                        ->label('Pembayaran Diterima')
                        ->formatStateUsing(fn ($state) =>
                            'Rp ' . number_format($state ?? 0, 0, ',', '.')
                        ),
                    TextEntry::make('base_price')
                        ->label('Harga Paket')
                        ->formatStateUsing(fn ($state) =>
                            'Rp ' . number_format($state, 0, ',', '.')
                        ),
                    TextEntry::make('remaining_payment')
                        ->label('Sisa Pembayaran')
                        ->getStateUsing(function ($record) {
                            $total = (float) ($record->total_price ?? 0);
                            $paid = (float) ($record->amount_paid ?? 0);
                            $remaining = max(0, $total - $paid);
                            return 'Rp ' . number_format($remaining, 0, ',', '.');
                        })
                        ->color(fn (string $state): string => match (true) {
                            $state == 'Rp 0' => 'success',
                            default => 'danger',
                        }),
                    TextEntry::make('payment_note')
                        ->label('Catatan Pembayaran')
                        ->columnSpanFull()
                        ->default('-'),
                ])->columns(2),
            Section::make('Bukti Pembayaran')
                ->schema([
                    ImageEntry::make('bukti_pembayaran')
                        ->label('Foto Bukti Pembayaran')
                        ->disk('public')
                        ->columnSpanFull()
                        ->size(300),
                ]),
        ];
    }
}
