<?php

namespace App\Filament\Resources\LogisticsLoans;

use App\Filament\Resources\LogisticsLoans\Pages\CreateLogisticsLoan;
use App\Filament\Resources\LogisticsLoans\Pages\EditLogisticsLoan;
use App\Filament\Resources\LogisticsLoans\Pages\ListLogisticsLoans;
use App\Filament\Resources\LogisticsLoans\Schemas\LogisticsLoanForm;
use App\Filament\Resources\LogisticsLoans\Tables\LogisticsLoansTable;
use App\Models\LogisticsLoan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LogisticsLoanResource extends Resource
{
    protected static ?string $model = LogisticsLoan::class;

    protected static ?string $modelLabel = 'Empréstimo';

    protected static ?string $pluralModelLabel = 'Empréstimos';

    protected static ?string $navigationLabel = 'Empréstimos';

    protected static string|\UnitEnum|null $navigationGroup = 'Logística';

    protected static ?int $navigationSort = 3;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedArrowUpOnSquare;

    public static function form(Schema $schema): Schema
    {
        return LogisticsLoanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LogisticsLoansTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLogisticsLoans::route('/'),
            'create' => CreateLogisticsLoan::route('/create'),
            'edit' => EditLogisticsLoan::route('/{record}/edit'),
        ];
    }
}