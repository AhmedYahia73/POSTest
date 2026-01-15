<?php

namespace App\Filament\Resources\PointSales;

use App\Filament\Resources\PointSales\Pages\CreatePointSale;
use App\Filament\Resources\PointSales\Pages\EditPointSale;
use App\Filament\Resources\PointSales\Pages\ListPointSales;
use App\Filament\Resources\PointSales\Schemas\PointSaleForm;
use App\Filament\Resources\PointSales\Tables\PointSalesTable;
use App\Models\PointSale;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PointSaleResource extends Resource
{
    protected static ?string $model = PointSale::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'PointSale';

    public static function form(Schema $schema): Schema
    {
        return PointSaleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PointSalesTable::configure($table);
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
            'index' => ListPointSales::route('/'),
            'create' => CreatePointSale::route('/create'),
            'edit' => EditPointSale::route('/{record}/edit'),
        ];
    }
}
