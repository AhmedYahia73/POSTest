<?php

namespace App\Filament\Resources\StoreCountReports\Pages;

use App\Filament\Resources\StoreCountReports\StoreCountReportResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStoreCountReports extends ListRecords
{
    protected static string $resource = StoreCountReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
