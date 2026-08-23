<?php

namespace App\Filament\Resources\FinancialEntries;

use App\Filament\Resources\FinancialEntries\Pages\CreateFinancialEntry;
use App\Filament\Resources\FinancialEntries\Pages\EditFinancialEntry;
use App\Filament\Resources\FinancialEntries\Pages\ListFinancialEntries;
use App\Filament\Resources\FinancialEntries\Schemas\FinancialEntryForm;
use App\Filament\Resources\FinancialEntries\Tables\FinancialEntriesTable;
use App\Models\FinancialEntry;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class FinancialEntryResource extends Resource
{
    protected static ?string $model = FinancialEntry::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowsRightLeft;

    protected static string|UnitEnum|null $navigationGroup = 'Financeiro';

    protected static ?string $navigationLabel = 'Lançamentos';

    protected static ?string $modelLabel = 'Lançamento';

    protected static ?string $pluralModelLabel = 'Lançamentos Financeiros';

    protected static ?string $recordTitleAttribute = 'description';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return FinancialEntryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FinancialEntriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFinancialEntries::route('/'),
            'create' => CreateFinancialEntry::route('/create'),
            'edit' => EditFinancialEntry::route('/{record}/edit'),
        ];
    }
}