<?php

namespace App\Filament\Resources\StoreReports\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class StoreReportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([ 
                TextColumn::make('name')
                ->label("Name")
                ->searchable()
                ->sortable(),
                TextColumn::make('count')
                ->label("Quantity")
                ->searchable()
                ->sortable(),
                TextColumn::make('price')
                ->label("Price")
                ->searchable()
                ->sortable(),
                TextColumn::make('coast')
                ->label("Cost")
                ->searchable()
                ->sortable(),
                TextColumn::make('total_price')
                ->label("Total Price") 
                ->state(function ($record) {
                    return $record->price * $record->count;
                })
                ->searchable()
                ->sortable()
                ->sortable(
                    query: fn ($query, $direction) =>
                        $query->orderByRaw('(price * count) ' . $direction)
                ),
                TextColumn::make('total_cost')
                ->label("Total Cost") 
                ->state(function ($record) {
                    return $record->price * $record->count;
                })
                ->searchable()
                ->sortable()
                ->sortable(
                    query: fn ($query, $direction) =>
                        $query->orderByRaw('(coast * count) ' . $direction)
                ),
            ])
            ->filters([
                //
            ])
            ->recordActions([ 
            ]);
    }
}
