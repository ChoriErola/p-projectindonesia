<?php

namespace App\Filament\Resources\OwnerOrders\Pages;

use App\Filament\Resources\OwnerOrders\OwnerOrderResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListOwnerOrders extends ListRecords
{
    protected static string $resource = OwnerOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // No create action for owner
        ];
    }

    public static function canAccess(array $parameters = []): bool
    {
        return Auth::check() && Auth::user()->role === 'pemilik';
    }
}
