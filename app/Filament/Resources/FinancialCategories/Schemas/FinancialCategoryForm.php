<?php

namespace App\Filament\Resources\FinancialCategories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FinancialCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados da categoria')
                    ->schema([
                        Select::make('church_id')
                            ->label('Igreja')
                            ->relationship('church', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('name')
                            ->label('Nome')
                            ->placeholder('Ex.: Dízimos, Energia, Aluguel')
                            ->required()
                            ->maxLength(255),

                        Select::make('type')
                            ->label('Tipo')
                            ->options([
                                'income' => 'Receita',
                                'expense' => 'Despesa',
                                'both' => 'Receita e Despesa',
                            ])
                            ->default('both')
                            ->required(),

                        Toggle::make('is_active')
                            ->label('Ativa')
                            ->default(true),

                        Textarea::make('description')
                            ->label('Descrição')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}