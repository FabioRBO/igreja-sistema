<x-filament-panels::page>

    <style>
        .inventory-report-filters {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }

        .inventory-report-label {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            font-weight: 600;
        }

        .inventory-report-input,
        .inventory-report-select {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid rgba(128,128,128,.25);
            border-radius: 8px;
            background: transparent;
            color: inherit;
        }

        .inventory-report-select option {
            background: #18181b;
            color: #ffffff;
        }

        .inventory-report-table {
            width: 100%;
            border-collapse: collapse;
        }

        .inventory-report-table th,
        .inventory-report-table td {
            padding: 12px 14px;
            border-bottom: 1px solid rgba(128,128,128,.15);
            text-align: left;
            white-space: nowrap;
        }

        .inventory-report-table th {
            font-size: 13px;
            font-weight: 700;
            opacity: .8;
        }

        .inventory-report-empty {
            padding: 30px;
            text-align: center;
            opacity: .6;
        }

        @media (max-width: 1000px) {
            .inventory-report-filters {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 600px) {
            .inventory-report-filters {
                grid-template-columns: 1fr;
            }
        }
    </style>


    <x-filament::section>

        <x-slot name="heading">
            Filtros
        </x-slot>

        <div class="inventory-report-filters">

            <div>
                <label class="inventory-report-label">
                    Data inicial
                </label>

                <input
                    type="date"
                    wire:model.live="startDate"
                    class="inventory-report-input"
                >
            </div>

            <div>
                <label class="inventory-report-label">
                    Data final
                </label>

                <input
                    type="date"
                    wire:model.live="endDate"
                    class="inventory-report-input"
                >
            </div>

            <div>
                <label class="inventory-report-label">
                    Categoria
                </label>

                <select
                    wire:model.live="categoryId"
                    class="inventory-report-select"
                >
                    <option value="">
                        Todas
                    </option>

                    @foreach ($this->categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="inventory-report-label">
                    Item
                </label>

                <select
                    wire:model.live="itemId"
                    class="inventory-report-select"
                >
                    <option value="">
                        Todos
                    </option>

                    @foreach ($this->items as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

    </x-filament::section>


    <x-filament::section>

        <x-slot name="heading">
            Inventário
        </x-slot>

        <div style="overflow-x: auto;">

            <table class="inventory-report-table">

                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Item</th>
                        <th>Patrimônio</th>
                        <th>Quantidade</th>
                        <th>Local</th>
                        <th>Conservação</th>
                        <th>Data de aquisição</th>
                        <th>Valor</th>
                        <th>Igreja</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($this->inventory as $item)

                        <tr>
                            <td>
                                {{ $item->category?->name ?? '—' }}
                            </td>

                            <td>
                                {{ $item->name }}
                            </td>

                            <td>
                                {{ $item->asset_code ?? '—' }}
                            </td>

                            <td>
                                {{ $item->quantity }}
                            </td>

                            <td>
                                {{ $item->location ?? '—' }}
                            </td>

                            <td>
                                @switch($item->condition)

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
                                {{ $item->acquisition_date?->format('d/m/Y') ?? '—' }}
                            </td>

                            <td>
                                @if ($item->value !== null)
                                    R$ {{ number_format($item->value, 2, ',', '.') }}
                                @else
                                    —
                                @endif
                            </td>

                            <td>
                                {{ $item->church?->name ?? '—' }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td
                                colspan="9"
                                class="inventory-report-empty"
                            >
                                Nenhum item encontrado para os filtros informados.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </x-filament::section>

</x-filament-panels::page>