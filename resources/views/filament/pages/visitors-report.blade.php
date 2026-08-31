<x-filament-panels::page>

    <style>
        .visitor-report-filters {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .visitor-report-label {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            font-weight: 600;
        }

        .visitor-report-input {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid rgba(128,128,128,.25);
            border-radius: 8px;
            background: transparent;
            color: inherit;
        }

        .visitor-report-table {
            width: 100%;
            border-collapse: collapse;
        }

        .visitor-report-table th,
        .visitor-report-table td {
            padding: 12px 14px;
            border-bottom: 1px solid rgba(128,128,128,.15);
            text-align: left;
        }

        .visitor-report-table th {
            font-size: 13px;
            font-weight: 700;
            opacity: .8;
        }

        .visitor-report-count {
            font-weight: 700;
        }

        @media (max-width: 700px) {
            .visitor-report-filters {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <x-filament::section>

        <x-slot name="heading">
            Filtros
        </x-slot>

        <div class="visitor-report-filters">

            <div>
                <label class="visitor-report-label">
                    Data inicial
                </label>

                <input
                    type="date"
                    wire:model.live="startDate"
                    class="visitor-report-input"
                >
            </div>

            <div>
                <label class="visitor-report-label">
                    Data final
                </label>

                <input
                    type="date"
                    wire:model.live="endDate"
                    class="visitor-report-input"
                >
            </div>

        </div>

    </x-filament::section>


    <x-filament::section>

        <x-slot name="heading">
            Visitantes
        </x-slot>

        <div style="overflow-x: auto;">

            <table class="visitor-report-table">

                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Quantidade</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($this->getVisitors() as $visitor)

                        <tr>
                            <td>
                                {{ \Carbon\Carbon::parse($visitor->visit_date)->format('d/m/Y') }}
                            </td>

                            <td class="visitor-report-count">
                                {{ $visitor->total }}
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td
                                colspan="2"
                                style="
                                    padding: 30px;
                                    text-align: center;
                                    opacity: .6;
                                "
                            >
                                Nenhum visitante encontrado no período.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </x-filament::section>

</x-filament-panels::page>