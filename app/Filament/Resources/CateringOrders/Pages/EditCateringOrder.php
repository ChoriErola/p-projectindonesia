<?php

namespace App\Filament\Resources\CateringOrders\Pages;

use App\Filament\Resources\CateringOrders\CateringOrderResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\DeleteAction;

class EditCateringOrder extends EditRecord
{
    protected static string $resource = CateringOrderResource::class;

    public function getTitle(): string
    {
        return 'Edit Pesanan Catering';
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
