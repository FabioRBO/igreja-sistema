<?php

namespace App\Filament\Resources\WorshipSchedules\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class WorshipScheduleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados da escala')
                    ->schema([
                        Select::make('church_id')
                            ->label('Igreja')
                            ->relationship('church', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        DatePicker::make('schedule_date')
                            ->label('Data')
                            ->native(false)
                            ->required(),

                        Select::make('service_type')
                            ->label('Culto / Horário')
                            ->options([
                                'wednesday' => 'Quarta-feira',
                                'sunday_morning' => 'Domingo de manhã',
                                'sunday_evening' => 'Domingo à noite',
                                'special' => 'Culto / Evento especial',
                            ])
                            ->required(),

                        TimePicker::make('start_time')
                            ->label('Horário')
                            ->seconds(false),

                        TextInput::make('title')
                            ->label('Título')
                            ->placeholder('Ex.: Culto de Celebração')
                            ->maxLength(255),

                        Toggle::make('is_active')
                            ->label('Ativa')
                            ->default(true),

                        Textarea::make('notes')
                            ->label('Observações')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Equipe escalada')
                    ->description('Selecione os participantes que servirão nesta escala.')
                    ->schema([
                        Select::make('participants')
                            ->label('Participantes')
                            ->relationship(
                                name: 'participants',
                                titleAttribute: 'id',
                            )
                            ->getOptionLabelFromRecordUsing(
                                fn ($record): string =>
                                    $record->person?->name ?? 'Participante #' . $record->id
                            )
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}