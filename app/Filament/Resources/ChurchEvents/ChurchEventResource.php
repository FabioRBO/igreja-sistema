<?php

namespace App\Filament\Resources\ChurchEvents;

use App\Filament\Resources\ChurchEvents\Pages\CreateChurchEvent;
use App\Filament\Resources\ChurchEvents\Pages\EditChurchEvent;
use App\Filament\Resources\ChurchEvents\Pages\ListChurchEvents;
use App\Filament\Resources\ChurchEvents\Schemas\ChurchEventForm;
use App\Filament\Resources\ChurchEvents\Tables\ChurchEventsTable;
use App\Models\ChurchEvent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ChurchEventResource extends Resource
{
    protected static ?string $model = ChurchEvent::class;

    protected static ?string $modelLabel = 'Culto / Evento';

    protected static ?string $pluralModelLabel = 'Cultos / Eventos';

    protected static ?string $navigationLabel = 'Cultos / Eventos';

    protected static string|\UnitEnum|null $navigationGroup = 'Cultos e Eventos';

    protected static ?int $navigationSort = 2;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedCalendarDays;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return ChurchEventForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ChurchEventsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListChurchEvents::route('/'),
            'create' => CreateChurchEvent::route('/create'),
            'edit' => EditChurchEvent::route('/{record}/edit'),
        ];
    }
}