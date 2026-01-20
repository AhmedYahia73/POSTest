<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class StatsOverview extends ChartWidget
{
    protected ?string $heading = 'Sales';

    protected function getData(): array
    { 
        return [
            'datasets' => [
                [
                    'label' => 'Sales',
                    'data' => [100, 250, 150, 400, 550, 300, 700],
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        ]; 
    }

    protected function getType(): string
    {
        return 'line';
    }
}
