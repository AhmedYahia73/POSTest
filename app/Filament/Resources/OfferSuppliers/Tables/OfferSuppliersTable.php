<?php

namespace App\Filament\Resources\OfferSuppliers\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class OfferSuppliersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                    TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                    TextColumn::make('supplier')
                    ->searchable()
                    ->sortable(),
                    TextColumn::make('date')
                    ->searchable()
                    ->sortable(), 
                    ToggleColumn::make('status')
                    ->label('Status')
                    ->onColor('success')
                    ->offColor('danger'),
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
