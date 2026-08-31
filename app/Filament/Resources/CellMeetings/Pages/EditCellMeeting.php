<?php

namespace App\Filament\Resources\CellMeetings\Pages;

use App\Filament\Resources\CellMeetings\CellMeetingResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditCellMeeting extends EditRecord
{
    protected static string $resource = CellMeetingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
