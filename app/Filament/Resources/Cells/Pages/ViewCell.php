<?php

namespace App\Filament\Resources\Cells\Pages;

use App\Filament\Resources\Cells\CellResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCell extends ViewRecord
{
    protected static string $resource = CellResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
