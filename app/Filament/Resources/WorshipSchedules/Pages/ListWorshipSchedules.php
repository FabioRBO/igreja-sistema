<?php

namespace App\Filament\Resources\WorshipSchedules\Pages;

use App\Filament\Resources\WorshipSchedules\WorshipScheduleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWorshipSchedules extends ListRecords
{
    protected static string $resource = WorshipScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
