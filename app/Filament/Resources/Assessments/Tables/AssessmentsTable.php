<?php

namespace App\Filament\Resources\Assessments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AssessmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('assessment_date')
                    ->label('Data')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('subjectOffering.subject.name')
                    ->label('Matéria')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('title')
                    ->label('Avaliação')
                    ->searchable(),

                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'exam' => 'Prova',
                        'assignment' => 'Trabalho',
                        'seminar' => 'Seminário',
                        'exercise' => 'Exercício',
                        'recovery' => 'Recuperação',
                        default => $state,
                    }),

                TextColumn::make('maximum_score')
                    ->label('Nota máxima')
                    ->numeric(decimalPlaces: 2),

                TextColumn::make('weight')
                    ->label('Peso')
                    ->numeric(decimalPlaces: 2),

                IconColumn::make('is_active')
                    ->label('Ativa')
                    ->boolean(),
            ])
            ->defaultSort('assessment_date', 'desc')
            ->filters([
                SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'exam' => 'Prova',
                        'assignment' => 'Trabalho',
                        'seminar' => 'Seminário',
                        'exercise' => 'Exercício',
                        'recovery' => 'Recuperação',
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
