<?php

namespace App\Filament\Pages;

use App\Models\CellMeeting;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class CellMeetingsReport extends Page
{
    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedChartBar;

    protected static ?string $navigationLabel =
        'Relatório de Células';

    protected static ?string $title =
        'Relatório de Células';

    protected static string|\UnitEnum|null $navigationGroup =
        'Cadastros';

    protected static ?int $navigationSort = 11;

    protected string $view =
        'filament.pages.cell-meetings-report';

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

    public function getMeetings(): Collection
    {
        return CellMeeting::query()
            ->with('cell')
            ->withCount([
                'attendances' => function (Builder $query) {
                    $query->where('is_present', true);
                },
            ])
            ->when(
                $this->startDate,
                fn (Builder $query) =>
                    $query->whereDate('meeting_date', '>=', $this->startDate)
            )
            ->when(
                $this->endDate,
                fn (Builder $query) =>
                    $query->whereDate('meeting_date', '<=', $this->endDate)
            )
            ->orderBy('meeting_date', 'desc')
            ->get();
    }
}