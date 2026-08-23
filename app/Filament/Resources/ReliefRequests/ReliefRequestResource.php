<?php

namespace App\Filament\Resources\ReliefRequests;

use App\Filament\Resources\ReliefRequests\Pages\CreateReliefRequest;
use App\Filament\Resources\ReliefRequests\Pages\EditReliefRequest;
use App\Filament\Resources\ReliefRequests\Pages\ListReliefRequests;
use App\Filament\Resources\ReliefRequests\Schemas\ReliefRequestForm;
use App\Filament\Resources\ReliefRequests\Tables\ReliefRequestsTable;
use App\Models\ReliefRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ReliefRequestResource extends Resource
{
    protected static ?string $model = ReliefRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHandRaised;

    protected static string|UnitEnum|null $navigationGroup = 'Social';

    protected static ?string $navigationLabel = 'Socorros';

    protected static ?string $modelLabel = 'Socorro';

    protected static ?string $pluralModelLabel = 'Socorros';

    protected static ?string $recordTitleAttribute = 'type';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return ReliefRequestForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReliefRequestsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListReliefRequests::route('/'),
            'create' => CreateReliefRequest::route('/create'),
            'edit' => EditReliefRequest::route('/{record}/edit'),
        ];
    }
}