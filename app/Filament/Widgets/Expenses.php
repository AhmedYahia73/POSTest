<?php

namespace App\Filament\Widgets;

use App\Models\Expense;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class Expenses extends ChartWidget
{
    protected ?string $heading = 'Expenses';

    protected function getData(): array
    {
        $expenses = Expense::select(
            DB::raw('sum(price) as total'),
            DB::raw("DATE_FORMAT(created_at, '%M') as month"),
            DB::raw("DATE_FORMAT(created_at, '%m') as month_num")
        )
        ->whereYear("created_at", ">=", date("Y"))
        ->groupBy('month', 'month_num')
        ->orderBy('month_num')
        ->get();

        return [ 
            'datasets' => [
                [
                    'label' => 'Expenses',
                    'data' => $expenses->pluck("total"),
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
            'labels' => $expenses->pluck("month")
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
