<?php

namespace App\Filament\Resources\LessonAttendances;

use App\Filament\Resources\LessonAttendances\Pages\CreateLessonAttendance;
use App\Filament\Resources\LessonAttendances\Pages\EditLessonAttendance;
use App\Filament\Resources\LessonAttendances\Pages\ListLessonAttendances;
use App\Filament\Resources\LessonAttendances\Schemas\LessonAttendanceForm;
use App\Filament\Resources\LessonAttendances\Tables\LessonAttendancesTable;
use App\Models\LessonAttendance;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LessonAttendanceResource extends Resource
{
    protected static ?string $model = LessonAttendance::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCheckCircle;

    protected static string|UnitEnum|null $navigationGroup = 'Seminário';

    protected static ?string $navigationLabel = 'Presenças';

    protected static ?string $modelLabel = 'Presença';

    protected static ?string $pluralModelLabel = 'Presenças';

    protected static ?int $navigationSort = 71;

    public static function form(Schema $schema): Schema
    {
        return LessonAttendanceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LessonAttendancesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLessonAttendances::route('/'),
            'create' => CreateLessonAttendance::route('/create'),
            'edit' => EditLessonAttendance::route('/{record}/edit'),
        ];
    }
}
