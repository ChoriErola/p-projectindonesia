<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

class EditOrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(1)
                ->columnSpanFull()
                ->schema([
                    Section::make('Detail Order')
                        ->schema([
                            Select::make('user_id')
                                ->relationship('customer', 'name')
                                ->label('Customer')
                                ->searchable()
                                ->preload()
                                ->reactive()
                                ->required(),
                            TextInput::make('order_code')
                                ->disabled()
                                ->dehydrated(),
                            DatePicker::make('event_date')
                                ->label('Tanggal Acara')
                                ->required(),
                            Textarea::make('alamat')
                                ->required()
                                ->label('Alamat Acara')
                                ->columnSpanFull(),
                            Textarea::make('notes')
                                ->label('Catatan')  
                                ->columnSpanFull(),
                    ]),
                    Section::make('Paket dan Layanan')
                    ->schema([
                        Select::make('package_id')
                            ->relationship('package', 'name')
                            ->label('Paket')
                            ->searchable()
                            ->preload()
                            ->reactive()
                            ->required()
                            ->afterStateUpdated(function ($state, $set) {
                                if (! $state) {
                                    $set('selected_service_ids', []);
                                    $set('base_price', 0);
                                    $set('total_price', 0);
                                    return;
                                }
                                $package = \App\Models\Package::find($state);
                                if (! $package) {
                                    $set('selected_service_ids', []);
                                    $set('base_price', 0);
                                    $set('total_price', 0);
                                    return;
                                }
                                // default select all services from this package
                                $serviceIds = $package->services->pluck('id')->toArray();
                                $set('selected_service_ids', $serviceIds);

                                // Harga paket asli
                                $packagePrice = (float) ($package->price ?? 0);
                                $set('package_price', $packagePrice);

                                // Hitung unselected (awal = none)
                                $unselectedServices = $package->services->whereNotIn('id', $serviceIds);

                                $unselectedTotal = $unselectedServices->sum(function ($service) {
                                    $pivotPrice = (float) ($service->pivot->value_price ?? 0);

                                    if ($pivotPrice > 0) return $pivotPrice;

                                    return (float) ($service->harga_layanan ?? 0);
                                });

                                $basePrice = max(0, $packagePrice - $unselectedTotal);

                                $set('base_price', $basePrice);
                                $set('total_price', $basePrice);
                            }),

                        // Hanya Layanan yang dipilih
                        CheckboxList::make('all_service_ids')
                            ->label('Layanan (Dipilih)')
                            ->columns(3)
                            ->options(function ($get, $livewire) {
                                $record = $livewire->record;

                                if (! $record || ! $record->exists) {
                                    return [];
                                }
                                return $record->services()
                                    ->pluck('service_name', 'service_id')
                                    ->mapWithKeys(fn ($name, $id) => [(string) $id => $name])
                                    ->toArray();
                                
                            })
                            ->reactive()
                            ->afterStateHydrated(function ($component, $livewire) {
                                $record = $livewire->record;

                                if (! $record || ! $record->exists) {
                                    return;
                                }

                                $component->state(
                                    $record->services()
                                        ->pluck('service_id')
                                        ->map(fn ($id) => (string) $id)
                                        ->toArray()
                                );
                            })
                            ->disabled()
                            ->columnSpanFull()
                            ->visible(fn ($livewire) =>
                                $livewire instanceof \Filament\Resources\Pages\EditRecord
                            ),
                        TextInput::make('base_price')
                            ->label('Harga Paket (Terpilih)')
                            ->numeric()
                            ->prefix('Rp')
                            ->disabled()
                            ->dehydrated()
                            ->columnSpanFull(),

                        TextInput::make('total_price')
                            ->label('Total Harga')
                            ->numeric()
                            ->prefix('Rp')
                            ->disabled()
                            ->dehydrated()
                            ->columnSpanFull(),
                    ]),
                    Section::make('Detail Pembayaran')
                        ->schema([
                            Select::make('status')
                                ->required()
                                    ->options([
                                        'pending' => 'Pending',
                                        'confirmed' => 'Confirmed',
                                        'paid in progress' => 'Paid In Progress',
                                        'paid completed' => 'Paid Completed',
                                        'completed' => 'Completed',
                                        'cancelled' => 'Cancelled',
                                    ]),
                            FileUpload::make('bukti_pembayaran')
                                ->label('Bukti Pembayaran')
                                ->directory('bukti-pembayaran')
                                ->disk('public')
                                ->image()
                                ->panelLayout('grid')
                                ->imageEditor()
                                ->maxSize(2048)
                                ->multiple()
                                ->reorderable() 
                                ->openable()
                                ->nullable()
                                ->downloadable()
                                ->deletable(true)
                                ->columns([
                                    'default'=> 1,
                                ])
                                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/png', 'image/webp'])
                                ->helperText('Upload bukti transfer (JPG / PNG, max 2MB)')
                                ->visible(fn ($livewire) =>
                                    in_array($livewire->record?->status, ['paid in progress'])
                                ),
                    // DP 1 - Selalu muncul (pembayaran pertama)
                    TextInput::make('dp_1_amount')
                        ->label('DP 1 - Uang Muka (40% disarankan)')
                        ->numeric()
                        ->prefix('Rp')
                        ->nullable()
                        ->columnSpanFull()
                        ->reactive()
                        ->helperText('Input ketika pelanggan mengirimkan pembayaran pertama')
                        ->visible(fn ($livewire) =>
                            in_array($livewire->record?->status, [
                                'paid in progress',
                            ])
                        ),
                    
                    // DP 2 - Hanya muncul jika DP 1 sudah ada
                    TextInput::make('dp_2_amount')
                        ->label('DP 2 - Cicilan (30% disarankan)')
                        ->numeric()
                        ->prefix('Rp')
                        ->nullable()
                        ->columnSpanFull()
                        ->reactive()
                        ->helperText('Input ketika pelanggan mengirimkan pembayaran kedua')
                        ->visible(function ($livewire, $get) {
                            // Hanya visible jika status paid in progress dan DP 1 sudah ada
                            if (!in_array($livewire->record?->status, ['paid in progress'])) {
                                return false;
                            }
                            return !empty($get('dp_1_amount'));
                        }),
                    
                    // DP 3 - Hanya muncul jika DP 2 sudah ada
                    TextInput::make('dp_3_amount')
                        ->label('DP 3 - Pelunasan (Sisa pembayaran)')
                        ->numeric()
                        ->prefix('Rp')
                        ->nullable()
                        ->columnSpanFull()
                        ->reactive()
                        ->helperText('Input ketika pelanggan mengirimkan pembayaran terakhir')
                        ->visible(function ($livewire, $get) {
                            // Hanya visible jika status paid in progress, DP 1 dan DP 2 sudah ada
                            if (!in_array($livewire->record?->status, ['paid in progress'])) {
                                return false;
                            }
                            return !empty($get('dp_1_amount')) && !empty($get('dp_2_amount'));
                        }),
                    
                    // Summary pembayaran
                    TextInput::make('total_paid_summary')
                        ->label('Total Pembayaran Diterima')
                        ->numeric()
                        ->prefix('Rp')
                        ->disabled()
                        ->dehydrated(false)
                        ->columnSpanFull()
                        ->reactive()
                        ->formatStateUsing(function ($state, $get) {
                            $dp1 = (float) ($get('dp_1_amount') ?? 0);
                            $dp2 = (float) ($get('dp_2_amount') ?? 0);
                            $dp3 = (float) ($get('dp_3_amount') ?? 0);
                            return $dp1 + $dp2 + $dp3;
                        })
                        ->visible(fn ($livewire) =>
                            in_array($livewire->record?->status, [
                                'paid in progress',
                            ])
                        ),
                    
                    TextInput::make('remaining_payment')
                        ->label('Sisa Pembayaran')
                        ->numeric()
                        ->prefix('Rp')
                        ->disabled()
                        ->dehydrated(false)
                        ->columnSpanFull()
                        ->reactive()
                        ->formatStateUsing(function ($state, $get) {
                            $totalPrice = (float) ($get('total_price') ?? 0);
                            $dp1 = (float) ($get('dp_1_amount') ?? 0);
                            $dp2 = (float) ($get('dp_2_amount') ?? 0);
                            $dp3 = (float) ($get('dp_3_amount') ?? 0);
                            return max(0, $totalPrice - ($dp1 + $dp2 + $dp3));
                        })
                        ->visible(fn ($livewire) =>
                            in_array($livewire->record?->status, [
                                'paid in progress',
                            ])
                        ),
                    ]),
            ]),
        ]);
    }
}
