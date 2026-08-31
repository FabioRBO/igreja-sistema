<?php

namespace App\Filament\Widgets;

use App\Models\Marriage;
use Filament\Widgets\Widget;
use Illuminate\Support\Collection;

class WeddingAnniversariesWidget extends Widget
{
    protected string $view = 'filament.widgets.wedding-anniversaries-widget';

    protected int|string|array $columnSpan = 1;

    public function getMarriages(): Collection
    {
        return Marriage::query()
            ->with([
                'personOne',
                'personTwo',
            ])
            ->where('is_active', true)
            ->whereMonth('marriage_date', now()->month)
            ->get()
            ->sortBy(fn (Marriage $marriage) => $marriage->marriage_date->day);
    }
}