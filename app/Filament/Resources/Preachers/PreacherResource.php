<?php

namespace App\Filament\Resources\Preachers;

use App\Filament\Resources\Preachers\Pages\CreatePreacher;
use App\Filament\Resources\Preachers\Pages\EditPreacher;
use App\Filament\Resources\Preachers\Pages\ListPreachers;
use App\Filament\Resources\Preachers\Schemas\PreacherForm;
use App\Filament\Resources\Preachers\Tables\PreachersTable;
use App\Models\Preacher;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PreacherResource extends Resource
{
    protected static ?string $model = Preacher::class;

    protected static ?string $modelLabel = 'Pregador';

    protected static ?string $pluralModelLabel = 'Pregadores';

    protected static ?string $navigationLabel = 'Pregadores';

    protected static string|\UnitEnum|null $navigationGroup = 'Cadastros';

    protected static ?int $navigationSort = 10;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedUserCircle;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return PreacherForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PreachersTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPreachers::route('/'),
            'create' => CreatePreacher::route('/create'),
            'edit' => EditPreacher::route('/{record}/edit'),
        ];
    }
}