<?php

namespace App\Filament\Resources\WorshipSchedules\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class WorshipSchedulesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('schedule_date')
                    ->label('Data')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('service_type')
                    ->label('Culto')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'wednesday' => 'Quarta-feira',
                        'sunday_morning' => 'Domingo manhã',
                        'sunday_evening' => 'Domingo noite',
                        'special' => 'Especial',
                        default => $state,
                    }),

                TextColumn::make('start_time')
                    ->label('Horário')
                    ->time('H:i')
                    ->placeholder('—'),

                TextColumn::make('title')
                    ->label('Título')
                    ->placeholder('—')
                    ->searchable(),

                TextColumn::make('participants_count')
                    ->label('Participantes')
                    ->counts('participants')
                    ->badge(),

                TextColumn::make('church.name')
                    ->label('Igreja')
                    ->searchable()
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->label('Ativa')
                    ->boolean(),
            ])
            ->defaultSort('schedule_date', 'desc')
            ->filters([
                SelectFilter::make('service_type')
                    ->label('Culto')
                    ->options([
                        'wednesday' => 'Quarta-feira',
                        'sunday_morning' => 'Domingo de manhã',
                        'sunday_evening' => 'Domingo à noite',
                        'special' => 'Especial',
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