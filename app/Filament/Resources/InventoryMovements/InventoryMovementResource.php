<?php

namespace App\Filament\Resources\InventoryMovements;

use App\Filament\Resources\InventoryMovements\Pages\CreateInventoryMovement;
use App\Filament\Resources\InventoryMovements\Pages\EditInventoryMovement;
use App\Filament\Resources\InventoryMovements\Pages\ListInventoryMovements;
use App\Filament\Resources\InventoryMovements\Schemas\InventoryMovementForm;
use App\Filament\Resources\InventoryMovements\Tables\InventoryMovementsTable;
use App\Models\InventoryMovement;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class InventoryMovementResource extends Resource
{
    protected static ?string $model = InventoryMovement::class;

    protected static ?string $modelLabel = 'Movimentação';

    protected static ?string $pluralModelLabel = 'Movimentações';

    protected static ?string $navigationLabel = 'Movimentações';

    protected static string|\UnitEnum|null $navigationGroup = 'Inventário';

    protected static ?int $navigationSort = 3;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedArrowsRightLeft;

    public static function form(Schema $schema): Schema
    {
        return InventoryMovementForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InventoryMovementsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInventoryMovements::route('/'),
            'create' => CreateInventoryMovement::route('/create'),
            'edit' => EditInventoryMovement::route('/{record}/edit'),
        ];
    }
}