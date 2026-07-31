<?php

namespace App\Filament\Resources\SubjectOfferings\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class SubjectOfferingForm
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

            Select::make('subject_id')
                ->label('Matéria')
                ->relationship('subject', 'name')
                ->required()
                ->searchable()
                ->preload(),

            Select::make('teacher_id')
                ->label('Professor')
                ->relationship('teacher.person', 'name')
                ->required()
                ->searchable()
                ->preload(),

            TextInput::make('class_name')
                ->label('Turma')
                ->required()
                ->maxLength(100),

            TextInput::make('room')
                ->label('Sala')
                ->maxLength(100),

            Select::make('modality')
                ->label('Modalidade')
                ->options([
                    'presencial' => 'Presencial',
                    'ead' => 'EAD',
                    'hibrido' => 'Híbrido',
                ])
                ->default('presencial')
                ->required(),

            TextInput::make('student_limit')
                ->label('Limite de alunos')
                ->numeric(),

            DatePicker::make('start_date')
                ->label('Início'),

            DatePicker::make('end_date')
                ->label('Fim'),

            Toggle::make('is_active')
                ->label('Ativa')
                ->default(true),

            Textarea::make('notes')
                ->label('Observações')
                ->columnSpanFull(),

        ])
        ->columns(2);
    }
}
