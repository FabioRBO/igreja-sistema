<?php

namespace App\Filament\Resources\LogisticsDeliveries\Pages;

use App\Filament\Resources\LogisticsDeliveries\LogisticsDeliveryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLogisticsDeliveries extends ListRecords
{
    protected static string $resource = LogisticsDeliveryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
