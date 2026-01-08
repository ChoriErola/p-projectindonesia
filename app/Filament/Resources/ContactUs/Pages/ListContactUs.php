<?php

namespace App\Filament\Resources\ContactUs\Pages;

use App\Filament\Resources\ContactUs\ContactUsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContactUs extends ListRecords
{
    protected static string $resource = ContactUsResource::class;

    public function getTitle(): string
    {
        return 'Kontak';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Buat Kontak'),
        ];
    }
}
