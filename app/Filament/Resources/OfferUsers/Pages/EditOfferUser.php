<?php

namespace App\Filament\Resources\OfferUsers\Pages;

use App\Filament\Resources\OfferUsers\OfferUserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOfferUser extends EditRecord
{
    protected static string $resource = OfferUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
