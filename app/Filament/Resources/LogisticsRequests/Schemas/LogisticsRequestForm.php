<?php

namespace App\Filament\Resources\LogisticsRequests\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LogisticsRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Dados da Solicitação')
                    ->schema([
                        Select::make('church_id')
                            ->label('Igreja')
                            ->relationship('church', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('requester_person_id')
                            ->label('Solicitante')
                            ->relationship('requesterPerson', 'name')
                            ->searchable()
                            ->preload(),

                        TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pendente',
                                'approved' => 'Aprovada',
                                'rejected' => 'Recusada',
                                'in_progress' => 'Em andamento',
                                'completed' => 'Concluída',
                                'cancelled' => 'Cancelada',
                            ])
                            ->default('pending')
                            ->native(false)
                            ->required(),

                        DatePicker::make('request_date')
                            ->label('Data da solicitação')
                            ->default(now())
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->required(),

                        DatePicker::make('needed_date')
                            ->label('Data necessária')
                            ->native(false)
                            ->displayFormat('d/m/Y'),

                        DatePicker::make('return_date')
                            ->label('Previsão de devolução')
                            ->native(false)
                            ->displayFormat('d/m/Y'),

                        TextInput::make('destination')
                            ->label('Destino')
                            ->placeholder('Ex.: Retiro, Célula, Salão, Evento'),

                        Textarea::make('description')
                            ->label('Descrição')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Itens Solicitados')
                    ->schema([
                        Repeater::make('items')
                            ->label('Itens')
                            ->relationship('items')
                            ->schema([
                                Select::make('inventory_item_id')
                                    ->label('Item / Patrimônio')
                                    ->relationship('inventoryItem', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems(),

                                TextInput::make('quantity')
                                    ->label('Quantidade')
                                    ->numeric()
                                    ->minValue(1)
                                    ->default(1)
                                    ->required(),

                                Textarea::make('notes')
                                    ->label('Observação')
                                    ->rows(2)
                                    ->columnSpanFull(),
                            ])
                            ->columns(2)
                            ->addActionLabel('Adicionar item')
                            ->reorderable(false)
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                Section::make('Observações')
                    ->schema([
                        Textarea::make('notes')
                            ->label('Observações gerais')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}