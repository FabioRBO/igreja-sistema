<x-filament-panels::page>

    <style>
        .logistics-report-filters {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .logistics-report-label {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            font-weight: 600;
        }

        .logistics-report-input,
        .logistics-report-select {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid rgba(128,128,128,.25);
            border-radius: 8px;
            background: transparent;
            color: inherit;
        }

        .logistics-report-select option {
            background: #18181b;
            color: #ffffff;
        }

        .logistics-report-table {
            width: 100%;
            border-collapse: collapse;
        }

        .logistics-report-table th,
        .logistics-report-table td {
            padding: 12px 14px;
            border-bottom: 1px solid rgba(128,128,128,.15);
            text-align: left;
            white-space: nowrap;
        }

        .logistics-report-table th {
            font-size: 13px;
            font-weight: 700;
            opacity: .8;
        }

        .logistics-report-empty {
            padding: 30px;
            text-align: center;
            opacity: .6;
        }

        @media (max-width: 900px) {
            .logistics-report-filters {
                grid-template-columns: 1fr;
            }
        }
    </style>


    <x-filament::section>

        <x-slot name="heading">
            Filtros
        </x-slot>

        <div class="logistics-report-filters">

            <div>
                <label class="logistics-report-label">
                    Data inicial
                </label>

                <input
                    type="date"
                    wire:model.live="startDate"
                    class="logistics-report-input"
                >
            </div>

            <div>
                <label class="logistics-report-label">
                    Data final
                </label>

                <input
                    type="date"
                    wire:model.live="endDate"
                    class="logistics-report-input"
                >
            </div>

            <div>
                <label class="logistics-report-label">
                    Solicitação
                </label>

                <select
                    wire:model.live="requestId"
                    class="logistics-report-select"
                >
                    <option value="">
                        Todas
                    </option>

                    @foreach ($this->requests as $request)
                        <option value="{{ $request->id }}">
                            {{ $request->title }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

    </x-filament::section>


    <x-filament::section>

        <x-slot name="heading">
            Movimentações Logísticas
        </x-slot>

        <div style="overflow-x: auto;">

            <table class="logistics-report-table">

                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Solicitação</th>
                        <th>Solicitante</th>
                        <th>Item</th>
                        <th>Quantidade</th>
                        <th>Tipo</th>
                        <th>Responsável</th>
                        <th>Conservação</th>
                        <th>Igreja</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($this->deliveries as $delivery)

                        <tr>

                            <td>
                                {{ $delivery->movement_date?->format('d/m/Y') }}
                            </td>

                            <td>
                                {{ $delivery->logisticsLoan?->logisticsRequest?->title ?? '—' }}
                            </td>

                            <td>
                                {{ $delivery->logisticsLoan?->logisticsRequest?->requesterPerson?->name ?? '—' }}
                            </td>

                            <td>
                                {{ $delivery->inventoryItem?->name ?? '—' }}
                            </td>

                            <td>
                                {{ $delivery->quantity }}
                            </td>

                            <td>
                                @switch($delivery->type)

                                    @case('delivery')
                                        Entrega
                                        @break

                                    @case('return')
                                        Devolução
                                        @break

                                    @default
                                        —
                                @endswitch
                            </td>

                            <td>
                                {{ $delivery->responsiblePerson?->name ?? '—' }}
                            </td>

                            <td>
                                @switch($delivery->condition)

                                    @case('new')
                                        Novo
                                        @break

                                    @case('excellent')
                                        Ótimo
                                        @break

                                    @case('good')
                                        Bom
                                        @break

                                    @case('regular')
                                        Regular
                                        @break

                                    @case('bad')
                                        Ruim
                                        @break

                                    @case('unusable')
                                        Inutilizado
                                        @break

                                    @default
                                        —
                                @endswitch
                            </td>

                            <td>
                                {{ $delivery->church?->name ?? '—' }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td
                                colspan="9"
                                class="logistics-report-empty"
                            >
                                Nenhuma movimentação encontrada para os filtros informados.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </x-filament::section>

</x-filament-panels::page>