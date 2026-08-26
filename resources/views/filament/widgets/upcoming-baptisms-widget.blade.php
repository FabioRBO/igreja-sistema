<x-filament-widgets::widget>

    <x-filament::section>

        <x-slot name="heading">
            Próximo Batismo
            @if ($this->nextDate)
                - {{ \Carbon\Carbon::parse($this->nextDate)->format('d/m/Y') }}
            @endif
        </x-slot>

        @if ($this->nextDate)

            <div style="
                margin-bottom: 14px;
                font-size: 18px;
                font-weight: 700;
            ">
                {{ \Carbon\Carbon::parse($this->nextDate)->format('d/m/Y') }}
            </div>

            @forelse ($this->baptisms as $baptism)

                <div style="
                    padding: 10px 0;
                    border-bottom: 1px solid rgba(128,128,128,.15);
                ">

                    <div style="font-weight: 600;">
                        {{ $baptism->person?->name ?? '—' }}
                    </div>

                    <div style="
                        margin-top: 4px;
                        font-size: 13px;
                        opacity: .7;
                    ">
                        {{ $baptism->location ?: 'Local não informado' }}
                    </div>

                </div>

            @empty

                <div style="opacity: .65;">
                    Nenhuma pessoa cadastrada.
                </div>

            @endforelse

        @else

            <div style="padding: 15px 0; opacity: .65;">
                Nenhum próximo batismo agendado.
            </div>

        @endif

    </x-filament::section>

</x-filament-widgets::widget>