<?php

namespace App\Filament\Resources\CateringOrders\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use App\Models\User;
use Illuminate\Support\Str;

class CateringOrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('order_code')
                    ->label('Kode Pesanan')
                    ->default(fn () => 'CAT-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6)))
                    ->disabled()
                    ->dehydrated()
                    ->columnSpanFull(),

                Select::make('user_id')
                    ->label('Pelanggan Terdaftar')
                    ->relationship('user', 'name')
                    ->options(User::where('role', 'pelanggan')->pluck('name', 'id'))
                    ->searchable()
                    ->preload()
                    ->reactive()
                    ->placeholder('Pilih pelanggan atau biarkan kosong untuk input manual')
                    ->helperText('Jika dipilih, nama, alamat, dan no. HP akan otomatis terisi')
                    ->columnSpan(['md' => 2])
                    ->afterStateUpdated(function ($state, $set) {
                        if ($state) {
                            $user = User::find($state);
                            if ($user) {
                                $set('nama_pelanggan', $user->name);
                                $set('no_hp', $user->no_hp);
                                $set('alamat', $user->alamat);
                                $set('code_pelanggan', $user->id);
                            }
                        }
                    }),

                TextInput::make('nama_acara')
                    ->label('Nama Acara')
                    ->maxLength(50)
                    ->required()
                    ->columnSpan(['md' => 2]),

                TextInput::make('nama_pelanggan')
                    ->label('Nama Pelanggan')
                    ->maxLength(50)
                    ->required()
                    ->helperText('Otomatis terisi jika memilih pelanggan terdaftar')
                    ->columnSpan(['md' => 2]),

                TextInput::make('code_pelanggan')
                    ->label('Code Pelanggan')
                    ->placeholder('Otomatis dari ID pelanggan terdaftar')
                    ->columnSpan(['md' => 1]),

                TextInput::make('no_hp')
                    ->label('No. HP')
                    ->tel()
                    ->maxLength(15)
                    ->required()
                    ->helperText('Otomatis terisi jika memilih pelanggan terdaftar')
                    ->columnSpan(['md' => 1]),

                Textarea::make('alamat')
                    ->label('Alamat')
                    ->required()
                    ->rows(3)
                    ->helperText('Otomatis terisi jika memilih pelanggan terdaftar')
                    ->columnSpanFull(),

                TextInput::make('qty')
                    ->label('Jumlah Porsi')
                    ->numeric()
                    ->minValue(50)
                    ->maxValue(2000)
                    ->required()
                    ->reactive()
                    ->columnSpan(['md' => 1])
                    ->afterStateUpdated(function ($get, $set) {
                        $qty = $get('qty');
                        $hargaPerPorsi = $get('harga_per_porsi') ?? 25000;
                        
                        // Minimum 50 porsi
                        $effectiveQty = max(50, $qty ?? 50);
                        $totalHarga = $effectiveQty * $hargaPerPorsi;
                        
                        $set('total_harga', $totalHarga);
                    }),

                TextInput::make('harga_per_porsi')
                    ->label('Harga per Porsi (Rp)')
                    ->numeric()
                    ->minValue(25000)
                    ->default(25000)
                    ->required()
                    ->reactive()
                    ->prefix('Rp')
                    ->columnSpan(['md' => 1])
                    ->afterStateUpdated(function ($get, $set) {
                        $qty = $get('qty') ?? 50;
                        $hargaPerPorsi = $get('harga_per_porsi');
                        
                        // Minimum 50 porsi
                        $effectiveQty = max(50, $qty);
                        $totalHarga = $effectiveQty * $hargaPerPorsi;
                        
                        $set('total_harga', $totalHarga);
                    }),

                TextInput::make('total_harga')
                    ->label('Total Harga (Rp)')
                    ->numeric()
                    ->disabled()
                    ->dehydrated()
                    ->prefix('Rp')
                    ->columnSpan(['md' => 2])
                    ->helperText('Otomatis dihitung - Minimum 50 porsi @ Rp 25.000')
                    ->live(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('pending')
                    ->required()
                    ->reactive()
                    ->columnSpan(['md' => 1]),

                FileUpload::make('bukti_pembayaran_view')
                    ->label('Bukti Pembayaran Dari Pelanggan (Read-Only)')
                    ->disk('public')
                    ->image()
                    ->panelLayout('grid')
                    ->multiple()
                    ->disabled()
                    ->dehydrated(false)
                    ->default(fn ($record) => $record?->bukti_pembayaran ?? [])
                    ->visible(fn ($record) => $record && $record->bukti_pembayaran && count($record->bukti_pembayaran ?? []) > 0)
                    ->columnSpanFull(),

                FileUpload::make('bukti_pembayaran')
                    ->label('Bukti Pembayaran (Admin Upload/Edit)')
                    ->disk('public')
                    ->directory('bukti-pembayaran-catering')
                    ->image()
                    ->panelLayout('grid')
                    ->imageEditor()
                    ->maxSize(2048)
                    ->multiple()
                    ->reorderable()
                    ->openable()
                    ->downloadable()
                    ->deletable(true)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->helperText('Upload atau ubah bukti pembayaran (JPG / PNG / WEBP, max 2MB per file)')
                    ->visible(fn ($get) => $get('status') === 'confirmed')
                    ->columnSpanFull(),

                Textarea::make('catatan')
                    ->label('Catatan')
                    ->rows(3)
                    ->placeholder('Catatan atau permintaan khusus')
                    ->columnSpanFull(),
            ]);
    }
}
