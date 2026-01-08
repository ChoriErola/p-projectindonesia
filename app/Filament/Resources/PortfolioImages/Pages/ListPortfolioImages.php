<?php

namespace App\Filament\Resources\PortfolioImages\Pages;

use App\Filament\Resources\PortfolioImages\PortfolioImageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPortfolioImages extends ListRecords
{
    protected static string $resource = PortfolioImageResource::class;

    public function getTitle(): string
    {
        return 'Portofolio';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Buat Portofolio'),
        ];
    }
}
