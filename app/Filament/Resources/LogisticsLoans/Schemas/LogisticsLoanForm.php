<?php

namespace App\Filament\Resources\LogisticsLoans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LogisticsLoanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Dados do Empréstimo')
                    ->schema([
                        Select::make('church_id')
                            ->label('Igreja')
                            ->relationship('church', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('logistics_request_id')
                            ->label('Solicitação')
                            ->relationship('logisticsRequest', 'title')
                            ->searchable()
                            ->preload()
                            ->nullable(),

                        Select::make('logistics_reservation_id')
                            ->label('Reserva')
                            ->relationship('logisticsReservation', 'id')
                            ->searchable()
                            ->preload()
                            ->nullable(),

                        Select::make('inventory_item_id')
                            ->label('Item / Patrimônio')
                            ->relationship('inventoryItem', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('responsible_person_id')
                            ->label('Responsável')
                            ->relationship('responsiblePerson', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),

                        TextInput::make('quantity')
                            ->label('Quantidade')
                            ->numeric()
                            ->minValue(1)
                            ->default(1)
                            ->required(),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'loaned' => 'Emprestado',
                                'returned' => 'Devolvido',
                                'overdue' => 'Atrasado',
                                'cancelled' => 'Cancelado',
                            ])
                            ->default('loaned')
                            ->native(false)
                            ->required(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Datas')
                    ->schema([
                        DatePicker::make('loan_date')
                            ->label('Data do empréstimo')
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->default(now())
                            ->required(),

                        DatePicker::make('expected_return_date')
                            ->label('Previsão de devolução')
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->afterOrEqual('loan_date'),

                        DatePicker::make('return_date')
                            ->label('Data da devolução')
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->afterOrEqual('loan_date'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Estado do Patrimônio')
                    ->schema([
                        Select::make('condition_on_loan')
                            ->label('Estado na retirada')
                            ->options([
                                'new' => 'Novo',
                                'excellent' => 'Ótimo',
                                'good' => 'Bom',
                                'regular' => 'Regular',
                                'bad' => 'Ruim',
                                'unusable' => 'Inutilizado',
                            ])
                            ->native(false),

                        Select::make('condition_on_return')
                            ->label('Estado na devolução')
                            ->options([
                                'new' => 'Novo',
                                'excellent' => 'Ótimo',
                                'good' => 'Bom',
                                'regular' => 'Regular',
                                'bad' => 'Ruim',
                                'unusable' => 'Inutilizado',
                            ])
                            ->native(false),
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