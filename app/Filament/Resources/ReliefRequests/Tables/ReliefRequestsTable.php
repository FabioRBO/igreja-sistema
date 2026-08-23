<?php

namespace App\Filament\Resources\ReliefRequests\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ReliefRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('requested_at')
                    ->label('Data')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                TextColumn::make('assistedPerson.name')
                    ->label('Assistido')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('type')
                    ->label('Socorro')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'prayer' => 'Pedido de oração',
                        'food' => 'Alimento',
                        'deliverance' => 'Libertação',
                        'replacement' => 'Substituição',
                        'transport' => 'Transporte',
                        'other' => 'Outro',
                        default => $state,
                    }),

                TextColumn::make('priority')
                    ->label('Prioridade')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'low' => 'Baixa',
                        'normal' => 'Normal',
                        'high' => 'Alta',
                        'urgent' => 'Urgente',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'low' => 'gray',
                        'normal' => 'info',
                        'high' => 'warning',
                        'urgent' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('responsiblePerson.name')
                    ->label('Responsável')
                    ->placeholder('Não definido')
                    ->searchable(),

                TextColumn::make('status')
                    ->label('Situação')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'open' => 'Aberto',
                        'in_progress' => 'Em atendimento',
                        'completed' => 'Atendido',
                        'cancelled' => 'Cancelado',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'open' => 'warning',
                        'in_progress' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('completed_at')
                    ->label('Atendido em')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('—')
                    ->toggleable(),
            ])
            ->defaultSort('requested_at', 'desc')
            ->filters([
                SelectFilter::make('type')
                    ->label('Tipo de socorro')
                    ->options([
                        'prayer' => 'Pedido de oração',
                        'food' => 'Alimento',
                        'deliverance' => 'Libertação',
                        'replacement' => 'Substituição',
                        'transport' => 'Transporte',
                        'other' => 'Outro',
                    ]),

                SelectFilter::make('priority')
                    ->label('Prioridade')
                    ->options([
                        'low' => 'Baixa',
                        'normal' => 'Normal',
                        'high' => 'Alta',
                        'urgent' => 'Urgente',
                    ]),

                SelectFilter::make('status')
                    ->label('Situação')
                    ->options([
                        'open' => 'Aberto',
                        'in_progress' => 'Em atendimento',
                        'completed' => 'Atendido',
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