<x-filament-panels::page>

    <style>
        .cell-report-filters {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .cell-report-label {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            font-weight: 600;
        }

        .cell-report-input {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid rgba(128,128,128,.25);
            border-radius: 8px;
            background: transparent;
            color: inherit;
        }

        .cell-report-table {
            width: 100%;
            border-collapse: collapse;
        }

        .cell-report-table th,
        .cell-report-table td {
            padding: 12px 14px;
            border-bottom: 1px solid rgba(128,128,128,.15);
            text-align: left;
        }

        .cell-report-table th {
            font-size: 13px;
            font-weight: 700;
            opacity: .8;
        }

        .cell-report-count {
            font-weight: 700;
        }

        @media (max-width: 700px) {
            .cell-report-filters {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <x-filament::section>

        <x-slot name="heading">
            Filtros
        </x-slot>

        <div class="cell-report-filters">

            <div>
                <label class="cell-report-label">
                    Data inicial
                </label>

                <input
                    type="date"
                    wire:model.live="startDate"
                    class="cell-report-input"
                >
            </div>

            <div>
                <label class="cell-report-label">
                    Data final
                </label>

                <input
                    type="date"
                    wire:model.live="endDate"
                    class="cell-report-input"
                >
            </div>

        </div>

    </x-filament::section>


    <x-filament::section>

        <x-slot name="heading">
            Reuniões de Célula
        </x-slot>

        <div style="overflow-x: auto;">

            <table class="cell-report-table">

                <thead>
                    <tr>
                        <th>Célula</th>
                        <th>Data</th>
                        <th>Quantidade de pessoas</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($this->getMeetings() as $meeting)

                        <tr>
                            <td>
                                {{ $meeting->cell?->name ?? '—' }}
                            </td>

                            <td>
                                {{ $meeting->meeting_date->format('d/m/Y') }}
                            </td>

                            <td class="cell-report-count">
                                {{ $meeting->attendances_count }}
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td
                                colspan="3"
                                style="
                                    padding: 30px;
                                    text-align: center;
                                    opacity: .6;
                                "
                            >
                                Nenhuma reunião encontrada no período.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </x-filament::section>

</x-filament-panels::page>