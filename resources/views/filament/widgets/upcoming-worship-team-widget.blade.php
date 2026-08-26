<x-filament-widgets::widget>

    <x-filament::section>

        <x-slot name="heading">
            Equipe de Louvor
            @if ($this->schedule)
                - {{ $this->schedule->schedule_date->format('d/m/Y') }}
            @endif
        </x-slot>

        @if ($this->schedule)

            <div style="
                margin-bottom: 14px;
                padding-bottom: 12px;
                border-bottom: 1px solid rgba(128,128,128,.15);
            ">

                <div style="margin-top: 4px; font-size: 13px; opacity: .7;">

                    {{
                        match ($this->schedule->service_type) {
                            'wednesday' => 'Quarta-feira',
                            'sunday_morning' => 'Domingo de manhã',
                            'sunday_evening' => 'Domingo à noite',
                            'special' => 'Especial',
                            default => $this->schedule->service_type,
                        }
                    }}

                    @if ($this->schedule->start_time)
                        —
                        {{ \Carbon\Carbon::parse($this->schedule->start_time)->format('H:i') }}
                    @endif

                </div>

            </div>

            @forelse ($this->schedule->participants as $participant)

                <div style="
                    padding: 9px 0;
                    border-bottom: 1px solid rgba(128,128,128,.10);
                ">

                    <div style="font-weight: 600;">
                        {{ $participant->person?->name ?? '—' }}
                    </div>

                    <div style="
                        margin-top: 3px;
                        font-size: 13px;
                        opacity: .7;
                    ">
                        {{
                            match ($participant->role_type) {
                                'vocal' => 'Vocal',
                                'instrumentalist' => 'Instrumentista',
                                'both' => 'Vocal e Instrumentista',
                                default => $participant->role_type,
                            }
                        }}

                        @if ($participant->pivot?->instrument)
                            • {{ $participant->pivot->instrument }}
                        @endif
                    </div>

                </div>

            @empty

                <div style="opacity: .65;">
                    Nenhum participante escalado.
                </div>

            @endforelse

        @else

            <div style="padding: 15px 0; opacity: .65;">
                Nenhum próximo culto com escala cadastrada.
            </div>

        @endif

    </x-filament::section>

</x-filament-widgets::widget>