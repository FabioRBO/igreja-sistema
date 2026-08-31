<?php

namespace App\Filament\Pages;

use App\Models\Person;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Collection;

class VisitorsReport extends Page
{
    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedUserPlus;

    protected static ?string $navigationLabel =
        'Relatório de Visitantes';

    protected static ?string $title =
        'Relatório de Visitantes';

    protected static string|\UnitEnum|null $navigationGroup =
        'Cadastros';

    protected static ?int $navigationSort = 2;

    protected string $view =
        'filament.pages.visitors-report';

    public ?string $startDate = null;
    public ?string $endDate = null;

    public function mount(): void
    {
        $this->startDate = now()
            ->startOfMonth()
            ->format('Y-m-d');

        $this->endDate = now()
            ->endOfMonth()
            ->format('Y-m-d');
    }

    public function getVisitors(): Collection
    {
        return Person::query()
            ->where('is_visitor', true)
            ->whereNotNull('visit_date')
            ->when(
                $this->startDate,
                fn ($query) =>
                    $query->whereDate('visit_date', '>=', $this->startDate)
            )
            ->when(
                $this->endDate,
                fn ($query) =>
                    $query->whereDate('visit_date', '<=', $this->endDate)
            )
            ->selectRaw('visit_date, COUNT(*) as total')
            ->groupBy('visit_date')
            ->orderBy('visit_date', 'desc')
            ->get();
    }
}