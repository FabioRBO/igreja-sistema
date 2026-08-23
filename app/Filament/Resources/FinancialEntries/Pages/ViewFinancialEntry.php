<?php

namespace App\Filament\Resources\FinancialEntries\Pages;

use App\Filament\Resources\FinancialEntries\FinancialEntryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFinancialEntry extends ViewRecord
{
    protected static string $resource = FinancialEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
