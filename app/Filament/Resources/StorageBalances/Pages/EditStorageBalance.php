<?php

namespace App\Filament\Resources\StorageBalances\Pages;

use App\Filament\Resources\StorageBalances\StorageBalanceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStorageBalance extends EditRecord
{
    protected static string $resource = StorageBalanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
