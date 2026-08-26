<?php

namespace App\Filament\Widgets;

use App\Models\Baptism;
use Filament\Widgets\Widget;

class UpcomingBaptismsWidget extends Widget
{
    protected string $view = 'filament.widgets.upcoming-baptisms-widget';

    protected static ?int $sort = 20;

    protected int|string|array $columnSpan = [
        'md' => 1,
        'xl' => 1,
    ];

    public function getNextDateProperty()
    {
        return Baptism::query()
            ->whereDate('baptism_date', '>=', today())
            ->orderBy('baptism_date')
            ->value('baptism_date');
    }

    public function getBaptismsProperty()
    {
        if (! $this->nextDate) {
            return collect();
        }

        return Baptism::query()
            ->with('person')
            ->whereDate('baptism_date', $this->nextDate)
            ->orderBy('baptism_date')
            ->get();
    }
}