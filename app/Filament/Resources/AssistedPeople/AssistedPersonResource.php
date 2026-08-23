<?php

namespace App\Filament\Resources\AssistedPeople;

use App\Filament\Resources\AssistedPeople\Pages\CreateAssistedPerson;
use App\Filament\Resources\AssistedPeople\Pages\EditAssistedPerson;
use App\Filament\Resources\AssistedPeople\Pages\ListAssistedPeople;
use App\Filament\Resources\AssistedPeople\Schemas\AssistedPersonForm;
use App\Filament\Resources\AssistedPeople\Tables\AssistedPeopleTable;
use App\Models\AssistedPerson;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AssistedPersonResource extends Resource
{
    protected static ?string $model = AssistedPerson::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHeart;

    protected static string|UnitEnum|null $navigationGroup = 'Social';

    protected static ?string $navigationLabel = 'Assistidos';

    protected static ?string $modelLabel = 'Assistido';

    protected static ?string $pluralModelLabel = 'Assistidos';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return AssistedPersonForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AssistedPeopleTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAssistedPeople::route('/'),
            'create' => CreateAssistedPerson::route('/create'),
            'edit' => EditAssistedPerson::route('/{record}/edit'),
        ];
    }
}