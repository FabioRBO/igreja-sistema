<?php

namespace App\Filament\Resources\LogisticsRequests\Pages;

use App\Filament\Resources\LogisticsRequests\LogisticsRequestResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLogisticsRequests extends ListRecords
{
    protected static string $resource = LogisticsRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
