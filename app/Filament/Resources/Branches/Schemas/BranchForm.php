<?php

namespace App\Filament\Resources\Branches\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class BranchForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                ->label("Branch Name")
                ->required() 
                ->placeholder('Enter name'), 
                TextInput::make('address')
                ->label("Branch Address")
                ->required() 
                ->placeholder('Enter Address'), 

                FileUpload::make('image')
                ->label('Branch Image')
                ->image()
                ->required()
                ->disk('public')
                ->directory('branches')
                ->placeholder('Upload Branch image'),
            ]);
    }
}
