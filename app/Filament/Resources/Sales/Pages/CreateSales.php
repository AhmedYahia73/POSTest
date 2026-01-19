<?php

namespace App\Filament\Resources\Sales\Pages;

use App\Models\Product;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\ValidationException;
use App\Filament\Resources\Sales\SalesResource;

class CreateSales extends CreateRecord
{
    protected static string $resource = SalesResource::class;
    
    protected function beforeCreate(): array
    {
        foreach ($this->data['Products'] as $index => $item) {
            $product = Product::find($item['product_id']);

            if (! $product) {
                continue;
            }

            if ($product->count < $item['quantity']) {
                Notification::make()
                    ->title('Insufficient stock')
                    ->body("Product {$product->name} has only {$product->count} items left.")
                    ->danger()
                    ->send();
                throw ValidationException::withMessages([
                    "Products.$index.quantity" =>
                    "Only {$product->count} items available for {$product->name}",
                ]);
            }
        }

        return $this->data;
    }

    protected function afterCreate(): void
    {
        foreach ($this->record->products as $item) {
            $product = $item->products;

            $product->decrement('count', $item->quantity);
        }
    }

}
