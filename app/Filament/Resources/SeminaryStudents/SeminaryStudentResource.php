<?php

namespace App\Filament\Resources\SeminaryStudents;

use App\Filament\Resources\SeminaryStudents\Pages\CreateSeminaryStudent;
use App\Filament\Resources\SeminaryStudents\Pages\EditSeminaryStudent;
use App\Filament\Resources\SeminaryStudents\Pages\ListSeminaryStudents;
use App\Filament\Resources\SeminaryStudents\Schemas\SeminaryStudentForm;
use App\Filament\Resources\SeminaryStudents\Tables\SeminaryStudentsTable;
use App\Models\SeminaryStudent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SeminaryStudentResource extends Resource
{
    protected static ?string $modelLabel = 'Aluno';

    protected static ?string $pluralModelLabel = 'Alunos';

    protected static ?string $navigationLabel = 'Alunos';

    protected static string|\UnitEnum|null $navigationGroup = 'Seminário';

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static ?string $model = SeminaryStudent::class;


    protected static ?string $recordTitleAttribute = 'registration_number';

    public static function form(Schema $schema): Schema
    {
        return SeminaryStudentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SeminaryStudentsTable::configure($table);
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
            'index' => ListSeminaryStudents::route('/'),
            'create' => CreateSeminaryStudent::route('/create'),
            'edit' => EditSeminaryStudent::route('/{record}/edit'),
        ];
    }
}
