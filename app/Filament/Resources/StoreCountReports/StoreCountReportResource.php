<?php

namespace App\Filament\Resources\StoreCountReports;

use BackedEnum;
use App\Models\Product;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use App\Models\StoreCountReport;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use App\Filament\Resources\StoreCountReports\Pages\EditStoreCountReport;
use App\Filament\Resources\StoreCountReports\Pages\ListStoreCountReports;
use App\Filament\Resources\StoreCountReports\Pages\CreateStoreCountReport;
use App\Filament\Resources\StoreCountReports\Schemas\StoreCountReportForm;
use App\Filament\Resources\StoreCountReports\Tables\StoreCountReportsTable;

class StoreCountReportResource extends Resource
{
    protected static ?string $navigationLabel = 'Store Amount';
    protected static ?string $model = Product::class;
    protected static string|\UnitEnum|null $navigationGroup = 'Reports';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Product';

    public static function form(Schema $schema): Schema
    {
        return StoreCountReportForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StoreCountReportsTable::configure($table);
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
            'index' => ListStoreCountReports::route('/'),
            'create' => CreateStoreCountReport::route('/create'),
            'edit' => EditStoreCountReport::route('/{record}/edit'),
        ];
    }
}
