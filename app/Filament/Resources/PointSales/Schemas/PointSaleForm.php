<?php

namespace App\Filament\Resources\PointSales\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;

class PointSaleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                ->label("POS Name")
                ->required() 
                ->placeholder('Enter POS'), 
                Select::make('branch_id')
                ->label('branch')
                ->required()
                ->preload()
                ->relationship(name: 'branch', titleAttribute: 'name')
                ->placeholder('Select a Branch'),
                Toggle::make('tax')
                ->label('Tax')
                ->required(),
            ]);
    }
}
