<?php

namespace App\Filament\Resources\PointSales\Pages;

use App\Filament\Resources\PointSales\PointSaleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPointSale extends EditRecord
{
    protected static string $resource = PointSaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
