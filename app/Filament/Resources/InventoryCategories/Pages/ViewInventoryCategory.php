<?php

namespace App\Filament\Resources\InventoryCategories\Pages;

use App\Filament\Resources\InventoryCategories\InventoryCategoryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewInventoryCategory extends ViewRecord
{
    protected static string $resource = InventoryCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
