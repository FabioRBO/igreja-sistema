<?php

namespace App\Filament\Resources\LogisticsDeliveries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LogisticsDeliveriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('movement_date')
                    ->label('Data')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('type')
                    ->label('Tipo')
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'delivery' => 'Entrega',
                        'return' => 'Devolução',
                        default => '—',
                    })
                    ->sortable(),

                TextColumn::make('inventoryItem.name')
                    ->label('Item')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('quantity')
                    ->label('Quantidade')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('responsiblePerson.name')
                    ->label('Responsável')
                    ->searchable()
                    ->placeholder('—'),

                TextColumn::make('condition')
                    ->label('Conservação')
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'new' => 'Novo',
                        'excellent' => 'Ótimo',
                        'good' => 'Bom',
                        'regular' => 'Regular',
                        'bad' => 'Ruim',
                        'unusable' => 'Inutilizado',
                        default => '—',
                    }),

                TextColumn::make('logisticsLoan.id')
                    ->label('Empréstimo')
                    ->placeholder('—')
                    ->toggleable(),

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
            ->defaultSort('movement_date', 'desc')
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

                SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'delivery' => 'Entrega',
                        'return' => 'Devolução',
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