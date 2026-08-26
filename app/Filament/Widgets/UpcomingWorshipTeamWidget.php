<?php

namespace App\Filament\Widgets;

use App\Models\WorshipSchedule;
use Filament\Widgets\Widget;

class UpcomingWorshipTeamWidget extends Widget
{
    protected string $view =
        'filament.widgets.upcoming-worship-team-widget';

    protected static ?int $sort = 30;

    protected int|string|array $columnSpan = [
        'md' => 1,
        'xl' => 1,
    ];

    public function getScheduleProperty(): ?WorshipSchedule
    {
        return WorshipSchedule::query()
            ->with([
                'participants.person',
            ])
            ->where('is_active', true)
            ->whereDate('schedule_date', '>=', today())
            ->orderBy('schedule_date')
            ->orderBy('start_time')
            ->first();
    }
}