<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([ 
                TextColumn::make('name')
                ->searchable()
                ->sortable(),
                TextColumn::make('coast')
                ->searchable()
                ->sortable(),
                TextColumn::make('price')
                ->searchable()
                ->sortable(),
                TextColumn::make('category.name')
                ->label("Category")
                ->searchable()
                ->sortable(),
                // TextColumn::make('branch.name')
                // ->searchable() 
                // ->label("Branch Name")
                // ->numeric()
                // ->sortable(),  
                ImageColumn::make('image')
                ->label('image')
                ->circular() // لجعل الصورة دائرية (اختياري)
                ->disk('public') // تأكد من مطابقة الـ Disk المستخدم في الـ Upload
                ->width(50) // تحديد عرض الصورة في الجدول
                ->height(50),
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
