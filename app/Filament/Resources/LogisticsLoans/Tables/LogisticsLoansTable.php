<?php

namespace App\Filament\Resources\LogisticsLoans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LogisticsLoansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('inventoryItem.name')
                    ->label('Item')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('responsiblePerson.name')
                    ->label('Responsável')
                    ->searchable()
                    ->placeholder('—'),

                TextColumn::make('quantity')
                    ->label('Quantidade')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('loan_date')
                    ->label('Empréstimo')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('expected_return_date')
                    ->label('Previsão')
                    ->date('d/m/Y')
                    ->placeholder('—')
                    ->sortable(),

                TextColumn::make('return_date')
                    ->label('Devolução')
                    ->date('d/m/Y')
                    ->placeholder('—')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'loaned' => 'Emprestado',
                        'returned' => 'Devolvido',
                        'overdue' => 'Atrasado',
                        'cancelled' => 'Cancelado',
                        default => '—',
                    })
                    ->sortable(),

                TextColumn::make('condition_on_loan')
                    ->label('Estado na saída')
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'new' => 'Novo',
                        'excellent' => 'Ótimo',
                        'good' => 'Bom',
                        'regular' => 'Regular',
                        'bad' => 'Ruim',
                        'unusable' => 'Inutilizado',
                        default => '—',
                    })
                    ->toggleable(),

                TextColumn::make('condition_on_return')
                    ->label('Estado na devolução')
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'new' => 'Novo',
                        'excellent' => 'Ótimo',
                        'good' => 'Bom',
                        'regular' => 'Regular',
                        'bad' => 'Ruim',
                        'unusable' => 'Inutilizado',
                        default => '—',
                    })
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
            ->defaultSort('loan_date', 'desc')
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
                        'loaned' => 'Emprestado',
                        'returned' => 'Devolvido',
                        'overdue' => 'Atrasado',
                        'cancelled' => 'Cancelado',
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