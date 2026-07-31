<?php

namespace App\Filament\Resources\SubjectOfferings\Pages;

use App\Filament\Resources\SubjectOfferings\SubjectOfferingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSubjectOfferings extends ListRecords
{
    protected static string $resource = SubjectOfferingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
