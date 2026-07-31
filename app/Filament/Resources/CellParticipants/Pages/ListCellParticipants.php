<?php

namespace App\Filament\Resources\CellParticipants\Pages;

use App\Filament\Resources\CellParticipants\CellParticipantResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCellParticipants extends ListRecords
{
    protected static string $resource = CellParticipantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
