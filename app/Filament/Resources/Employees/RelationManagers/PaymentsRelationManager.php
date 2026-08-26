<?php

namespace App\Filament\Resources\Employees\RelationManagers;

use App\Models\EmployeePayment;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'payments';

    protected static ?string $title = 'Pagamentos';

    protected static ?string $modelLabel = 'Pagamento';

    protected static ?string $pluralModelLabel = 'Pagamentos';

    private static function calculateNetAmount(Get $get, Set $set): void
    {
        $base = (float) ($get('base_amount') ?? 0);
        $additions = (float) ($get('additions') ?? 0);
        $discounts = (float) ($get('discounts') ?? 0);

        $set(
            'net_amount',
            max(0, $base + $additions - $discounts)
        );
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados do pagamento')
                    ->schema([
                        TextInput::make('competence')
                            ->label('Competência')
                            ->placeholder('Ex.: 2026-08')
                            ->helperText('Informe no formato AAAA-MM.')
                            ->required()
                            ->maxLength(7),

                        DatePicker::make('due_date')
                            ->label('Vencimento')
                            ->native(false),

                        TextInput::make('base_amount')
                            ->label('Valor base')
                            ->numeric()
                            ->prefix('R$')
                            ->default(fn () => $this->getOwnerRecord()->base_amount ?? 0)
                            ->required()
                            ->live()
                            ->afterStateUpdated(
                                fn (Get $get, Set $set) =>
                                    self::calculateNetAmount($get, $set)
                            ),

                        TextInput::make('additions')
                            ->label('Acréscimos')
                            ->numeric()
                            ->prefix('R$')
                            ->default(0)
                            ->required()
                            ->live()
                            ->afterStateUpdated(
                                fn (Get $get, Set $set) =>
                                    self::calculateNetAmount($get, $set)
                            ),

                        TextInput::make('discounts')
                            ->label('Descontos')
                            ->numeric()
                            ->prefix('R$')
                            ->default(0)
                            ->required()
                            ->live()
                            ->afterStateUpdated(
                                fn (Get $get, Set $set) =>
                                    self::calculateNetAmount($get, $set)
                            ),

                        TextInput::make('net_amount')
                            ->label('Valor líquido')
                            ->numeric()
                            ->prefix('R$')
                            ->default(fn () => $this->getOwnerRecord()->base_amount ?? 0)
                            ->readOnly()
                            ->required(),

                        Select::make('financial_account_id')
                            ->label('Conta / Caixa')
                            ->relationship('financialAccount', 'name')
                            ->searchable()
                            ->preload(),

                        Select::make('status')
                            ->label('Situação')
                            ->options([
                                'pending' => 'Pendente',
                                'paid' => 'Pago',
                                'cancelled' => 'Cancelado',
                            ])
                            ->default('pending')
                            ->required(),

                        DateTimePicker::make('payment_date')
                            ->label('Data do pagamento')
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

                        Textarea::make('notes')
                            ->label('Observações')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Pagamento')
                    ->schema([
                        TextEntry::make('competence')
                            ->label('Competência'),

                        TextEntry::make('due_date')
                            ->label('Vencimento')
                            ->date('d/m/Y')
                            ->placeholder('—'),

                        TextEntry::make('base_amount')
                            ->label('Valor base')
                            ->money('BRL'),

                        TextEntry::make('additions')
                            ->label('Acréscimos')
                            ->money('BRL'),

                        TextEntry::make('discounts')
                            ->label('Descontos')
                            ->money('BRL'),

                        TextEntry::make('net_amount')
                            ->label('Valor líquido')
                            ->money('BRL'),

                        TextEntry::make('financialAccount.name')
                            ->label('Conta / Caixa')
                            ->placeholder('—'),

                        TextEntry::make('payment_method')
                            ->label('Forma de pagamento')
                            ->formatStateUsing(fn (?string $state): string => match ($state) {
                                'cash' => 'Dinheiro',
                                'pix' => 'PIX',
                                'debit_card' => 'Cartão de débito',
                                'credit_card' => 'Cartão de crédito',
                                'transfer' => 'Transferência',
                                'boleto' => 'Boleto',
                                'check' => 'Cheque',
                                'other' => 'Outro',
                                default => $state ?? '—',
                            }),

                        TextEntry::make('status')
                            ->label('Situação')
                            ->badge()
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'pending' => 'Pendente',
                                'paid' => 'Pago',
                                'cancelled' => 'Cancelado',
                                default => $state,
                            }),

                        TextEntry::make('payment_date')
                            ->label('Pago em')
                            ->dateTime('d/m/Y H:i')
                            ->placeholder('—'),

                        TextEntry::make('notes')
                            ->label('Observações')
                            ->placeholder('—')
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('competence')
            ->columns([
                TextColumn::make('competence')
                    ->label('Competência')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('due_date')
                    ->label('Vencimento')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('base_amount')
                    ->label('Valor base')
                    ->money('BRL')
                    ->sortable(),

                TextColumn::make('additions')
                    ->label('Acréscimos')
                    ->money('BRL')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('discounts')
                    ->label('Descontos')
                    ->money('BRL')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('net_amount')
                    ->label('Valor líquido')
                    ->money('BRL')
                    ->sortable(),

                TextColumn::make('financialAccount.name')
                    ->label('Conta / Caixa')
                    ->placeholder('—'),

                TextColumn::make('status')
                    ->label('Situação')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pendente',
                        'paid' => 'Pago',
                        'cancelled' => 'Cancelado',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'paid' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('payment_date')
                    ->label('Pago em')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('—')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Cadastrado em')
                    ->dateTime('d/m/Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('competence', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Situação')
                    ->options([
                        'pending' => 'Pendente',
                        'paid' => 'Pago',
                        'cancelled' => 'Cancelado',
                    ]),

                TrashedFilter::make(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Novo pagamento'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
                ForceDeleteAction::make(),
                RestoreAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(
                fn (Builder $query) => $query
                    ->withoutGlobalScopes([
                        SoftDeletingScope::class,
                    ])
            );
    }
}