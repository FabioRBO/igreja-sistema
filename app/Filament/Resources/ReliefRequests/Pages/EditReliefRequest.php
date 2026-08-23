<?php

namespace App\Filament\Resources\ReliefRequests\Pages;

use App\Filament\Resources\ReliefRequests\ReliefRequestResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditReliefRequest extends EditRecord
{
    protected static string $resource = ReliefRequestResource::class;

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
