<?php

namespace App\Filament\Resources\StorageBalances\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class StorageBalancesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('storage.name')
                ->label("Storage")
                ->searchable()
                ->sortable(),
                TextColumn::make('product.name')
                ->label("Product")
                ->searchable()
                ->sortable(),
                TextColumn::make('quantity')
                ->label("Quantity")
                ->searchable()
                ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                DeleteAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
