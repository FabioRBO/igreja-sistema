<?php

namespace App\Filament\Resources\WorshipParticipants\Pages;

use App\Filament\Resources\WorshipParticipants\WorshipParticipantResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWorshipParticipants extends ListRecords
{
    protected static string $resource = WorshipParticipantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
