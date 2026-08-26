<?php

namespace App\Filament\Widgets;

use App\Models\FinancialEntry;
use Filament\Widgets\ChartWidget;

class FinancialExpenseChart extends ChartWidget
{
    protected static bool $isDiscovered = false;

    protected ?string $heading = 'Saídas por mês';

    protected ?string $description = 'Evolução mensal das despesas pagas';

    protected ?string $maxHeight = '260px';

    public ?string $filter = null;

    public function mount(): void
    {
        $this->filter = (string) now()->year;
    }

    protected function getFilters(): ?array
    {
        $years = FinancialEntry::query()
            ->whereNotNull('payment_date')
            ->selectRaw('YEAR(payment_date) as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year')
            ->mapWithKeys(fn ($year) => [
                (string) $year => (string) $year,
            ])
            ->toArray();

        if (empty($years)) {
            $years[(string) now()->year] = (string) now()->year;
        }

        $years['compare_3'] = 'Comparar últimos 3 anos';

        return $years;
    }

    protected function monthlyExpenseForYear(int $year): array
    {
        $values = FinancialEntry::query()
            ->where('type', 'expense')
            ->where('status', 'paid')
            ->whereNotNull('payment_date')
            ->whereYear('payment_date', $year)
            ->selectRaw('MONTH(payment_date) as month, SUM(paid_amount) as total')
            ->groupByRaw('MONTH(payment_date)')
            ->pluck('total', 'month');

        $data = [];

        for ($month = 1; $month <= 12; $month++) {
            $data[] = (float) ($values[$month] ?? 0);
        }

        return $data;
    }

    protected function getData(): array
    {
        $labels = [
            'Jan',
            'Fev',
            'Mar',
            'Abr',
            'Mai',
            'Jun',
            'Jul',
            'Ago',
            'Set',
            'Out',
            'Nov',
            'Dez',
        ];

        if ($this->filter === 'compare_3') {
            $currentYear = now()->year;

            $years = [
                $currentYear - 2,
                $currentYear - 1,
                $currentYear,
            ];

            $datasets = [];

            foreach ($years as $year) {
                $datasets[] = [
                    'label' => (string) $year,
                    'data' => $this->monthlyExpenseForYear($year),
                    'tension' => 0.35,
                    'fill' => false,
                ];
            }

            return [
                'datasets' => $datasets,
                'labels' => $labels,
            ];
        }

        $year = (int) ($this->filter ?: now()->year);

        return [
            'datasets' => [
                [
                    'label' => "Saídas {$year}",
                    'data' => $this->monthlyExpenseForYear($year),
                    'tension' => 0.35,
                    'fill' => false,
                ],
            ],

            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,

            'interaction' => [
                'mode' => 'index',
                'intersect' => false,
            ],

            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                ],
            ],

            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                ],
            ],
        ];
    }
}