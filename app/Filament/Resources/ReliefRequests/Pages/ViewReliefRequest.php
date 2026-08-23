<?php

namespace App\Filament\Resources\ReliefRequests\Pages;

use App\Filament\Resources\ReliefRequests\ReliefRequestResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewReliefRequest extends ViewRecord
{
    protected static string $resource = ReliefRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
