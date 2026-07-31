<?php

namespace App\Filament\Resources\Lessons\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class LessonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('uuid')
                    ->default(fn (): string => (string) Str::uuid()),

                Section::make('Identificação da aula')
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

                        TextInput::make('lesson_number')
                            ->label('Número da aula')
                            ->numeric()
                            ->minValue(1),

                        TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Conteúdo ministrado')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),

                Section::make('Data e horário')
                    ->columns(3)
                    ->schema([
                        DatePicker::make('lesson_date')
                            ->label('Data da aula')
                            ->required()
                            ->native(false),

                        TimePicker::make('start_time')
                            ->label('Horário inicial')
                            ->seconds(false),

                        TimePicker::make('end_time')
                            ->label('Horário final')
                            ->seconds(false),

                        TextInput::make('room')
                            ->label('Sala ou local')
                            ->maxLength(255),

                        Select::make('status')
                            ->label('Situação')
                            ->options([
                                'scheduled' => 'Agendada',
                                'in_progress' => 'Em andamento',
                                'finished' => 'Encerrada',
                                'cancelled' => 'Cancelada',
                            ])
                            ->default('scheduled')
                            ->required(),
                    ]),

                Section::make('QR Code de presença')
                    ->columns(2)
                    ->schema([
                        Toggle::make('qr_enabled')
                            ->label('QR Code ativo')
                            ->default(false)
                            ->live(),

                        TextInput::make('qr_token')
                            ->label('Token do QR Code')
                            ->maxLength(100)
                            ->unique(ignoreRecord: true)
                            ->helperText('Pode ser gerado automaticamente depois, ao abrir a chamada.'),

                        TextInput::make('qr_expires_at')
                            ->label('Validade do QR Code')
                            ->type('datetime-local'),
                    ]),

                Textarea::make('notes')
                    ->label('Observações')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }
}
