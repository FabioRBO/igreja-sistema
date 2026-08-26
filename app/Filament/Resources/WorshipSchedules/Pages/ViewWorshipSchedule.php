<?php

namespace App\Filament\Resources\WorshipSchedules\Pages;

use App\Filament\Resources\WorshipSchedules\WorshipScheduleResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWorshipSchedule extends ViewRecord
{
    protected static string $resource = WorshipScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
