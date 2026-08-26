<?php

namespace App\Filament\Resources\EventTypes;

use App\Filament\Resources\EventTypes\Pages\CreateEventType;
use App\Filament\Resources\EventTypes\Pages\EditEventType;
use App\Filament\Resources\EventTypes\Pages\ListEventTypes;
use App\Filament\Resources\EventTypes\Schemas\EventTypeForm;
use App\Filament\Resources\EventTypes\Tables\EventTypesTable;
use App\Models\EventType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EventTypeResource extends Resource
{
    protected static ?string $model = EventType::class;

    protected static ?string $modelLabel = 'Tipo de Culto / Evento';

    protected static ?string $pluralModelLabel = 'Tipos de Culto / Evento';

    protected static ?string $navigationLabel = 'Tipos';

    protected static string|\UnitEnum|null $navigationGroup = 'Cultos e Eventos';

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedTag;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return EventTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EventTypesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEventTypes::route('/'),
            'create' => CreateEventType::route('/create'),
            'edit' => EditEventType::route('/{record}/edit'),
        ];
    }
}