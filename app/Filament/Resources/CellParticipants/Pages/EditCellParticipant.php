<?php

namespace App\Filament\Resources\CellParticipants\Pages;

use App\Filament\Resources\CellParticipants\CellParticipantResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCellParticipant extends EditRecord
{
    protected static string $resource = CellParticipantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
