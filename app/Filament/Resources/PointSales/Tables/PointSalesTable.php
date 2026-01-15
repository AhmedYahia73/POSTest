<?php

namespace App\Filament\Resources\PointSales\Tables;

use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class PointSalesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([ 
                TextColumn::make('name')
                ->label("Name")
                ->searchable() 
                ->sortable()
                ->url(fn ($record) => url("admin/point_of_sales/" . $record->branch_id))
                ->openUrlInNewTab(), 
                TextColumn::make('branch_id')
                ->label("Branch")
                ->searchable() 
                ->sortable(), 
                TextColumn::make('tax')
                ->label("Tax 14%")
                ->searchable()
                ->getStateUsing(function ($record) {
                    return $record->tax ? "Yes" : "No";
                })
                ->sortable(), 
            ])
            ->actions([
                // زر فتح مخصص
                Action::make('open')
                    ->label('open pos')
                    ->icon('heroicon-o-map-pin')
                    ->color('success')
                    ->url(fn ($record) => url("admin/point_of_sales/" . $record->branch_id))
                    ->openUrlInNewTab(), 
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
