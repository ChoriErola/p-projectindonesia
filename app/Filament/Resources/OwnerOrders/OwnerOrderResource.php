<?php

namespace App\Filament\Resources\OwnerOrders;

use App\Filament\Resources\OwnerOrders\Pages\ListOwnerOrders;
use App\Filament\Resources\OwnerOrders\Pages\ViewOwnerOrder;
use App\Models\Order;
use BackedEnum;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class OwnerOrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInbox;
    protected static ?string $recordTitleAttribute = 'order_code';
    protected static ?string $navigationLabel = 'Pesanan Masuk';
    protected static ?string $pluralLabel = 'Pesanan Masuk';
    protected static string|UnitEnum|null $navigationGroup = 'Pesanan';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('order_code')
                    ->label('Kode Order')
                    ->searchable()
                    ->copyable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('customer.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('acara')
                    ->label('Acara')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('package.name')
                    ->label('Paket')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('event_date')
                    ->label('Tanggal Acara')
                    ->dateTime('d M Y')
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Pemesanan')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('status')
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
                    })
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('total_price')
                    ->label('Total Harga')
                    ->formatStateUsing(fn ($state) =>
                        'Rp ' . number_format($state, 0, ',', '.')
                    )
                    ->sortable(),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'paid in progress' => 'Pembayaran Diproses',
                        'paid completed' => 'Pembayaran Selesai',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                    ])
                    ->label('Filter Status'),
            ])
            ->actions([
                ViewAction::make(),
            ])
            ->bulkActions([])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOwnerOrders::route('/'),
            'view' => ViewOwnerOrder::route('/{record}'),
        ];
    }

    public static function canViewAny(): bool
    {
        return Auth::check() && Auth::user()->role === 'pemilik';
    }
}
