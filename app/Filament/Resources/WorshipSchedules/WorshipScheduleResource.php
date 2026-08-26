<?php

namespace App\Filament\Resources\WorshipSchedules;

use App\Filament\Resources\WorshipSchedules\Pages\CreateWorshipSchedule;
use App\Filament\Resources\WorshipSchedules\Pages\EditWorshipSchedule;
use App\Filament\Resources\WorshipSchedules\Pages\ListWorshipSchedules;
use App\Filament\Resources\WorshipSchedules\Schemas\WorshipScheduleForm;
use App\Filament\Resources\WorshipSchedules\Tables\WorshipSchedulesTable;
use App\Models\WorshipSchedule;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class WorshipScheduleResource extends Resource
{
    protected static ?string $model = WorshipSchedule::class;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedCalendarDays;

    protected static string|UnitEnum|null $navigationGroup = 'Louvor';

    protected static ?string $navigationLabel = 'Escalas';

    protected static ?string $modelLabel = 'Escala';

    protected static ?string $pluralModelLabel = 'Escalas';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return WorshipScheduleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WorshipSchedulesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWorshipSchedules::route('/'),
            'create' => CreateWorshipSchedule::route('/create'),
            'edit' => EditWorshipSchedule::route('/{record}/edit'),
        ];
    }
}