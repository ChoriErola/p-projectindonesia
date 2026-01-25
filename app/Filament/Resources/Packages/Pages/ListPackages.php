<?php

namespace App\Filament\Resources\Packages\Pages;

use App\Filament\Resources\Packages\PackagesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListPackages extends ListRecords
{
    protected static string $resource = PackagesResource::class;

    public function getTitle(): string
    {
        return 'Paket';
    }

    protected function getHeaderActions(): array
    {
        $user = Auth::user();
        $isPemilik = $user && $user->role === \App\Models\User::ROLE_PEMILIK;

        return [
            CreateAction::make()
                ->label('Buat Paket')
                ->visible(!$isPemilik),
        ];
    }
}
