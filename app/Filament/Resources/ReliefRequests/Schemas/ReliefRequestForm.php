<?php

namespace App\Filament\Resources\ReliefRequests\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ReliefRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Solicitação')
                    ->description('Dados do pedido de socorro.')
                    ->schema([
                        Select::make('church_id')
                            ->label('Igreja')
                            ->relationship('church', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('assisted_person_id')
                            ->label('Assistido')
                            ->relationship('assistedPerson', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('type')
                            ->label('Tipo de socorro')
                            ->options([
                                'prayer' => 'Pedido de oração',
                                'food' => 'Alimento',
                                'deliverance' => 'Libertação',
                                'replacement' => 'Substituição',
                                'transport' => 'Transporte',
                                'other' => 'Outro',
                            ])
                            ->required(),

                        Select::make('priority')
                            ->label('Prioridade')
                            ->options([
                                'low' => 'Baixa',
                                'normal' => 'Normal',
                                'high' => 'Alta',
                                'urgent' => 'Urgente',
                            ])
                            ->default('normal')
                            ->required(),

                        DateTimePicker::make('requested_at')
                            ->label('Data da solicitação')
                            ->default(now())
                            ->seconds(false)
                            ->required(),

                        Textarea::make('description')
                            ->label('Descrição do pedido')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Atendimento')
                    ->description('Acompanhamento e conclusão do socorro.')
                    ->schema([
                        Select::make('responsible_person_id')
                            ->label('Responsável')
                            ->relationship('responsiblePerson', 'name')
                            ->searchable()
                            ->preload(),

                        Select::make('status')
                            ->label('Situação')
                            ->options([
                                'open' => 'Aberto',
                                'in_progress' => 'Em atendimento',
                                'completed' => 'Atendido',
                                'cancelled' => 'Cancelado',
                            ])
                            ->default('open')
                            ->required(),

                        DateTimePicker::make('completed_at')
                            ->label('Data do atendimento')
                            ->seconds(false),
                    ])
                    ->columns(2)
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