<?php

namespace App\Filament\Resources\SeminaryStudents\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SeminaryStudentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

            TextColumn::make('church.name')
                ->label('Igreja')
                ->searchable(),

            TextColumn::make('person.full_name')
                ->label('Aluno')
                ->searchable(),
                
            TextColumn::make('registration_number')
                ->label('Matrícula')
                ->searchable(),

            TextColumn::make('status')
                ->label('Situação')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'ativo' => 'success',
                    'trancado' => 'warning',
                    'formado' => 'info',
                    default => 'danger',
                }),

            TextColumn::make('enrollment_date')
                ->label('Data da matrícula')
                ->date('d/m/Y')
                ->sortable(),

        ]);
    }
}
