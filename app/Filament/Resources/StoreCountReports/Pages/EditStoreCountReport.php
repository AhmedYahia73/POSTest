<?php

namespace App\Filament\Resources\StoreCountReports\Pages;

use App\Filament\Resources\StoreCountReports\StoreCountReportResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStoreCountReport extends EditRecord
{
    protected static string $resource = StoreCountReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
