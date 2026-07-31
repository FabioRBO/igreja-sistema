<?php

namespace App\Filament\Resources\Baptisms\Pages;

use App\Filament\Resources\Baptisms\BaptismResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBaptisms extends ListRecords
{
    protected static string $resource = BaptismResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
