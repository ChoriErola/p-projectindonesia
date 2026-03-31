<?php

namespace App\Filament\Resources\CateringOrders\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class CateringOrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_code')
                    ->label('Kode Pesanan')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('nama_acara')
                    ->label('Nama Acara')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('nama_pelanggan')
                    ->label('Nama Pelanggan')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('no_hp')
                    ->label('No. HP')
                    ->sortable(),

                TextColumn::make('qty')
                    ->label('Porsi')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('total_harga')
                    ->label('Total Harga')
                    ->formatStateUsing(fn ($state) =>
                        'Rp ' . number_format($state, 0, ',', '.')
                    ),

                ImageColumn::make('bukti_pembayaran')
                    ->label('Bukti Pembayaran')
                    ->disk('public')
                    ->imageHeight(50)
                    ->square()
                    ->toggleable(),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'gray' => 'pending',
                        'info' => 'confirmed',
                        'success' => 'completed',
                        'danger' => 'cancelled',
                    ])
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ]),
                Filter::make('nama_pelanggan')
                    ->form([
                        \Filament\Forms\Components\TextInput::make('nama_pelanggan')
                            ->label('Nama Pelanggan')
                            ->placeholder('Cari nama pelanggan...'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['nama_pelanggan'] ?? null,
                            fn (Builder $query, $value): Builder => $query->whereAny([
                                'nama_pelanggan',
                            ], 'like', "%{$value}%"),
                        );
                    }),
                Filter::make('nama_acara')
                    ->form([
                        \Filament\Forms\Components\TextInput::make('nama_acara')
                            ->label('Nama Acara')
                            ->placeholder('Cari nama acara...'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['nama_acara'] ?? null,
                            fn (Builder $query, $value): Builder => $query->whereAny([
                                'nama_acara',
                            ], 'like', "%{$value}%"),
                        );
                    }),
            ])
            ->actions([
                ViewAction::make()->iconButton(),
                EditAction::make()->iconButton(),
                DeleteAction::make()->iconButton(),

            ])
            // ->bulkActions([
            //     BulkActionGroup::make([
            //         DeleteBulkAction::make(),
            //     ]),
            ->defaultSort('created_at', 'desc');
    }
}
