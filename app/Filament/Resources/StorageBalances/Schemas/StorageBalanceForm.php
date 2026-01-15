<?php

namespace App\Filament\Resources\StorageBalances\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class StorageBalanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('storage_id')
                ->label('Storage')
                ->required()
                ->preload()
                ->relationship(name: 'storage', titleAttribute: 'name')
                ->placeholder('Select a Storage'),
                Select::make('product_id')
                ->label('Product')
                ->required()
                ->preload()
                ->relationship(name: 'product', titleAttribute: 'name')
                ->placeholder('Select a Product'),
                TextInput::make('quantity')
                ->label("Quantity")
                ->required()
                ->numeric(),
            ]);
    }
}
