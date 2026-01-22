<?php

namespace App\Filament\Resources\OwnerOrders\Pages;

use App\Filament\Resources\OwnerOrders\OwnerOrderResource;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Auth;

class ViewOwnerOrder extends ViewRecord
{
    protected static string $resource = OwnerOrderResource::class;

    public static function canAccess(array $parameters = []): bool
    {
        return Auth::check() && Auth::user()->role === 'pemilik';
    }
}
