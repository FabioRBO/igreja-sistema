<?php

namespace App\Filament\Resources\CellParticipants\Pages;

use App\Filament\Resources\CellParticipants\CellParticipantResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCellParticipant extends ViewRecord
{
    protected static string $resource = CellParticipantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
