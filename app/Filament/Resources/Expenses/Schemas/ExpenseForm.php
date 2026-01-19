<?php

namespace App\Filament\Resources\Expenses\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class ExpenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
        ->components([
            
            Select::make('category_id')
            ->label('Category')
            ->required()
            ->preload()
            ->relationship(name: 'category', titleAttribute: 'name')
            ->placeholder('Select a Category'),
            Select::make('branch_id')
            ->label('branch')
            ->required()
            ->preload()
            ->relationship(name: 'branch', titleAttribute: 'name')
            ->placeholder('Select a Branch'),
            Textarea::make('description')
            ->placeholder('Enter description')
            ->rows(4),
            TextInput::make('price')
            ->label("Price")
            ->numeric() 
            ->required() 
            ->placeholder('Enter Price'),
        ]);
    }
}
