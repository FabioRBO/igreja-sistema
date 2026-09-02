<?php

namespace App\Filament\Resources\LogisticsReservations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LogisticsReservationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('inventoryItem.name')
                    ->label('Item')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('quantity')
                    ->label('Quantidade')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('start_date')
                    ->label('Data inicial')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('end_date')
                    ->label('Data final')
                    ->date('d/m/Y')
                    ->placeholder('—')
                    ->sortable(),

                TextColumn::make('responsiblePerson.name')
                    ->label('Responsável')
                    ->searchable()
                    ->placeholder('—'),

                TextColumn::make('logisticsRequest.title')
                    ->label('Solicitação')
                    ->searchable()
                    ->placeholder('—')
                    ->toggleable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'reserved' => 'Reservada',
                        'in_use' => 'Em uso',
                        'completed' => 'Concluída',
                        'cancelled' => 'Cancelada',
                        default => '—',
                    })
                    ->sortable(),

                TextColumn::make('church.name')
                    ->label('Igreja')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Data de cadastro')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Última alteração')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('start_date', 'desc')
            ->filters([
                SelectFilter::make('church_id')
                    ->label('Igreja')
                    ->relationship('church', 'name'),

                SelectFilter::make('inventory_item_id')
                    ->label('Item')
                    ->relationship('inventoryItem', 'name'),

                SelectFilter::make('responsible_person_id')
                    ->label('Responsável')
                    ->relationship('responsiblePerson', 'name'),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'reserved' => 'Reservada',
                        'in_use' => 'Em uso',
                        'completed' => 'Concluída',
                        'cancelled' => 'Cancelada',
                    ]),
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