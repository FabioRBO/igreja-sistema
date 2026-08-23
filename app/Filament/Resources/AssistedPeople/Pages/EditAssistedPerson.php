<?php

namespace App\Filament\Resources\AssistedPeople\Pages;

use App\Filament\Resources\AssistedPeople\AssistedPersonResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditAssistedPerson extends EditRecord
{
    protected static string $resource = AssistedPersonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
