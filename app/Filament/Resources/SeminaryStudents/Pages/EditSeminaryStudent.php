<?php

namespace App\Filament\Resources\SeminaryStudents\Pages;

use App\Filament\Resources\SeminaryStudents\SeminaryStudentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSeminaryStudent extends EditRecord
{
    protected static string $resource = SeminaryStudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
