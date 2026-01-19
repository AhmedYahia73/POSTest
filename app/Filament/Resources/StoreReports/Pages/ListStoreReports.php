<?php

namespace App\Filament\Resources\StoreReports\Pages;

use App\Filament\Resources\StoreReports\StoreReportResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStoreReports extends ListRecords
{
    protected static string $resource = StoreReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
