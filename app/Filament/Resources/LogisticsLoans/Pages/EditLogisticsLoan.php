<?php

namespace App\Filament\Resources\LogisticsLoans\Pages;

use App\Filament\Resources\LogisticsLoans\LogisticsLoanResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditLogisticsLoan extends EditRecord
{
    protected static string $resource = LogisticsLoanResource::class;

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
