<?php

namespace App\Filament\Resources\LogisticsReservations\Pages;

use App\Filament\Resources\LogisticsReservations\LogisticsReservationResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditLogisticsReservation extends EditRecord
{
    protected static string $resource = LogisticsReservationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
