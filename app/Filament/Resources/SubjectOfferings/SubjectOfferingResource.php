<?php

namespace App\Filament\Resources\SubjectOfferings;

use App\Filament\Resources\SubjectOfferings\Pages\CreateSubjectOffering;
use App\Filament\Resources\SubjectOfferings\Pages\EditSubjectOffering;
use App\Filament\Resources\SubjectOfferings\Pages\ListSubjectOfferings;
use App\Filament\Resources\SubjectOfferings\Pages\ViewSubjectOffering;
use App\Filament\Resources\SubjectOfferings\Schemas\SubjectOfferingForm;
use App\Filament\Resources\SubjectOfferings\Schemas\SubjectOfferingInfolist;
use App\Filament\Resources\SubjectOfferings\Tables\SubjectOfferingsTable;
use App\Models\SubjectOffering;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubjectOfferingResource extends Resource
{
    protected static ?string $model = SubjectOffering::class;

    protected static ?string $modelLabel = 'Oferta de Matéria';

    protected static ?string $pluralModelLabel = 'Ofertas de Matérias';

    protected static ?string $navigationLabel = 'Ofertas de Matérias';

    protected static string|\UnitEnum|null $navigationGroup = 'Seminário';

    protected static ?int $navigationSort = 16;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static ?string $recordTitleAttribute = 'class_name';

    public static function form(Schema $schema): Schema
    {
        return SubjectOfferingForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SubjectOfferingInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SubjectOfferingsTable::configure($table);
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
            'index' => ListSubjectOfferings::route('/'),
            'create' => CreateSubjectOffering::route('/create'),
            'view' => ViewSubjectOffering::route('/{record}'),
            'edit' => EditSubjectOffering::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
