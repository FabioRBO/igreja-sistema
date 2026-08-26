<?php

namespace App\Filament\Pages;

use App\Models\Church;
use App\Models\FinancialAccount;
use App\Models\FinancialEntry;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class FinancialDashboard extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected static string|UnitEnum|null $navigationGroup = 'Financeiro';

    protected static ?string $navigationLabel = 'Dashboard Financeiro';

    protected static ?string $title = 'Dashboard Financeiro';

    protected static ?int $navigationSort = 0;

    protected string $view = 'filament.pages.financial-dashboard';

    public ?string $startDate = null;

    public ?string $endDate = null;

    public ?int $churchId = null;

    public ?int $accountId = null;

    public string $chartMode = 'single';

    public int $chartYear;

    public array $comparisonYears = [];

    public function mount(): void
    {
        $this->startDate = now()->startOfMonth()->format('Y-m-d');
        $this->endDate = now()->endOfMonth()->format('Y-m-d');

        $this->chartYear = now()->year;

        $this->comparisonYears = [
            now()->year - 2,
            now()->year - 1,
            now()->year,
        ];
    }

    public function getAvailableYearsProperty(): array
    {
        return FinancialEntry::query()
            ->whereNotNull('payment_date')
            ->selectRaw('YEAR(payment_date) as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year')
            ->mapWithKeys(fn ($year) => [$year => $year])
            ->toArray();
    }

    protected function monthlyIncomeForYear(int $year): array
    {
        $data = $this->baseQuery()
            ->where('type', 'income')
            ->where('status', 'paid')
            ->whereYear('payment_date', $year)
            ->selectRaw('MONTH(payment_date) as month, SUM(paid_amount) as total')
            ->groupByRaw('MONTH(payment_date)')
            ->pluck('total', 'month');

        $months = [];

        for ($month = 1; $month <= 12; $month++) {
            $months[] = (float) ($data[$month] ?? 0);
        }

        return $months;
    }


    public function getIncomeChartDataProperty(): array
    {
        if ($this->chartMode === 'compare') {
            $datasets = [];

            foreach ($this->comparisonYears as $year) {
                $datasets[] = [
                    'label' => (string) $year,
                    'data' => $this->monthlyIncomeForYear((int) $year),
                ];
            }

            return [
                'labels' => [
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
                ],
                'datasets' => $datasets,
            ];
        }

        return [
            'labels' => [
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
            ],
            'datasets' => [
                [
                    'label' => (string) $this->chartYear,
                    'data' => $this->monthlyIncomeForYear($this->chartYear),
                ],
            ],
        ];
    }

    protected function baseQuery(): Builder
    {
        return FinancialEntry::query()
            ->when(
                $this->churchId,
                fn (Builder $query) =>
                    $query->where('church_id', $this->churchId)
            )
            ->when(
                $this->accountId,
                fn (Builder $query) =>
                    $query->where('financial_account_id', $this->accountId)
            );
    }

    public function getTotalIncomeProperty(): float
    {
        return (float) $this->baseQuery()
            ->where('type', 'income')
            ->where('status', 'paid')
            ->whereBetween('payment_date', [
                $this->startDate . ' 00:00:00',
                $this->endDate . ' 23:59:59',
            ])
            ->sum('paid_amount');
    }

    public function getTotalExpenseProperty(): float
    {
        return (float) $this->baseQuery()
            ->where('type', 'expense')
            ->where('status', 'paid')
            ->whereBetween('payment_date', [
                $this->startDate . ' 00:00:00',
                $this->endDate . ' 23:59:59',
            ])
            ->sum('paid_amount');
    }

    public function getBalanceProperty(): float
    {
        return $this->totalIncome - $this->totalExpense;
    }

    public function getReceivableProperty(): float
    {
        return (float) $this->baseQuery()
            ->where('type', 'income')
            ->whereIn('status', ['pending', 'partial'])
            ->selectRaw('COALESCE(SUM(amount - paid_amount), 0) as total')
            ->value('total');
    }

    public function getPayableProperty(): float
    {
        return (float) $this->baseQuery()
            ->where('type', 'expense')
            ->whereIn('status', ['pending', 'partial'])
            ->selectRaw('COALESCE(SUM(amount - paid_amount), 0) as total')
            ->value('total');
    }

    public function getChurchesProperty()
    {
        return Church::query()
            ->orderBy('name')
            ->pluck('name', 'id');
    }

    public function getAccountsProperty()
    {
        return FinancialAccount::query()
            ->when(
                $this->churchId,
                fn (Builder $query) =>
                    $query->where('church_id', $this->churchId)
            )
            ->where('is_active', true)
            ->orderBy('name')
            ->pluck('name', 'id');
    }

    public function getEntriesProperty()
    {
        return $this->baseQuery()
            ->with([
                'financialCategory',
                'financialAccount',
            ])
            ->where(function (Builder $query) {
                $query
                    ->whereBetween('payment_date', [
                        $this->startDate . ' 00:00:00',
                        $this->endDate . ' 23:59:59',
                    ])
                    ->orWhereBetween('due_date', [
                        $this->startDate,
                        $this->endDate,
                    ]);
            })
            ->orderByDesc('payment_date')
            ->orderByDesc('due_date')
            ->limit(100)
            ->get();
    }
}