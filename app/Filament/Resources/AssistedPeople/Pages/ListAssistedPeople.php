<?php

namespace App\Filament\Resources\AssistedPeople\Pages;

use App\Filament\Resources\AssistedPeople\AssistedPersonResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAssistedPeople extends ListRecords
{
    protected static string $resource = AssistedPersonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
