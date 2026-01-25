<?php

namespace App\Filament\Resources\OwnerOrderReports;

use App\Filament\Resources\OwnerOrderReports\Pages\ListOwnerOrderReports;
use App\Models\Order;
use BackedEnum;
use Carbon\Carbon;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use UnitEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class OwnerOrderReportResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentChartBar;

    protected static ?string $recordTitleAttribute = 'order_code';
    protected static string|UnitEnum|null $navigationGroup = 'Pesanan';
    protected static ?string $navigationLabel = 'Laporan Pesanan';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_code')
                    ->label('Kode Order')
                    ->searchable()
                    ->copyable()
                    ->sortable(),
                TextColumn::make('customer.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('acara')
                    ->label('Acara')
                    ->searchable(),
                TextColumn::make('event_date')
                    ->label('Tanggal Acara')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Tanggal Pemesanan')
                    ->dateTime('d M Y')
                    ->sortable(),
                TextColumn::make('status')
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
                    })
                    ->sortable(),
                TextColumn::make('total_price')
                    ->label('Total Harga')
                    ->formatStateUsing(fn ($state) =>
                        'Rp ' . number_format($state, 0, ',', '.')
                    )
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'paid in progress' => 'Pembayaran Diproses',
                        'paid completed' => 'Pembayaran Selesai',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                    ])
                    ->label('Filter Status'),
                SelectFilter::make('created_at')
                        ->options(function () {
                            $dates = Order::query()
                                ->selectRaw('DATE(created_at) as date')
                                ->distinct()
                                ->orderBy('date', 'desc')
                                ->pluck('date')
                                ->toArray();
    
                            $formattedDates = [];
                            foreach ($dates as $date) {
                                $carbonDate = Carbon::parse($date);
                                $formattedDates[$carbonDate->toDateString()] = $carbonDate->format('d M Y');
                            }
                            return $formattedDates;
                        })
                    ->query(function (Builder $query, $data): Builder {
                        return $query->when(
                            $data['value'] ?? null,
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '=', $date)
                        );
                    })
                    ->label('Tanggal Pemesanan'),
            ])
            ->recordActions([
                \Filament\Actions\ViewAction::make()
                    ->iconButton()
                    ->modalHeading(fn ($record) => 'Detail Pesanan - ' . $record->order_code)
                    ->modalWidth('4xl')
                    ->infolist(\App\Filament\Resources\OwnerOrders\Infolists\OrderDetailsInfolist::configure()),
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
            'index' => ListOwnerOrderReports::route('/'),
        ];
    }

    public static function canViewAny(): bool
    {
        return Auth::check() && Auth::user()->role === 'pemilik';
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }
}
