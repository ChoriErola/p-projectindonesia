<?php

namespace App\Filament\Resources\CateringOrders\Pages;

use App\Filament\Resources\CateringOrders\CateringOrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCateringOrder extends CreateRecord
{
    protected static string $resource = CateringOrderResource::class;

    public function getTitle(): string
    {
        return 'Buat Pesanan Catering Baru';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
