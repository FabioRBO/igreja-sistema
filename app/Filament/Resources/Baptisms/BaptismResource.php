<?php

namespace App\Filament\Resources\Baptisms;

use App\Filament\Resources\Baptisms\Pages\CreateBaptism;
use App\Filament\Resources\Baptisms\Pages\EditBaptism;
use App\Filament\Resources\Baptisms\Pages\ListBaptisms;
use App\Filament\Resources\Baptisms\Pages\ViewBaptism;
use App\Filament\Resources\Baptisms\Schemas\BaptismForm;
use App\Filament\Resources\Baptisms\Schemas\BaptismInfolist;
use App\Filament\Resources\Baptisms\Tables\BaptismsTable;
use App\Models\Baptism;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BaptismResource extends Resource
{

    protected static ?string $modelLabel = 'Batismo';
    protected static ?string $pluralModelLabel = 'Batismo';
    protected static ?string $navigationLabel = 'Batismo';
    protected static string|\UnitEnum|null $navigationGroup = 'Cadastros';
    protected static ?int $navigationSort = 5;

    protected static ?string $model = Baptism::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFire;

    public static function form(Schema $schema): Schema
    {
        return BaptismForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BaptismInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BaptismsTable::configure($table);
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
            'index' => ListBaptisms::route('/'),
            'create' => CreateBaptism::route('/create'),
            'view' => ViewBaptism::route('/{record}'),
            'edit' => EditBaptism::route('/{record}/edit'),
        ];
    }
}
