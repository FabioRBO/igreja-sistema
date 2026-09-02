<?php

namespace App\Filament\Resources\LogisticsRequests\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LogisticsRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Solicitação')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('requesterPerson.name')
                    ->label('Solicitante')
                    ->searchable()
                    ->placeholder('—'),

                TextColumn::make('request_date')
                    ->label('Solicitada em')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('needed_date')
                    ->label('Data necessária')
                    ->date('d/m/Y')
                    ->placeholder('—')
                    ->sortable(),

                TextColumn::make('return_date')
                    ->label('Devolução')
                    ->date('d/m/Y')
                    ->placeholder('—')
                    ->sortable(),

                TextColumn::make('items_count')
                    ->label('Itens')
                    ->counts('items')
                    ->sortable(),

                TextColumn::make('destination')
                    ->label('Destino')
                    ->searchable()
                    ->placeholder('—'),

                TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'pending' => 'Pendente',
                        'approved' => 'Aprovada',
                        'rejected' => 'Recusada',
                        'in_progress' => 'Em andamento',
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
            ->defaultSort('request_date', 'desc')
            ->filters([
                SelectFilter::make('church_id')
                    ->label('Igreja')
                    ->relationship('church', 'name'),

                SelectFilter::make('requester_person_id')
                    ->label('Solicitante')
                    ->relationship('requesterPerson', 'name'),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pendente',
                        'approved' => 'Aprovada',
                        'rejected' => 'Recusada',
                        'in_progress' => 'Em andamento',
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