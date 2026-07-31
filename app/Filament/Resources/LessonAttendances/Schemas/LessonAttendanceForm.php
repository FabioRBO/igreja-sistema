<?php

namespace App\Filament\Resources\LessonAttendances\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class LessonAttendanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('uuid')
                    ->default(fn (): string => (string) Str::uuid()),

                Section::make('Registro de presença')
                    ->columns(2)
                    ->schema([
                        Select::make('church_id')
                            ->label('Igreja')
                            ->relationship('church', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('lesson_id')
                            ->label('Aula')
                            ->relationship('lesson', 'title')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('enrollment_id')
                            ->label('Matrícula')
                            ->relationship('enrollment', 'id')
                            ->getOptionLabelFromRecordUsing(
                                fn ($record): string => 'Matrícula #' . $record->id
                            )
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('status')
                            ->label('Presença')
                            ->options([
                                'present' => 'Presente',
                                'absent' => 'Falta',
                                'justified' => 'Falta justificada',
                            ])
                            ->default('present')
                            ->required(),

                        DateTimePicker::make('check_in_at')
                            ->label('Data e hora do registro')
                            ->seconds(false),

                        Select::make('method')
                            ->label('Forma de registro')
                            ->options([
                                'manual' => 'Manual',
                                'qr_code' => 'QR Code',
                            ])
                            ->default('manual')
                            ->required(),

                        Textarea::make('notes')
                            ->label('Observações')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
