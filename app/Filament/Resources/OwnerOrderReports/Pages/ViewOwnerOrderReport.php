<?php

namespace App\Filament\Resources\OwnerOrderReports\Pages;

use App\Filament\Resources\OwnerOrderReports\OwnerOrderReportResource;
use App\Filament\Resources\OwnerOrders\Schemas\ViewOwnerOrderForm;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class ViewOwnerOrderReport extends ViewRecord
{
    protected static string $resource = OwnerOrderReportResource::class;

    public function form(Schema $schema): Schema
    {
        return ViewOwnerOrderForm::configure($schema);
    }

    public static function canAccess(array $parameters = []): bool
    {
        return Auth::check() && Auth::user()->role === 'pemilik';
    }
}
