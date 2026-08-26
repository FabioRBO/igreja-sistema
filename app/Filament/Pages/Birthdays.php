<?php

namespace App\Filament\Pages;

use App\Models\Member;
use BackedEnum;
use Carbon\Carbon;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class Birthdays extends Page
{
    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedCake;

    protected static string|UnitEnum|null $navigationGroup = 'Cadastros';

    protected static ?string $navigationLabel = 'Aniversariantes';

    protected static ?string $title = 'Aniversariantes';

    protected static ?int $navigationSort = 3;

    protected string $view = 'filament.pages.birthdays';

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

    public function getBirthdaysProperty()
    {
        return Member::query()
            ->with('person')
            ->whereHas('person', function ($query) {
                $query
                    ->whereNotNull('birth_date')
                    ->whereMonth('birth_date', $this->month);
            })
            ->get()
            ->filter(fn ($member) => $member->person?->birth_date)
            ->values();
    }

    public function getSelectedBirthdaysProperty()
    {
        if (! $this->selectedDate) {
            return collect();
        }

        $selected = Carbon::parse($this->selectedDate);

        return $this->birthdays
            ->filter(function ($member) use ($selected) {
                return $member->person->birth_date->day === $selected->day;
            })
            ->values();
    }

    public function getBirthdayDaysProperty(): array
    {
        return $this->birthdays
            ->map(fn ($member) => $member->person->birth_date->day)
            ->unique()
            ->values()
            ->toArray();
    }
}