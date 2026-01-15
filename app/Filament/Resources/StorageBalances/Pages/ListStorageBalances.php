<?php

namespace App\Filament\Resources\StorageBalances\Pages;

use App\Filament\Resources\StorageBalances\StorageBalanceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStorageBalances extends ListRecords
{
    protected static string $resource = StorageBalanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
