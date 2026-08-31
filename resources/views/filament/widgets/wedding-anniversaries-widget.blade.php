<x-filament-widgets::widget>

    <x-filament::section>

        <x-slot name="heading">
            Aniversários de Casamento de
            {{
                now()
                    ->locale('pt_BR')
                    ->translatedFormat('F')
            }}
        </x-slot>

        @forelse ($this->getMarriages() as $marriage)

            @php
                $anniversaryDate = \Carbon\Carbon::create(
                    now()->year,
                    $marriage->marriage_date->month,
                    $marriage->marriage_date->day
                );

                $years = $marriage->marriage_date
                    ->diffInYears($anniversaryDate);
            @endphp

            <div
                style="
                    padding: 10px 0;
                    border-bottom: 1px solid rgba(128,128,128,.15);
                "
            >

                <div
                    style="
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        gap: 10px;
                    "
                >

                    <div style="font-weight: 600;">
                        {{ $marriage->personOne?->name ?? '—' }}
                        &
                        {{ $marriage->personTwo?->name ?? '—' }}
                    </div>

                    <div
                        style="
                            font-weight: 600;
                            white-space: nowrap;
                            color: #f59e0b;
                        "
                    >
                        {{ $marriage->marriage_date->format('d/m') }}
                    </div>

                </div>

                <div
                    style="
                        margin-top: 5px;
                        font-size: 13px;
                        opacity: .7;
                    "
                >
                    ❤️ {{ $years }} anos de casamento
                </div>

            </div>

        @empty

            <div style="padding: 15px 0; opacity: .6;">
                Nenhum aniversário de casamento neste mês.
            </div>

        @endforelse

    </x-filament::section>

</x-filament-widgets::widget>