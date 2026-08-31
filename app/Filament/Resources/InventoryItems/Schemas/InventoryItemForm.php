<?php

namespace App\Filament\Resources\InventoryItems\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class InventoryItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Dados do Item')
                    ->schema([
                        Select::make('church_id')
                            ->label('Igreja')
                            ->relationship('church', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('inventory_category_id')
                            ->label('Categoria')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('name')
                            ->label('Nome do item')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('asset_code')
                            ->label('Código / Patrimônio')
                            ->maxLength(255),

                        TextInput::make('quantity')
                            ->label('Quantidade')
                            ->numeric()
                            ->minValue(0)
                            ->default(1)
                            ->required(),

                        Select::make('condition')
                            ->label('Estado de conservação')
                            ->options([
                                'new' => 'Novo',
                                'excellent' => 'Ótimo',
                                'good' => 'Bom',
                                'regular' => 'Regular',
                                'bad' => 'Ruim',
                                'unusable' => 'Inutilizado',
                            ])
                            ->native(false),

                        Toggle::make('is_active')
                            ->label('Ativo')
                            ->default(true),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Aquisição e Localização')
                    ->schema([
                        TextInput::make('location')
                            ->label('Local')
                            ->placeholder('Ex.: Templo, Secretaria, Sala 2'),

                        DatePicker::make('acquisition_date')
                            ->label('Data de aquisição')
                            ->native(false)
                            ->displayFormat('d/m/Y'),

                        TextInput::make('value')
                            ->label('Valor')
                            ->numeric()
                            ->prefix('R$')
                            ->step(0.01),
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