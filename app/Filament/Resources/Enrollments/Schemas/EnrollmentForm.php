<?php

namespace App\Filament\Resources\Enrollments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class EnrollmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('church_id')
                    ->label('Igreja')
                    ->relationship('church', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),

                Select::make('person_id')
                    ->label('Aluno')
                    ->relationship('person', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),

                Select::make('course_id')
                    ->label('Curso')
                    ->relationship('course', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),

                Select::make('academic_year_id')
                    ->label('Período Letivo')
                    ->relationship('academicYear', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),

                DatePicker::make('enrollment_date')
                    ->label('Data da matrícula')
                    ->required(),

                Select::make('status')
                    ->label('Situação')
                    ->options([
                        'matriculado' => 'Matriculado',
                        'trancado' => 'Trancado',
                        'concluido' => 'Concluído',
                        'desistente' => 'Desistente',
                    ])
                    ->default('matriculado')
                    ->required(),

                Textarea::make('notes')
                    ->label('Observações')
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }
}