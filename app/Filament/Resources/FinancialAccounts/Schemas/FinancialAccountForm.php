<?php

namespace App\Filament\Resources\FinancialAccounts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FinancialAccountForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Conta / Caixa')
                    ->schema([
                        Select::make('church_id')
                            ->label('Igreja')
                            ->relationship('church', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('name')
                            ->label('Nome')
                            ->placeholder('Ex.: Caixa da Igreja')
                            ->required(),

                        Select::make('type')
                            ->label('Tipo')
                            ->options([
                                'cash' => 'Caixa',
                                'checking' => 'Conta Corrente',
                                'savings' => 'Poupança',
                                'digital' => 'Conta Digital',
                                'other' => 'Outro',
                            ])
                            ->default('cash')
                            ->required(),

                        TextInput::make('initial_balance')
                            ->label('Saldo inicial')
                            ->numeric()
                            ->prefix('R$')
                            ->default(0)
                            ->required(),

                        TextInput::make('bank_name')
                            ->label('Banco'),

                        TextInput::make('agency')
                            ->label('Agência'),

                        TextInput::make('account_number')
                            ->label('Número da conta'),

                        TextInput::make('pix_key')
                            ->label('Chave PIX'),

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
            ]);
    }
}