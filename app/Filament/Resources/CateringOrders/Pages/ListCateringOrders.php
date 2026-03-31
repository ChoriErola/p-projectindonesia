<?php

namespace App\Filament\Resources\CateringOrders\Pages;

use App\Filament\Resources\CateringOrders\CateringOrderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCateringOrders extends ListRecords
{
    protected static string $resource = CateringOrderResource::class;

    public function getTitle(): string
    {
        return 'Pesanan Catering';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Buat Pesanan Catering'),
        ];
    }
}
