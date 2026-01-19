<?php

namespace App\Filament\Resources\OfferUsers\Pages;

use App\Filament\Resources\OfferUsers\OfferUserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOfferUsers extends ListRecords
{
    protected static string $resource = OfferUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
