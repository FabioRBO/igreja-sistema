<?php

namespace App\Filament\Resources\LogisticsRequests;

use App\Filament\Resources\LogisticsRequests\Pages\CreateLogisticsRequest;
use App\Filament\Resources\LogisticsRequests\Pages\EditLogisticsRequest;
use App\Filament\Resources\LogisticsRequests\Pages\ListLogisticsRequests;
use App\Filament\Resources\LogisticsRequests\Schemas\LogisticsRequestForm;
use App\Filament\Resources\LogisticsRequests\Tables\LogisticsRequestsTable;
use App\Models\LogisticsRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LogisticsRequestResource extends Resource
{
    protected static ?string $model = LogisticsRequest::class;

    protected static ?string $modelLabel = 'Solicitação Logística';

    protected static ?string $pluralModelLabel = 'Solicitações Logísticas';

    protected static ?string $navigationLabel = 'Solicitações';

    protected static string|\UnitEnum|null $navigationGroup = 'Logística';

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedClipboardDocumentList;

    public static function form(Schema $schema): Schema
    {
        return LogisticsRequestForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LogisticsRequestsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLogisticsRequests::route('/'),
            'create' => CreateLogisticsRequest::route('/create'),
            'edit' => EditLogisticsRequest::route('/{record}/edit'),
        ];
    }
}