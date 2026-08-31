<?php

namespace App\Filament\Resources\CellMeetings;

use App\Filament\Resources\CellMeetings\Pages\CreateCellMeeting;
use App\Filament\Resources\CellMeetings\Pages\EditCellMeeting;
use App\Filament\Resources\CellMeetings\Pages\ListCellMeetings;
use App\Filament\Resources\CellMeetings\Schemas\CellMeetingForm;
use App\Filament\Resources\CellMeetings\Tables\CellMeetingsTable;
use App\Models\CellMeeting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CellMeetingResource extends Resource
{
    protected static ?string $model = CellMeeting::class;

    protected static ?string $modelLabel = 'Reunião de Célula';

    protected static ?string $pluralModelLabel = 'Reuniões de Célula';

    protected static ?string $navigationLabel = 'Reuniões de Célula';

    protected static string|\UnitEnum|null $navigationGroup = 'Cadastros';

    protected static ?int $navigationSort = 10;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedUserGroup;

    public static function form(Schema $schema): Schema
    {
        return CellMeetingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CellMeetingsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCellMeetings::route('/'),
            'create' => CreateCellMeeting::route('/create'),
            'edit' => EditCellMeeting::route('/{record}/edit'),
        ];
    }
}