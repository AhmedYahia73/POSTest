<?php

namespace App\Filament\Resources\OfferSuppliers;

use App\Filament\Resources\OfferSuppliers\Pages\CreateOfferSupplier;
use App\Filament\Resources\OfferSuppliers\Pages\EditOfferSupplier;
use App\Filament\Resources\OfferSuppliers\Pages\ListOfferSuppliers;
use App\Filament\Resources\OfferSuppliers\Schemas\OfferSupplierForm;
use App\Filament\Resources\OfferSuppliers\Tables\OfferSuppliersTable;
use App\Models\OfferSupplier;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OfferSupplierResource extends Resource
{
    protected static ?string $model = OfferSupplier::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'OfferSupplier';

    public static function form(Schema $schema): Schema
    {
        return OfferSupplierForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OfferSuppliersTable::configure($table);
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
            'index' => ListOfferSuppliers::route('/'),
            'create' => CreateOfferSupplier::route('/create'),
            'edit' => EditOfferSupplier::route('/{record}/edit'),
        ];
    }
}
