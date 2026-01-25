<?php

namespace App\Filament\Resources\OwnerOrders\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms;

class ViewOwnerOrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Order')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Customer')
                            ->relationship('customer', 'name')
                            ->disabled(),

                        Forms\Components\TextInput::make('order_code')
                            ->label('Kode Order')
                            ->disabled(),

                        Forms\Components\DatePicker::make('event_date')
                            ->label('Tanggal Acara')
                            ->disabled(),

                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pending',
                                'confirmed' => 'Confirmed',
                                'paid in progress' => 'Paid | In Progress',
                                'paid completed' => 'Paid | Completed',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                            ])
                            ->disabled(),

                        Forms\Components\Textarea::make('notes')
                            ->label('Catatan')
                            ->disabled()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Paket & Harga (Terpilih)')
                    ->schema([
                        Forms\Components\Select::make('package_id')
                            ->label('Paket')
                            ->relationship('package', 'name')
                            ->disabled(),

                        Forms\Components\TextInput::make('base_price')
                            ->label('Harga Paket (Terpilih)')
                            ->numeric()
                            ->prefix('Rp')
                            ->disabled()
                            ->formatStateUsing(fn ($state) =>
                                $state ? number_format($state, 0, ',', '.') : '0'
                            ),

                        Forms\Components\Textarea::make('all_services_display')
                            ->label('Layanan (Dipilih)')
                            ->disabled()
                            ->rows(8)
                            ->dehydrated(false)
                            ->formatStateUsing(function ($record) {
                                if (! $record || ! $record->exists) return '-';
                                $services = $record->services()->pluck('service_name')->toArray();
                                return ! empty($services) ? implode("\n", $services) : 'Tidak ada layanan terpilih';
                            })
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Detail Pembayaran')
                    ->schema([
                        Forms\Components\TextInput::make('amount_paid')
                            ->label('Pembayaran Diterima')
                            ->numeric()
                            ->prefix('Rp')
                            ->disabled()
                            ->formatStateUsing(fn ($state) =>
                                $state ? number_format($state, 0, ',', '.') : '0'
                            ),

                        Forms\Components\TextInput::make('remaining_payment')
                            ->label('Sisa Pembayaran')
                            ->numeric()
                            ->prefix('Rp')
                            ->disabled()
                            ->dehydrated(false)
                            ->formatStateUsing(function ($state, $get) {
                                $total = (float) ($get('total_price') ?? 0);
                                $paid = (float) ($get('amount_paid') ?? 0);
                                $remaining = max(0, $total - $paid);
                                return $remaining ? number_format($remaining, 0, ',', '.') : '0';
                            }),

                        Forms\Components\FileUpload::make('bukti_pembayaran')
                            ->label('Bukti Pembayaran')
                            ->disk('public')
                            ->image()
                            ->panelLayout('grid')
                            ->multiple()
                            ->openable()
                            ->downloadable()
                            ->disabled()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Lokasi Acara')
                    ->schema([
                        Forms\Components\Textarea::make('alamat')
                            ->label('Alamat Acara')
                            ->rows(4)
                            ->disabled()
                            ->columnSpanFull(),
                    ])->columns(1),

                Section::make('Total Harga')
                    ->schema([
                        Forms\Components\TextInput::make('total_price')
                            ->label('Total')
                            ->numeric()
                            ->prefix('Rp')
                            ->disabled()
                            ->formatStateUsing(fn ($state) =>
                                $state ? number_format($state, 0, ',', '.') : '0'
                            ),
                    ])
                    ->columns(1),            ]);
    }
}