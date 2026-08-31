<?php

namespace App\Filament\Pages;

use App\Models\Marriage;
use App\Models\Person;
use BackedEnum;
use Carbon\Carbon;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Collection;

class BroadcastList extends Page
{
    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedMegaphone;

    protected static ?string $navigationLabel =
        'Lista de Transmissão';

    protected static ?string $title =
        'Lista de Transmissão';

    protected static string|\UnitEnum|null $navigationGroup =
        'Administração';

    protected static ?int $navigationSort = 20;

    protected string $view =
        'filament.pages.broadcast-list';

    public string $pushAudience = 'birthday_today';
    public string $smsAudience = 'birthday_today';

    public array $pushSelected = [];
    public array $smsSelected = [];

    public string $pushMessage =
        'Parabéns pelo seu dia! Desejamos muitas felicidades e que Deus continue abençoando sua vida. Feliz aniversário! 🎉';

    public string $smsMessage =
        'Parabéns pelo seu dia! Desejamos muitas felicidades e que Deus continue abençoando sua vida. Feliz aniversário! 🎉';

    public function mount(): void
    {
        $this->loadPushSelected();
        $this->loadSmsSelected();
    }

    public function updatedPushAudience(): void
    {
        $this->loadPushSelected();
    }

    public function updatedSmsAudience(): void
    {
        $this->loadSmsSelected();
    }

    public function getPushRecipientsProperty(): Collection
    {
        return $this->getRecipients($this->pushAudience);
    }

    public function getSmsRecipientsProperty(): Collection
    {
        return $this->getRecipients($this->smsAudience);
    }

    protected function loadPushSelected(): void
    {
        $this->pushSelected = $this->getRecipients($this->pushAudience)
            ->pluck('id')
            ->map(fn ($id) => (string) $id)
            ->toArray();
    }

    protected function loadSmsSelected(): void
    {
        $this->smsSelected = $this->getRecipients($this->smsAudience)
            ->pluck('id')
            ->map(fn ($id) => (string) $id)
            ->toArray();
    }

    protected function getRecipients(string $audience): Collection
    {
        return match ($audience) {

            'birthday_today' => Person::query()
                ->whereNotNull('birth_date')
                ->whereMonth('birth_date', now()->month)
                ->whereDay('birth_date', now()->day)
                ->orderBy('name')
                ->get(),

            'birthday_week' => $this->getBirthdayWeek(),

            'wedding_anniversary' => $this->getWeddingAnniversaries(),

            'all' => Person::query()
                ->orderBy('name')
                ->get(),

            default => collect(),
        };
    }

    protected function getBirthdayWeek(): Collection
    {
        $dates = collect(range(0, 6))
            ->map(fn (int $day) => now()->copy()->addDays($day));

        return Person::query()
            ->whereNotNull('birth_date')
            ->where(function ($query) use ($dates) {
                foreach ($dates as $date) {
                    $query->orWhere(function ($subQuery) use ($date) {
                        $subQuery
                            ->whereMonth('birth_date', $date->month)
                            ->whereDay('birth_date', $date->day);
                    });
                }
            })
            ->orderBy('name')
            ->get();
    }

    protected function getWeddingAnniversaries(): Collection
    {
        $marriages = Marriage::query()
            ->with([
                'personOne',
                'personTwo',
            ])
            ->where('is_active', true)
            ->whereMonth('marriage_date', now()->month)
            ->whereDay('marriage_date', now()->day)
            ->get();

        return $marriages
            ->flatMap(function (Marriage $marriage) {
                return [
                    $marriage->personOne,
                    $marriage->personTwo,
                ];
            })
            ->filter()
            ->unique('id')
            ->sortBy('name')
            ->values();
    }
}