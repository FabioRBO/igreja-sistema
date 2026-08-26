<x-filament-widgets::widget>

    <x-filament::section>

        <x-slot name="heading">
            Aniversariantes de {{ now()->translatedFormat('F') }}
        </x-slot>

        <div style="display: grid; gap: 10px;">

            @forelse ($this->birthdays as $member)

                @php
                    $person = $member->person;
                @endphp

                <div
                    style="
                        display: grid;
                        grid-template-columns: 1fr 100px 160px;
                        gap: 15px;
                        align-items: center;
                        padding: 10px 0;
                        border-bottom: 1px solid rgba(128,128,128,.15);
                    "
                >
                    <div>
                        <strong>{{ $person->name }}</strong>
                    </div>

                    <div>
                        {{ $person->birth_date->format('d/m') }}
                    </div>

                    <div>
                        {{ $person->whatsapp ?: ($person->phone ?: '—') }}
                    </div>
                </div>

            @empty

                <div style="padding: 15px 0; opacity: .65;">
                    Nenhum aniversariante neste mês.
                </div>

            @endforelse

        </div>

    </x-filament::section>

</x-filament-widgets::widget>