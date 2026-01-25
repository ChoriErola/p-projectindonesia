<?php

namespace App\Filament\Resources\Packages;

use App\Filament\Resources\Packages\Pages\CreatePackages;
use App\Filament\Resources\Packages\Pages\EditPackages;
use App\Filament\Resources\Packages\Pages\ListPackages;
use App\Filament\Resources\Packages\Pages\ViewPackages;
use App\Filament\Resources\Packages\Schemas\PackagesForm;
use App\Filament\Resources\Packages\Tables\PackagesTable;
use App\Models\Package;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class PackagesResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';
    
    protected static string | UnitEnum | null $navigationGroup = 'Paket & Layanan';

    protected static ?string $navigationLabel = 'Data Paket';

    protected static ?string $pluralModelLabel = 'Data Paket';

    public static function form(Schema $schema): Schema
    {
        return PackagesForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PackagesTable::configure($table);
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
            'index' => ListPackages::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        $user = Auth::user();
        // Hanya admin yang bisa buat, owner/pemilik tidak
        return $user && $user->role !== \App\Models\User::ROLE_PEMILIK;
    }

    public static function canEdit(\Illuminate\Database\Eloquent\Model $record): bool
    {
        $user = Auth::user();
        // Hanya admin yang bisa edit, owner/pemilik tidak
        return $user && $user->role !== \App\Models\User::ROLE_PEMILIK;
    }

    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        $user = Auth::user();
        // Hanya admin yang bisa hapus, owner/pemilik tidak
        return $user && $user->role !== \App\Models\User::ROLE_PEMILIK;
    }

    public static function canDeleteAny(): bool
    {
        $user = Auth::user();
        // Hanya admin yang bisa bulk delete, owner/pemilik tidak
        return $user && $user->role !== \App\Models\User::ROLE_PEMILIK;
    }
}
