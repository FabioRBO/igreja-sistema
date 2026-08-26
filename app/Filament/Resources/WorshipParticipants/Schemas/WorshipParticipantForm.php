<?php

namespace App\Filament\Resources\WorshipParticipants\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class WorshipParticipantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados do participante')
                    ->schema([
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

                        Select::make('role_type')
                            ->label('Atuação')
                            ->options([
                                'vocal' => 'Vocal',
                                'instrumentalist' => 'Instrumentista',
                                'both' => 'Vocal e Instrumentista',
                            ])
                            ->required(),

                        Toggle::make('is_active')
                            ->label('Ativo')
                            ->default(true),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Instrumentos')
                    ->schema([
                        CheckboxList::make('instruments')
                            ->label('Quais instrumentos toca?')
                            ->options([
                                'violao' => 'Violão',
                                'guitarra' => 'Guitarra',
                                'baixo' => 'Baixo',
                                'teclado' => 'Teclado',
                                'bateria' => 'Bateria',
                                'cajon' => 'Cajón',
                                'saxofone' => 'Saxofone',
                                'flauta' => 'Flauta',
                                'outro' => 'Outro',
                            ])
                            ->columns(3),
                    ])
                    ->columnSpanFull(),

                Section::make('Disponibilidade')
                    ->schema([
                        CheckboxList::make('availability')
                            ->label('Melhores dias para servir')
                            ->options([
                                'wednesday' => 'Quarta-feira',
                                'sunday_morning' => 'Domingo de manhã',
                                'sunday_evening' => 'Domingo à noite',
                            ])
                            ->columns(3),
                    ])
                    ->columnSpanFull(),

                Section::make('Observações')
                    ->schema([
                        Textarea::make('notes')
                            ->label('Observações')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}