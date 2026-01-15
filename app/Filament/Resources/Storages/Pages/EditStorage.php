<?php

namespace App\Filament\Resources\Storages\Pages;

use App\Filament\Resources\Storages\StorageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStorage extends EditRecord
{
    protected static string $resource = StorageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
