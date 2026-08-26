<?php

namespace App\Filament\Resources\Preachers\Pages;

use App\Filament\Resources\Preachers\PreacherResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPreacher extends ViewRecord
{
    protected static string $resource = PreacherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
