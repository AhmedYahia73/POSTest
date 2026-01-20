<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

use App\Models\Product;

class Products extends ChartWidget
{
    protected ?string $heading = 'Products Count';

    protected function getData(): array
    {
        $products = Product::
        select("name", "count")
        ->get();
        return [
            'datasets' => [
                [
                    'label' => 'Products Inventory',
                    'data' => $products->pluck("count"),
                    'borderColor' => '#9BD0F5',
                    'backgroundColor' => [
                        '#6366f1', 
                        '#f59e0b', 
                        '#10b981', 
                        '#f43f5e', 
                        '#8b5cf6', 
                    ],
                    'borderWidth' => 1,
                    'barPercentage' => 0.16,
                ],
            ],
            'labels' => $products->pluck("name")
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
