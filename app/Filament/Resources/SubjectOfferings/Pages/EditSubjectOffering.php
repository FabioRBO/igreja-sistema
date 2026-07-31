<?php

namespace App\Filament\Resources\SubjectOfferings\Pages;

use App\Filament\Resources\SubjectOfferings\SubjectOfferingResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSubjectOffering extends EditRecord
{
    protected static string $resource = SubjectOfferingResource::class;

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
