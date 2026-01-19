<?php

namespace App\Filament\Resources\OfferSuppliers\Pages;

use App\Filament\Resources\OfferSuppliers\OfferSupplierResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOfferSuppliers extends ListRecords
{
    protected static string $resource = OfferSupplierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
