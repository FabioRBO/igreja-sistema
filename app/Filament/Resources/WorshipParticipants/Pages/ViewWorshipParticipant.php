<?php

namespace App\Filament\Resources\WorshipParticipants\Pages;

use App\Filament\Resources\WorshipParticipants\WorshipParticipantResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWorshipParticipant extends ViewRecord
{
    protected static string $resource = WorshipParticipantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
