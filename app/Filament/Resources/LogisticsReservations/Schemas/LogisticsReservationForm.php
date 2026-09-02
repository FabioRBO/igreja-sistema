<?php

namespace App\Filament\Resources\LogisticsReservations\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LogisticsReservationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Dados da Reserva')
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

                        Select::make('inventory_item_id')
                            ->label('Item / Patrimônio')
                            ->relationship('inventoryItem', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('quantity')
                            ->label('Quantidade')
                            ->numeric()
                            ->minValue(1)
                            ->default(1)
                            ->required(),

                        Select::make('responsible_person_id')
                            ->label('Responsável')
                            ->relationship('responsiblePerson', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'reserved' => 'Reservada',
                                'in_use' => 'Em uso',
                                'completed' => 'Concluída',
                                'cancelled' => 'Cancelada',
                            ])
                            ->default('reserved')
                            ->native(false)
                            ->required(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Período')
                    ->schema([
                        DatePicker::make('start_date')
                            ->label('Data inicial')
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->default(now())
                            ->required(),

                        DatePicker::make('end_date')
                            ->label('Data final')
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->afterOrEqual('start_date'),
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