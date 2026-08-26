<?php

namespace App\Filament\Pages;

use App\Models\Baptism;
use BackedEnum;
use Carbon\Carbon;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class BaptismsCalendar extends Page
{
    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedCalendarDays;

    protected static string|UnitEnum|null $navigationGroup = 'Cadastros';

    protected static ?string $navigationLabel = 'Calendário de Batismos';

    protected static ?string $title = 'Calendário de Batismos';

    protected static ?int $navigationSort = 7;

    protected string $view = 'filament.pages.baptisms-calendar';

    public int $month;

    public int $year;

    public ?string $selectedDate = null;

    public function mount(): void
    {
        $this->month = now()->month;
        $this->year = now()->year;
        $this->selectedDate = now()->format('Y-m-d');
    }

    public function previousMonth(): void
    {
        $date = Carbon::create($this->year, $this->month, 1)
            ->subMonth();

        $this->month = $date->month;
        $this->year = $date->year;
    }

    public function nextMonth(): void
    {
        $date = Carbon::create($this->year, $this->month, 1)
            ->addMonth();

        $this->month = $date->month;
        $this->year = $date->year;
    }

    public function selectDay(int $day): void
    {
        $this->selectedDate = Carbon::create(
            $this->year,
            $this->month,
            $day
        )->format('Y-m-d');
    }

    public function getBaptismsProperty()
    {
        return Baptism::query()
            ->with('person')
            ->whereYear('baptism_date', $this->year)
            ->whereMonth('baptism_date', $this->month)
            ->get();
    }

    public function getSelectedBaptismsProperty()
    {
        if (! $this->selectedDate) {
            return collect();
        }

        return Baptism::query()
            ->with('person')
            ->whereDate('baptism_date', $this->selectedDate)
            ->get();
    }

    public function getBaptismDaysProperty(): array
    {
        return $this->baptisms
            ->map(fn ($baptism) =>
                Carbon::parse($baptism->baptism_date)->day
            )
            ->unique()
            ->values()
            ->toArray();
    }
}