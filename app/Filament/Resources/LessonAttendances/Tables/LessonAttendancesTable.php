<?php

namespace App\Filament\Resources\LessonAttendances\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LessonAttendancesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lesson.lesson_date')
                    ->label('Data')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('lesson.title')
                    ->label('Aula')
                    ->searchable()
                    ->limit(35),

                TextColumn::make('enrollment.id')
                    ->label('Matrícula')
                    ->formatStateUsing(fn ($state): string => '#' . $state)
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Presença')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'present' => 'Presente',
                        'absent' => 'Falta',
                        'justified' => 'Justificada',
                        default => $state,
                    }),

                TextColumn::make('method')
                    ->label('Registro')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'manual' => 'Manual',
                        'qr_code' => 'QR Code',
                        default => $state,
                    }),

                TextColumn::make('check_in_at')
                    ->label('Horário')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('check_in_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Presença')
                    ->options([
                        'present' => 'Presente',
                        'absent' => 'Falta',
                        'justified' => 'Falta justificada',
                    ]),

                SelectFilter::make('method')
                    ->label('Forma de registro')
                    ->options([
                        'manual' => 'Manual',
                        'qr_code' => 'QR Code',
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
