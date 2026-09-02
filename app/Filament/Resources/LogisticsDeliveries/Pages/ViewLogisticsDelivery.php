<?php

namespace App\Filament\Resources\LogisticsDeliveries\Pages;

use App\Filament\Resources\LogisticsDeliveries\LogisticsDeliveryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLogisticsDelivery extends ViewRecord
{
    protected static string $resource = LogisticsDeliveryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
