<?php

namespace App\Filament\Resources\SubjectOfferings\Pages;

use App\Filament\Resources\SubjectOfferings\SubjectOfferingResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSubjectOffering extends ViewRecord
{
    protected static string $resource = SubjectOfferingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
