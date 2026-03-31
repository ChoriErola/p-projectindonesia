<?php

namespace App\Filament\Resources\CateringOrders;

use App\Models\CateringOrder;
use App\Filament\Resources\CateringOrders\Pages\CreateCateringOrder;
use App\Filament\Resources\CateringOrders\Pages\EditCateringOrder;
use App\Filament\Resources\CateringOrders\Pages\ListCateringOrders;
use App\Filament\Resources\CateringOrders\Schemas\CateringOrderForm;
use App\Filament\Resources\CateringOrders\Tables\CateringOrdersTable;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use BackedEnum;
use UnitEnum;
use Illuminate\Support\Facades\Auth;

class CateringOrderResource extends Resource
{
    protected static ?string $model = CateringOrder::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $recordTitleAttribute = 'order_code';
    protected static ?string $pluralLabel = 'Pesanan Catering';
    protected static string|UnitEnum|null $navigationGroup = 'Pesanan';
    protected static ?string $navigationLabel = 'Pesanan Catering';
    protected static ?int $navigationSort = 40;

    public static function form(Schema $schema): Schema
    {
        return CateringOrderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CateringOrdersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCateringOrders::route('/'),
            'create' => CreateCateringOrder::route('/create'),
            'edit' => EditCateringOrder::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return Auth::check() && Auth::user()->role === 'admin';
    }
}
