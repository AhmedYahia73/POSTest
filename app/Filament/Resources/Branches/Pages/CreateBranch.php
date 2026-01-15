<?php

namespace App\Filament\Resources\Branches\Pages;

use App\Filament\Resources\Branches\BranchResource;
use Filament\Resources\Pages\CreateRecord;

use App\Models\Storage;

class CreateBranch extends CreateRecord
{
    protected static string $resource = BranchResource::class;
    
    protected function afterCreate(): void{
        $this->record->refresh();
        $main_storage = Storage::
        where("main", 1)
        ->first();
        if (empty($main_storage)) {
            Storage::
            create([
                'name' => "Main Storage",
                'main' => 1,
            ]);
        }   
        Storage::
        create([
            'name' => "Storage of " . $this->record->name,
            'main' => 0,
            'branch_id' => $this->record->id,
        ]);
    }
}
