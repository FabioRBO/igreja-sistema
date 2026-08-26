<?php

namespace App\Filament\Pages;

use App\Models\WorshipSchedule;
use BackedEnum;
use Carbon\Carbon;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class WorshipCalendar extends Page
{
    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedMusicalNote;

    protected static string|UnitEnum|null $navigationGroup = 'Louvor';

    protected static ?string $navigationLabel = 'Calendário da Escala';

    protected static ?string $title = 'Calendário da Escala do Louvor';

    protected static ?int $navigationSort = 3;

    protected string $view = 'filament.pages.worship-calendar';

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
        $date = Carbon::create($this->year, $this->month, 1)->subMonth();

        $this->month = $date->month;
        $this->year = $date->year;
    }

    public function nextMonth(): void
    {
        $date = Carbon::create($this->year, $this->month, 1)->addMonth();

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

    public function getSchedulesProperty()
    {
        return WorshipSchedule::query()
            ->with([
                'participants.person',
            ])
            ->whereYear('schedule_date', $this->year)
            ->whereMonth('schedule_date', $this->month)
            ->where('is_active', true)
            ->orderBy('schedule_date')
            ->get();
    }

    public function getSelectedSchedulesProperty()
    {
        if (! $this->selectedDate) {
            return collect();
        }

        return WorshipSchedule::query()
            ->with([
                'participants.person',
            ])
            ->whereDate('schedule_date', $this->selectedDate)
            ->where('is_active', true)
            ->orderBy('start_time')
            ->get();
    }

    public function getScheduleDaysProperty(): array
    {
        return $this->schedules
            ->map(fn ($schedule) => $schedule->schedule_date->day)
            ->unique()
            ->values()
            ->toArray();
    }
}