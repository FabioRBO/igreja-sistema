<?php

namespace App\Filament\Resources\LogisticsDeliveries\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LogisticsDeliveryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Dados da Entrega / Devolução')
                    ->schema([
                        Select::make('church_id')
                            ->label('Igreja')
                            ->relationship('church', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('logistics_loan_id')
                            ->label('Empréstimo')
                            ->relationship('logisticsLoan', 'id')
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

                        Select::make('type')
                            ->label('Tipo')
                            ->options([
                                'delivery' => 'Entrega',
                                'return' => 'Devolução',
                            ])
                            ->native(false)
                            ->required(),

                        TextInput::make('quantity')
                            ->label('Quantidade')
                            ->numeric()
                            ->minValue(1)
                            ->default(1)
                            ->required(),

                        DatePicker::make('movement_date')
                            ->label('Data')
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->default(now())
                            ->required(),

                        Select::make('condition')
                            ->label('Estado do item')
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