<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                ->label("Category Name")
                ->required() 
                ->placeholder('Enter Category'), 
                Textarea::make('description')
                ->placeholder('Enter description')
                ->rows(4),
                FileUpload::make('image')
                ->label('Category Image')
                ->image()
                ->required()
                ->disk('public')
                ->directory('categories')
                ->placeholder('Upload Category image'),
            ]);
    }
}
