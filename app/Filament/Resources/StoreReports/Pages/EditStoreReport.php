<?php

namespace App\Filament\Resources\StoreReports\Pages;

use App\Filament\Resources\StoreReports\StoreReportResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStoreReport extends EditRecord
{
    protected static string $resource = StoreReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
