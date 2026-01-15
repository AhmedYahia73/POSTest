<?php

namespace App\Filament\Resources\PointSales\Pages;

use App\Filament\Resources\PointSales\PointSaleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPointSales extends ListRecords
{
    protected static string $resource = PointSaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
