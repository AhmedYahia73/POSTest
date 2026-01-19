<?php

namespace App\Filament\Resources\StoreCountReports\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class StoreCountReportsTable
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
            ])
            ->filters([
                //
            ])
            ->recordActions([ 
            ])
            ->toolbarActions([ 
            ]);
    }
}
