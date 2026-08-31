<?php

namespace App\Filament\Resources\InventoryMovements\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class InventoryMovementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('movement_date')
                    ->label('Data')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('item.name')
                    ->label('Item')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('type')
                    ->label('Tipo')
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'entry' => 'Entrada',
                        'exit' => 'Saída',
                        'transfer' => 'Transferência',
                        'loan' => 'Empréstimo',
                        'return' => 'Devolução',
                        'adjustment' => 'Ajuste',
                        default => '—',
                    })
                    ->sortable(),

                TextColumn::make('quantity')
                    ->label('Quantidade')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('origin')
                    ->label('Origem')
                    ->placeholder('—'),

                TextColumn::make('destination')
                    ->label('Destino')
                    ->placeholder('—'),

                TextColumn::make('responsiblePerson.name')
                    ->label('Responsável')
                    ->searchable()
                    ->placeholder('—'),

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
                    ->relationship('item', 'name'),

                SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'entry' => 'Entrada',
                        'exit' => 'Saída',
                        'transfer' => 'Transferência',
                        'loan' => 'Empréstimo',
                        'return' => 'Devolução',
                        'adjustment' => 'Ajuste',
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