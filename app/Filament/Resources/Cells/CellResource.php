<?php

namespace App\Filament\Resources\Cells;

use App\Filament\Resources\Cells\Pages\CreateCell;
use App\Filament\Resources\Cells\Pages\EditCell;
use App\Filament\Resources\Cells\Pages\ListCells;
use App\Filament\Resources\Cells\Pages\ViewCell;
use App\Filament\Resources\Cells\Schemas\CellForm;
use App\Filament\Resources\Cells\Schemas\CellInfolist;
use App\Filament\Resources\Cells\Tables\CellsTable;
use App\Models\Cell;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CellResource extends Resource
{
    protected static ?string $modelLabel = 'Célula';
    protected static ?string $pluralModelLabel = 'Células';
    protected static ?string $navigationLabel = 'Células';
    protected static string|\UnitEnum|null $navigationGroup = 'Cadastros';
    protected static ?int $navigationSort = 8;

    protected static ?string $model = Cell::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return CellForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CellInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CellsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCells::route('/'),
            'create' => CreateCell::route('/create'),
            'view' => ViewCell::route('/{record}'),
            'edit' => EditCell::route('/{record}/edit'),
        ];
    }
}
