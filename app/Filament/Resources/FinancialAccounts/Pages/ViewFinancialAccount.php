<?php

namespace App\Filament\Resources\FinancialAccounts\Pages;

use App\Filament\Resources\FinancialAccounts\FinancialAccountResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFinancialAccount extends ViewRecord
{
    protected static string $resource = FinancialAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
