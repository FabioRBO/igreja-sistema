<?php

namespace App\Filament\Resources\SeminaryStudents\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class SeminaryStudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

            Select::make('church_id')
                ->label('Igreja')
                ->relationship('church', 'name')
                ->searchable()
                ->preload()
                ->required(),

            Select::make('person_id')
                ->label('Pessoa')
                ->relationship('person', 'name')
                ->searchable()
                ->preload()
                ->required(),

            TextInput::make('registration_number')
                ->label('Matrícula')
                ->maxLength(50),

            DatePicker::make('enrollment_date')
                ->label('Data da matrícula'),

            Select::make('status')
                ->label('Situação')
                ->options([
                    'ativo' => 'Ativo',
                    'trancado' => 'Trancado',
                    'formado' => 'Formado',
                    'desistente' => 'Desistente',
                ])
                ->default('ativo')
                ->required(),

            Textarea::make('notes')
                ->label('Observações')
                ->rows(4)
                ->columnSpanFull(),

        ]);
    }
}
