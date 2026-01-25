<?php

namespace App\Filament\Resources\Services\Pages;

use App\Filament\Resources\Services\ServicesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListServices extends ListRecords
{
    protected static string $resource = ServicesResource::class;

    public function getTitle(): string
    {
        return 'Layanan';
    }

    protected function getHeaderActions(): array
    {
        $user = Auth::user();
        $isPemilik = $user && $user->role === \App\Models\User::ROLE_PEMILIK;

        return [
            CreateAction::make()
                ->label('Buat Layanan')
                ->visible(!$isPemilik),
        ];
    }
}
