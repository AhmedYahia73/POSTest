<?php

namespace App\Filament\Resources\StoreReports;

use BackedEnum;
use App\Models\Product;
use Filament\Tables\Table;
use App\Models\StoreReport;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use App\Filament\Resources\StoreReports\Pages\EditStoreReport;
use App\Filament\Resources\StoreReports\Pages\ListStoreReports;
use App\Filament\Resources\StoreReports\Pages\CreateStoreReport;
use App\Filament\Resources\StoreReports\Schemas\StoreReportForm;
use App\Filament\Resources\StoreReports\Tables\StoreReportsTable;

class StoreReportResource extends Resource
{
    protected static ?string $navigationLabel = 'Store Reports';
    protected static string|\UnitEnum|null $navigationGroup = 'Reports';
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Product';

    public static function form(Schema $schema): Schema
    {
        return StoreReportForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StoreReportsTable::configure($table);
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
            'index' => ListStoreReports::route('/'),
            'create' => CreateStoreReport::route('/create'),
            'edit' => EditStoreReport::route('/{record}/edit'),
        ];
    }
}
