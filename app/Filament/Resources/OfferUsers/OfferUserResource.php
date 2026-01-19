<?php

namespace App\Filament\Resources\OfferUsers;

use App\Filament\Resources\OfferUsers\Pages\CreateOfferUser;
use App\Filament\Resources\OfferUsers\Pages\EditOfferUser;
use App\Filament\Resources\OfferUsers\Pages\ListOfferUsers;
use App\Filament\Resources\OfferUsers\Schemas\OfferUserForm;
use App\Filament\Resources\OfferUsers\Tables\OfferUsersTable;
use App\Models\OfferUser;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OfferUserResource extends Resource
{
    protected static ?string $model = OfferUser::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'OfferUser';

    public static function form(Schema $schema): Schema
    {
        return OfferUserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OfferUsersTable::configure($table);
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
            'index' => ListOfferUsers::route('/'),
            'create' => CreateOfferUser::route('/create'),
            'edit' => EditOfferUser::route('/{record}/edit'),
        ];
    }
}
