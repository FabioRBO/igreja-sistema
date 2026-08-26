<?php

namespace App\Filament\Widgets;

use App\Models\Member;
use Filament\Widgets\Widget;

class BirthdaysWidget extends Widget
{
    protected static bool $isDiscovered = false;

    protected string $view = 'filament.widgets.birthdays-widget';

    //protected int|string|array $columnSpan = 'full';
    protected int|string|array $columnSpan = [
        'md' => 1,
        'xl' => 1,
    ];

    public function getBirthdaysProperty()
    {
        return Member::query()
            ->with('person')
            ->whereHas('person', function ($query) {
                $query
                    ->whereNotNull('birth_date')
                    ->whereMonth('birth_date', now()->month);
            })
            ->get()
            ->filter(fn ($member) => $member->person?->birth_date)
            ->sortBy(fn ($member) => $member->person->birth_date->format('d'))
            ->values();
    }
}