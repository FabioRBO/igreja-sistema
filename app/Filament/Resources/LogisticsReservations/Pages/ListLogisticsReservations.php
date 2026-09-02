<?php

namespace App\Filament\Resources\LogisticsReservations\Pages;

use App\Filament\Resources\LogisticsReservations\LogisticsReservationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLogisticsReservations extends ListRecords
{
    protected static string $resource = LogisticsReservationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
