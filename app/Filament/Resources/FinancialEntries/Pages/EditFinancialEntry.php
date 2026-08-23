<?php

namespace App\Filament\Resources\FinancialEntries\Pages;

use App\Filament\Resources\FinancialEntries\FinancialEntryResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditFinancialEntry extends EditRecord
{
    protected static string $resource = FinancialEntryResource::class;

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
