<?php

namespace App\Filament\Resources\FinancialEntries\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FinancialEntryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Lançamento')
                    ->schema([
                        Select::make('church_id')
                            ->label('Igreja')
                            ->relationship('church', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('type')
                            ->label('Tipo')
                            ->options([
                                'income' => 'Conta a Receber / Receita',
                                'expense' => 'Conta a Pagar / Despesa',
                            ])
                            ->required(),

                        TextInput::make('description')
                            ->label('Descrição')
                            ->placeholder('Ex.: Conta de energia - Agosto')
                            ->required()
                            ->columnSpanFull(),

                        Select::make('financial_category_id')
                            ->label('Categoria')
                            ->relationship('financialCategory', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('person_id')
                            ->label('Pessoa / Responsável')
                            ->relationship('person', 'name')
                            ->searchable()
                            ->preload()
                            ->helperText('Opcional.'),

                        DatePicker::make('competence_date')
                            ->label('Competência')
                            ->native(false),

                        DatePicker::make('due_date')
                            ->label('Vencimento')
                            ->native(false),

                        TextInput::make('amount')
                            ->label('Valor')
                            ->numeric()
                            ->prefix('R$')
                            ->required(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Pagamento / Recebimento')
                    ->schema([
                        Select::make('financial_account_id')
                            ->label('Conta / Caixa')
                            ->relationship('financialAccount', 'name')
                            ->searchable()
                            ->preload(),

                        TextInput::make('paid_amount')
                            ->label('Valor pago / recebido')
                            ->numeric()
                            ->prefix('R$')
                            ->default(0),

                        DateTimePicker::make('payment_date')
                            ->label('Data do pagamento / recebimento')
                            ->seconds(false),

                        Select::make('payment_method')
                            ->label('Forma de pagamento')
                            ->options([
                                'cash' => 'Dinheiro',
                                'pix' => 'PIX',
                                'debit_card' => 'Cartão de débito',
                                'credit_card' => 'Cartão de crédito',
                                'transfer' => 'Transferência',
                                'boleto' => 'Boleto',
                                'check' => 'Cheque',
                                'other' => 'Outro',
                            ]),

                        Select::make('status')
                            ->label('Situação')
                            ->options([
                                'pending' => 'Pendente',
                                'partial' => 'Parcial',
                                'paid' => 'Pago / Recebido',
                                'cancelled' => 'Cancelado',
                            ])
                            ->default('pending')
                            ->required(),

                        TextInput::make('document_number')
                            ->label('Nº do documento')
                            ->placeholder('Nota, boleto, recibo etc.'),
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