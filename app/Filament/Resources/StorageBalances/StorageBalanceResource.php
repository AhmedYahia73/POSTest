<?php

namespace App\Filament\Resources\StorageBalances;

use App\Filament\Resources\StorageBalances\Pages\CreateStorageBalance;
use App\Filament\Resources\StorageBalances\Pages\EditStorageBalance;
use App\Filament\Resources\StorageBalances\Pages\ListStorageBalances;
use App\Filament\Resources\StorageBalances\Schemas\StorageBalanceForm;
use App\Filament\Resources\StorageBalances\Tables\StorageBalancesTable;
use App\Models\StorageBalance;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StorageBalanceResource extends Resource
{
    protected static ?string $model = StorageBalance::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'StorageBalance';

    public static function form(Schema $schema): Schema
    {
        return StorageBalanceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StorageBalancesTable::configure($table);
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
            'index' => ListStorageBalances::route('/'),
            'create' => CreateStorageBalance::route('/create'),
            'edit' => EditStorageBalance::route('/{record}/edit'),
        ];
    }
}
