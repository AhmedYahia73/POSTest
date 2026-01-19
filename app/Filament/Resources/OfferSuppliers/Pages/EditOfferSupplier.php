<?php

namespace App\Filament\Resources\OfferSuppliers\Pages;

use App\Filament\Resources\OfferSuppliers\OfferSupplierResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOfferSupplier extends EditRecord
{
    protected static string $resource = OfferSupplierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
