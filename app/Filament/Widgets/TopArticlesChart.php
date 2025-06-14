<?php

namespace App\Filament\Widgets;

use App\Models\View;
use Filament\Widgets\ChartWidget;

class TopArticlesChart extends ChartWidget
{
    protected array|string|int $columnSpan = 'full'; 
    protected static ?string $heading = 'Top 10 Artikel Berdasarkan Views';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $topArticles = View::getTopArticles(10, 'month');

        $labels = [];
        $data = [];
        $colors = [
            '#3B82F6', '#EF4444', '#10B981', '#F59E0B', '#8B5CF6',
            '#06B6D4', '#F97316', '#84CC16', '#EC4899', '#6B7280'
        ];

        foreach ($topArticles as $item) {
            $labels[] = substr($item->article->title ?? 'Unknown', 0, 30) . '...';
            $data[] = $item->total_views;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Views',
                    'data' => $data,
                    'backgroundColor' => array_slice($colors, 0, count($data)),
                ],
            ],
            'labels' => $labels,
            'options' => [
                'indexAxis' => 'y', // Menjadikan bar chart horizontal
                'plugins' => [
                    'legend' => [
                        'display' => false,
                    ],
                ],
                'scales' => [
                    'x' => [
                        'beginAtZero' => true,
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Ganti dari 'doughnut' ke 'bar'
    }
}
