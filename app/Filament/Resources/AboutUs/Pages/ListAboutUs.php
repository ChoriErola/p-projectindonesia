<?php

namespace App\Filament\Resources\AboutUs\Pages;

use App\Filament\Resources\AboutUs\AboutUsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAboutUs extends ListRecords
{
    protected static string $resource = AboutUsResource::class;

    public function getTitle(): string
    {
        return 'Informasi Perusahaan';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Buat Informasi Perusahaan'),
        ];
    }

    protected function canCreate(): bool
    {
        return \App\Models\AboutUs::count() === 0;
    }

}
