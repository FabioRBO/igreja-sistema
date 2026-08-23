<?php

namespace App\Filament\Resources\AssistedPeople\Pages;

use App\Filament\Resources\AssistedPeople\AssistedPersonResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAssistedPerson extends ViewRecord
{
    protected static string $resource = AssistedPersonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
