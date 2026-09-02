<?php

namespace App\Filament\Resources\LogisticsReservations\Pages;

use App\Filament\Resources\LogisticsReservations\LogisticsReservationResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLogisticsReservation extends ViewRecord
{
    protected static string $resource = LogisticsReservationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
