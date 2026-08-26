<?php

namespace App\Filament\Resources\WorshipParticipants;

use App\Filament\Resources\WorshipParticipants\Pages\CreateWorshipParticipant;
use App\Filament\Resources\WorshipParticipants\Pages\EditWorshipParticipant;
use App\Filament\Resources\WorshipParticipants\Pages\ListWorshipParticipants;
use App\Filament\Resources\WorshipParticipants\Schemas\WorshipParticipantForm;
use App\Filament\Resources\WorshipParticipants\Tables\WorshipParticipantsTable;
use App\Models\WorshipParticipant;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class WorshipParticipantResource extends Resource
{
    protected static ?string $model = WorshipParticipant::class;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedMusicalNote;

    protected static string|UnitEnum|null $navigationGroup = 'Louvor';

    protected static ?string $navigationLabel = 'Participantes';

    protected static ?string $modelLabel = 'Participante';

    protected static ?string $pluralModelLabel = 'Participantes';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return WorshipParticipantForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WorshipParticipantsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWorshipParticipants::route('/'),
            'create' => CreateWorshipParticipant::route('/create'),
            'edit' => EditWorshipParticipant::route('/{record}/edit'),
        ];
    }
}