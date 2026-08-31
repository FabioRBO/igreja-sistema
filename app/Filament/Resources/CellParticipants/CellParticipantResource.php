<?php

namespace App\Filament\Resources\CellParticipants;

use App\Filament\Resources\CellParticipants\Pages\CreateCellParticipant;
use App\Filament\Resources\CellParticipants\Pages\EditCellParticipant;
use App\Filament\Resources\CellParticipants\Pages\ListCellParticipants;
use App\Filament\Resources\CellParticipants\Pages\ViewCellParticipant;
use App\Filament\Resources\CellParticipants\Schemas\CellParticipantForm;
use App\Filament\Resources\CellParticipants\Schemas\CellParticipantInfolist;
use App\Filament\Resources\CellParticipants\Tables\CellParticipantsTable;
use App\Models\CellParticipant;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CellParticipantResource extends Resource
{

    protected static ?string $modelLabel = 'Participante da célula';
    protected static ?string $pluralModelLabel = 'Célula - Participantes';
    protected static ?string $navigationLabel = 'Célula - Participantes';
    protected static string|\UnitEnum|null $navigationGroup = 'Cadastros';
    protected static ?int $navigationSort = 9;

    protected static ?string $model = CellParticipant::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserPlus;

    public static function form(Schema $schema): Schema
    {
        return CellParticipantForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CellParticipantInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CellParticipantsTable::configure($table);
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
            'index' => ListCellParticipants::route('/'),
            'create' => CreateCellParticipant::route('/create'),
            'view' => ViewCellParticipant::route('/{record}'),
            'edit' => EditCellParticipant::route('/{record}/edit'),
        ];
    }
}
