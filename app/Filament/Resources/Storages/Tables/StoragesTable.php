<?php

namespace App\Filament\Resources\Storages\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class StoragesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->label("Name")
                ->searchable()
                ->sortable(),
                TextColumn::make('main')
                ->label("Main Storage")
                ->searchable()
                ->sortable()
                ->getStateUsing(function ($record) {
                    return $record->main ? "Main" : "Sub";
                }),
                TextColumn::make('branch.name')
                ->label("Branch")
                ->searchable()
                ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([ 
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
