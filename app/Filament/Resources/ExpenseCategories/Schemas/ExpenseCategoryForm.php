<?php

namespace App\Filament\Resources\ExpenseCategories\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class ExpenseCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
        ->components([
            TextInput::make('name')
            ->label("Category Name")
            ->required() 
            ->placeholder('Enter Category Name'), 
        ]);
    }
}
