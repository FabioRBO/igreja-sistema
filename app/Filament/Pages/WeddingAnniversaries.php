<?php

namespace App\Filament\Pages;

use App\Models\Marriage;
use BackedEnum;
use Carbon\Carbon;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Collection;

class WeddingAnniversaries extends Page
{
    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedHeart;

    protected static ?string $navigationLabel =
        'Aniversários de Casamento';

    protected static ?string $title =
        'Aniversários de Casamento';

    protected static string|\UnitEnum|null $navigationGroup =
        'Cadastros';

    protected static ?int $navigationSort = 7;

    protected string $view =
        'filament.pages.wedding-anniversaries';

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

        $this->selectedDate = Carbon::create(
            $this->year,
            $this->month,
            1
        )->format('Y-m-d');
    }

    public function nextMonth(): void
    {
        $date = Carbon::create($this->year, $this->month, 1)
            ->addMonth();

        $this->month = $date->month;
        $this->year = $date->year;

        $this->selectedDate = Carbon::create(
            $this->year,
            $this->month,
            1
        )->format('Y-m-d');
    }

    public function selectDay(int $day): void
    {
        $this->selectedDate = Carbon::create(
            $this->year,
            $this->month,
            $day
        )->format('Y-m-d');
    }

    public function getWeddingDaysProperty(): array
    {
        return Marriage::query()
            ->where('is_active', true)
            ->whereMonth('marriage_date', $this->month)
            ->get()
            ->pluck('marriage_date')
            ->filter()
            ->map(fn ($date) => Carbon::parse($date)->day)
            ->unique()
            ->values()
            ->toArray();
    }

    public function getSelectedMarriagesProperty(): Collection
    {
        if (! $this->selectedDate) {
            return collect();
        }

        $date = Carbon::parse($this->selectedDate);

        return Marriage::query()
            ->with([
                'personOne',
                'personTwo',
                'church',
            ])
            ->where('is_active', true)
            ->whereMonth('marriage_date', $date->month)
            ->whereDay('marriage_date', $date->day)
            ->orderBy('marriage_date')
            ->get();
    }
}