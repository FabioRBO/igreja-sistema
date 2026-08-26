<x-filament-panels::page>

    <style>
        .finance-dashboard {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* FILTROS */
        .finance-filters {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .finance-field label {
            display: block;
            margin-bottom: 7px;
            font-size: 14px;
            font-weight: 500;
        }

        .finance-field input,
        .finance-field select {
            width: 100%;
            height: 42px;
            padding: 0 12px;
            border: 1px solid rgba(128, 128, 128, .30);
            border-radius: 8px;
            background: transparent;
            color: inherit;
            font-size: 14px;
        }

        .finance-field select option {
            color: #111827;
            background: #ffffff;
        }

        /* CARDS */
        .finance-cards {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 14px;
        }

        .finance-card {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
            padding: 18px;
            border: 1px solid rgba(128, 128, 128, .20);
            border-radius: 12px;
            background: rgba(128, 128, 128, .06);
        }

        .finance-card-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 42px;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: rgba(128, 128, 128, .10);
        }

        .finance-card-icon svg {
            width: 22px !important;
            height: 22px !important;
        }

        .finance-card-content {
            min-width: 0;
        }

        .finance-card-title {
            margin-bottom: 4px;
            font-size: 13px;
            opacity: .65;
        }

        .finance-card-value {
            font-size: 20px;
            font-weight: 700;
            white-space: nowrap;
        }

        .finance-income {
            color: #22c55e;
        }

        .finance-expense {
            color: #ef4444;
        }

        .finance-balance {
            color: #3b82f6;
        }

        .finance-receivable {
            color: #f59e0b;
        }

        .finance-payable {
            color: #a855f7;
        }

        /* TABELA */
        .finance-table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .finance-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .finance-table th {
            padding: 12px;
            border-bottom: 1px solid rgba(128, 128, 128, .25);
            text-align: left;
            font-size: 13px;
            font-weight: 600;
            opacity: .7;
        }

        .finance-table td {
            padding: 12px;
            border-bottom: 1px solid rgba(128, 128, 128, .12);
        }

        .finance-table .text-right {
            text-align: right;
        }

        .finance-table .text-center {
            text-align: center;
        }

        .finance-empty {
            padding: 35px !important;
            text-align: center;
            opacity: .6;
        }

        /* BADGES */
        .finance-badge {
            display: inline-block;
            padding: 4px 9px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success {
            color: #22c55e;
            background: rgba(34, 197, 94, .12);
        }

        .badge-warning {
            color: #f59e0b;
            background: rgba(245, 158, 11, .12);
        }

        .badge-info {
            color: #3b82f6;
            background: rgba(59, 130, 246, .12);
        }

        .badge-danger {
            color: #ef4444;
            background: rgba(239, 68, 68, .12);
        }

        /* RESPONSIVO */
        @media (max-width: 1200px) {
            .finance-cards {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 800px) {
            .finance-filters {
                grid-template-columns: 1fr;
            }

            .finance-cards {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 500px) {
            .finance-cards {
                grid-template-columns: 1fr;
            }
        }

        .finance-charts {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        @media (max-width: 900px) {
            .finance-charts {
                grid-template-columns: 1fr;
            }
        }
    </style>


    <div class="finance-dashboard">

        {{-- FILTROS --}}
        <x-filament::section>
            <x-slot name="heading">
                Filtros
            </x-slot>

            <div class="finance-filters">

                <div class="finance-field">
                    <label for="startDate">Data inicial</label>

                    <input
                        id="startDate"
                        type="date"
                        wire:model.live="startDate"
                    >
                </div>

                <div class="finance-field">
                    <label for="endDate">Data final</label>

                    <input
                        id="endDate"
                        type="date"
                        wire:model.live="endDate"
                    >
                </div>

                <div class="finance-field">
                    <label for="churchId">Igreja</label>

                    <select
                        id="churchId"
                        wire:model.live="churchId"
                    >
                        <option value="">Todas</option>

                        @foreach ($this->churches as $id => $name)
                            <option value="{{ $id }}">
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="finance-field">
                    <label for="accountId">Conta / Caixa</label>

                    <select
                        id="accountId"
                        wire:model.live="accountId"
                    >
                        <option value="">Todas</option>

                        @foreach ($this->accounts as $id => $name)
                            <option value="{{ $id }}">
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>
        </x-filament::section>


        {{-- INDICADORES --}}
        <div class="finance-cards">

            <div class="finance-card">
                <div class="finance-card-icon finance-income">
                    <x-heroicon-o-arrow-trending-up />
                </div>

                <div class="finance-card-content">
                    <div class="finance-card-title">Entradas</div>

                    <div class="finance-card-value finance-income">
                        R$ {{ number_format($this->totalIncome, 2, ',', '.') }}
                    </div>
                </div>
            </div>


            <div class="finance-card">
                <div class="finance-card-icon finance-expense">
                    <x-heroicon-o-arrow-trending-down />
                </div>

                <div class="finance-card-content">
                    <div class="finance-card-title">Saídas</div>

                    <div class="finance-card-value finance-expense">
                        R$ {{ number_format($this->totalExpense, 2, ',', '.') }}
                    </div>
                </div>
            </div>


            <div class="finance-card">
                <div class="finance-card-icon finance-balance">
                    <x-heroicon-o-wallet />
                </div>

                <div class="finance-card-content">
                    <div class="finance-card-title">
                        Saldo do período
                    </div>

                    <div class="finance-card-value {{ $this->balance < 0 ? 'finance-expense' : 'finance-balance' }}">
                        R$ {{ number_format($this->balance, 2, ',', '.') }}
                    </div>
                </div>
            </div>


            <div class="finance-card">
                <div class="finance-card-icon finance-receivable">
                    <x-heroicon-o-clock />
                </div>

                <div class="finance-card-content">
                    <div class="finance-card-title">
                        A receber
                    </div>

                    <div class="finance-card-value finance-receivable">
                        R$ {{ number_format($this->receivable, 2, ',', '.') }}
                    </div>
                </div>
            </div>


            <div class="finance-card">
                <div class="finance-card-icon finance-payable">
                    <x-heroicon-o-credit-card />
                </div>

                <div class="finance-card-content">
                    <div class="finance-card-title">
                        A pagar
                    </div>

                    <div class="finance-card-value finance-payable">
                        R$ {{ number_format($this->payable, 2, ',', '.') }}
                    </div>
                </div>
            </div>

        </div>

        
        <x-filament::section>
            <div class="finance-charts">

                <div>
                    @livewire(\App\Filament\Widgets\FinancialIncomeChart::class)
                </div>

                <div>
                    @livewire(\App\Filament\Widgets\FinancialExpenseChart::class)
                </div>

            </div>
        </x-filament::section>


        {{-- MOVIMENTAÇÕES --}}
        <x-filament::section>

            <x-slot name="heading">
                Movimentações do período
            </x-slot>

            <div class="finance-table-wrapper">

                <table class="finance-table">

                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Descrição</th>
                            <th>Categoria</th>
                            <th>Conta / Caixa</th>
                            <th class="text-right">Entrada</th>
                            <th class="text-right">Saída</th>
                            <th class="text-center">Situação</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($this->entries as $entry)

                            <tr>

                                <td>
                                    {{ optional($entry->payment_date ?? $entry->due_date)->format('d/m/Y') }}
                                </td>

                                <td>
                                    {{ $entry->description }}
                                </td>

                                <td>
                                    {{ $entry->financialCategory?->name ?? '—' }}
                                </td>

                                <td>
                                    {{ $entry->financialAccount?->name ?? '—' }}
                                </td>

                                <td class="text-right">
                                    @if ($entry->type === 'income')
                                        <strong class="finance-income">
                                            R$ {{ number_format($entry->paid_amount, 2, ',', '.') }}
                                        </strong>
                                    @else
                                        —
                                    @endif
                                </td>

                                <td class="text-right">
                                    @if ($entry->type === 'expense')
                                        <strong class="finance-expense">
                                            R$ {{ number_format($entry->paid_amount, 2, ',', '.') }}
                                        </strong>
                                    @else
                                        —
                                    @endif
                                </td>

                                <td class="text-center">

                                    @switch($entry->status)

                                        @case('paid')
                                            <span class="finance-badge badge-success">
                                                {{ $entry->type === 'income' ? 'Recebido' : 'Pago' }}
                                            </span>
                                            @break

                                        @case('partial')
                                            <span class="finance-badge badge-info">
                                                Parcial
                                            </span>
                                            @break

                                        @case('cancelled')
                                            <span class="finance-badge badge-danger">
                                                Cancelado
                                            </span>
                                            @break

                                        @default
                                            <span class="finance-badge badge-warning">
                                                Pendente
                                            </span>

                                    @endswitch

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="finance-empty">
                                    Nenhuma movimentação encontrada no período.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </x-filament::section>

    </div>

</x-filament-panels::page>