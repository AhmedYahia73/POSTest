<?php

namespace App\Filament\Resources\Purchases\Pages;

use App\Models\Product;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\ValidationException;
use App\Filament\Resources\Purchases\PurchaseResource;

class CreatePurchase extends CreateRecord
{
    protected static string $resource = PurchaseResource::class;
     
    protected function afterCreate(): void
    {
        foreach ($this->record->products as $item) {
            $product = $item->products;

            $product->increment('count', $item->quantity);
        }
    }
}
