<?php

namespace App\Filament\Resources\Assessments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class AssessmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('uuid')
                    ->default(fn (): string => (string) Str::uuid()),

                Section::make('Dados da avaliação')
                    ->columns(2)
                    ->schema([
                        Select::make('church_id')
                            ->label('Igreja')
                            ->relationship('church', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('subject_offering_id')
                            ->label('Oferta da matéria')
                            ->relationship('subjectOffering', 'class_name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('title')
                            ->label('Nome da avaliação')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Select::make('type')
                            ->label('Tipo')
                            ->options([
                                'exam' => 'Prova',
                                'assignment' => 'Trabalho',
                                'seminar' => 'Seminário',
                                'exercise' => 'Exercício',
                                'recovery' => 'Recuperação',
                            ])
                            ->default('exam')
                            ->required(),

                        DatePicker::make('assessment_date')
                            ->label('Data')
                            ->native(false),

                        TextInput::make('maximum_score')
                            ->label('Nota máxima')
                            ->numeric()
                            ->default(10)
                            ->minValue(0)
                            ->required(),

                        TextInput::make('weight')
                            ->label('Peso')
                            ->numeric()
                            ->default(1)
                            ->minValue(0)
                            ->required(),

                        Toggle::make('is_active')
                            ->label('Ativa')
                            ->default(true),

                        Textarea::make('notes')
                            ->label('Observações')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
