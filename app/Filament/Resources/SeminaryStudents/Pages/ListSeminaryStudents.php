<?php

namespace App\Filament\Resources\SeminaryStudents\Pages;

use App\Filament\Resources\SeminaryStudents\SeminaryStudentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSeminaryStudents extends ListRecords
{
    protected static string $resource = SeminaryStudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
