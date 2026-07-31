<?php

namespace App\Filament\Resources\Grades\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GradesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('assessment.assessment_date')
                    ->label('Data')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('assessment.subjectOffering.subject.name')
                    ->label('Matéria')
                    ->searchable(),

                TextColumn::make('assessment.title')
                    ->label('Avaliação')
                    ->searchable(),

                TextColumn::make('enrollment.id')
                    ->label('Matrícula')
                    ->formatStateUsing(fn ($state): string => '#' . $state)
                    ->sortable(),

                TextColumn::make('score')
                    ->label('Nota')
                    ->numeric(decimalPlaces: 2)
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Lançada em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('updated_at', 'desc')
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
