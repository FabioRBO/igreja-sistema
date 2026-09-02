<?php

namespace App\Filament\Resources\LogisticsLoans\Pages;

use App\Filament\Resources\LogisticsLoans\LogisticsLoanResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLogisticsLoan extends ViewRecord
{
    protected static string $resource = LogisticsLoanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
