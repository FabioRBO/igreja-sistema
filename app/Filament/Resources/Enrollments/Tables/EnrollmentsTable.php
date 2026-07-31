<?php

namespace App\Filament\Resources\Enrollments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;


class EnrollmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

            TextColumn::make('person.name')
                ->label('Aluno')
                ->searchable()
                ->sortable(),

            TextColumn::make('course.name')
                ->label('Curso')
                ->searchable()
                ->sortable(),

            TextColumn::make('academicYear.name')
                ->label('Período Letivo')
                ->sortable(),

            TextColumn::make('enrollment_date')
                ->label('Matrícula')
                ->date('d/m/Y')
                ->sortable(),

            BadgeColumn::make('status')
                ->label('Situação')
                ->colors([
                    'success' => 'matriculado',
                    'warning' => 'trancado',
                    'primary' => 'concluido',
                    'danger' => 'desistente',
                ]),

            IconColumn::make('is_active')
                ->boolean()
                ->toggleable(isToggledHiddenByDefault: true),

            TextColumn::make('updated_at')
                ->label('Atualizado')
                ->since()
                ->toggleable(),

        ]);
    }
}
