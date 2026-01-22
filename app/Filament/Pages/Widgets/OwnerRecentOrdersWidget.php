<?php

namespace App\Filament\Pages\Widgets;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class OwnerRecentOrdersWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    public static function canView(): bool
    {
        return Auth::check() && Auth::user()->role === 'pemilik';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Order::query()->latest()->limit(10))
            ->columns([
                Tables\Columns\TextColumn::make('order_code')
                    ->label('Kode Order')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Customer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('acara')
                    ->label('Acara')
                    ->searchable(),
                Tables\Columns\TextColumn::make('event_date')
                    ->label('Tanggal Acara')
                    ->dateTime('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
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
                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total Harga')
                    ->formatStateUsing(fn ($state) =>
                        'Rp ' . number_format($state, 0, ',', '.')
                    )
                    ->sortable(),
            ])
            ->paginated(false);
    }
}
