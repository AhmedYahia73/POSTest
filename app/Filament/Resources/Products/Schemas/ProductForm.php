<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                ->label("Product Name")
                ->required() 
                ->placeholder('Enter Product'), 
                TextInput::make('coast')
                ->label("Product Cost")
                ->required() 
                ->placeholder('Enter Cost'), 
                TextInput::make('price')
                ->label("Product Price")
                ->required() 
                ->placeholder('Enter Price'),
                TextInput::make('points')
                ->label("Product Points")
                ->required() 
                ->default(0)
                ->placeholder('Enter Points'),
                Select::make('branch_id')
                ->label('branch')
                ->required()
                ->preload()
                ->relationship(name: 'branch', titleAttribute: 'name')
                ->placeholder('Select a Branch'),
                Select::make('category_id')
                ->label('category')
                ->required()
                ->preload()
                ->relationship(name: 'category', titleAttribute: 'name')
                ->placeholder('Select a Category'), 
                FileUpload::make('image')
                ->label('Product Image')
                ->image()
                ->required()
                ->disk('public')
                ->directory('products')
                ->placeholder('Upload Product image'),
                Textarea::make('description')
                ->placeholder('Enter Description')
                ->rows(4),
            ]);
    }
}
