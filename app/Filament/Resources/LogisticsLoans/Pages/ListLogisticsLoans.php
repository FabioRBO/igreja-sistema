<?php

namespace App\Filament\Resources\LogisticsLoans\Pages;

use App\Filament\Resources\LogisticsLoans\LogisticsLoanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLogisticsLoans extends ListRecords
{
    protected static string $resource = LogisticsLoanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
