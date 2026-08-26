<?php

namespace App\Filament\Resources\ChurchEvents\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ChurchEventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('event_date')
                    ->label('Data')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('start_time')
                    ->label('Horário')
                    ->time('H:i')
                    ->placeholder('—'),

                TextColumn::make('title')
                    ->label('Culto / Evento')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('eventType.name')
                    ->label('Tipo')
                    ->badge()
                    ->sortable(),

                TextColumn::make('preachers.name')
                    ->label('Pregadores')
                    ->badge()
                    ->separator(', ')
                    ->limitList(3),

                TextColumn::make('location')
                    ->label('Local')
                    ->placeholder('—')
                    ->toggleable(),

                IconColumn::make('publish_on_site')
                    ->label('Site')
                    ->boolean(),

                IconColumn::make('is_active')
                    ->label('Ativo')
                    ->boolean(),
            ])
            ->defaultSort('event_date', 'desc')
            ->filters([
                SelectFilter::make('event_type_id')
                    ->label('Tipo')
                    ->relationship('eventType', 'name'),

                SelectFilter::make('church_id')
                    ->label('Igreja')
                    ->relationship('church', 'name'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}