<?php

namespace App\Filament\Resources\Baptisms\Pages;

use App\Filament\Resources\Baptisms\BaptismResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBaptism extends ViewRecord
{
    protected static string $resource = BaptismResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
