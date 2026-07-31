<?php

namespace App\Filament\Resources\Lessons\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LessonsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lesson_date')
                    ->label('Data')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('subjectOffering.subject.name')
                    ->label('Matéria')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('title')
                    ->label('Aula')
                    ->searchable()
                    ->limit(40),

                TextColumn::make('lesson_number')
                    ->label('Nº')
                    ->sortable(),

                TextColumn::make('start_time')
                    ->label('Início')
                    ->time('H:i'),

                TextColumn::make('status')
                    ->label('Situação')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'scheduled' => 'Agendada',
                        'in_progress' => 'Em andamento',
                        'finished' => 'Encerrada',
                        'cancelled' => 'Cancelada',
                        default => $state,
                    }),

                IconColumn::make('qr_enabled')
                    ->label('QR')
                    ->boolean(),

                TextColumn::make('updated_at')
                    ->label('Atualizada')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('lesson_date', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Situação')
                    ->options([
                        'scheduled' => 'Agendada',
                        'in_progress' => 'Em andamento',
                        'finished' => 'Encerrada',
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
