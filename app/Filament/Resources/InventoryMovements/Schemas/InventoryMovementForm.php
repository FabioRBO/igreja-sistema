<?php

namespace App\Filament\Resources\InventoryMovements\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class InventoryMovementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Dados da Movimentação')
                    ->schema([
                        Select::make('church_id')
                            ->label('Igreja')
                            ->relationship('church', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('inventory_item_id')
                            ->label('Item / Patrimônio')
                            ->relationship('item', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('type')
                            ->label('Tipo de movimentação')
                            ->options([
                                'entry' => 'Entrada',
                                'exit' => 'Saída',
                                'transfer' => 'Transferência',
                                'loan' => 'Empréstimo',
                                'return' => 'Devolução',
                                'adjustment' => 'Ajuste',
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
                            ->label('Data da movimentação')
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->default(now())
                            ->required(),

                        Select::make('responsible_person_id')
                            ->label('Responsável')
                            ->relationship('responsiblePerson', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Origem e Destino')
                    ->schema([
                        TextInput::make('origin')
                            ->label('Origem')
                            ->placeholder('Ex.: Almoxarifado'),

                        TextInput::make('destination')
                            ->label('Destino')
                            ->placeholder('Ex.: Templo, Secretaria, Célula'),
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