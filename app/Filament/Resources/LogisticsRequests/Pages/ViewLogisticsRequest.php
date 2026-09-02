<?php

namespace App\Filament\Resources\LogisticsRequests\Pages;

use App\Filament\Resources\LogisticsRequests\LogisticsRequestResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLogisticsRequest extends ViewRecord
{
    protected static string $resource = LogisticsRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
