<?php

namespace App\Filament\Resources\Services\Pages;

use App\Filament\Resources\Services\ServicesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListServices extends ListRecords
{
    protected static string $resource = ServicesResource::class;

    public function getTitle(): string
    {
        return 'Layanan';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Buat Layanan'),
        ];
    }
}
