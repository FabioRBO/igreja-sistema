<?php

namespace App\Filament\Resources\LogisticsDeliveries\Pages;

use App\Filament\Resources\LogisticsDeliveries\LogisticsDeliveryResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditLogisticsDelivery extends EditRecord
{
    protected static string $resource = LogisticsDeliveryResource::class;

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
