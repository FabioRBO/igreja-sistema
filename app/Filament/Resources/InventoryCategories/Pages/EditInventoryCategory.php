<?php

namespace App\Filament\Resources\InventoryCategories\Pages;

use App\Filament\Resources\InventoryCategories\InventoryCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditInventoryCategory extends EditRecord
{
    protected static string $resource = InventoryCategoryResource::class;

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
