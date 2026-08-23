<?php

namespace App\Filament\Resources\AssistedPeople\Pages;

use App\Filament\Resources\AssistedPeople\AssistedPersonResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAssistedPerson extends CreateRecord
{
    protected static string $resource = AssistedPersonResource::class;
}
