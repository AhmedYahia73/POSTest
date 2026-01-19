<?php

namespace App\Filament\Resources\Purchases\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class PurchasesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice_number')
                ->searchable()
                ->sortable(),   
                ImageColumn::make('image')
                ->label('image')
                ->circular()
                ->disk('public')
                ->width(50)
                ->height(50),
                TextColumn::make('supplier')
                ->searchable()
                ->sortable(), 
                TextColumn::make('date')
                ->searchable()
                ->sortable(),  
                TextColumn::make('total')
                ->searchable()
                ->sortable(),  
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
