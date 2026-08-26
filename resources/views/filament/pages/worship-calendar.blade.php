<x-filament-panels::page>

    <style>
        .worship-layout {
            display: grid;
            grid-template-columns: 7fr 3fr;
            gap: 18px;
        }

        .worship-calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .worship-calendar-title {
            font-size: 20px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .worship-nav {
            cursor: pointer;
            padding: 8px 14px;
            border: 1px solid rgba(128,128,128,.25);
            border-radius: 8px;
            background: transparent;
            color: inherit;
        }

        .worship-weekdays,
        .worship-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 6px;
        }

        .worship-weekday {
            padding: 8px;
            text-align: center;
            font-size: 12px;
            font-weight: 600;
            opacity: .6;
        }

        .worship-day {
            position: relative;
            min-height: 75px;
            padding: 10px;
            border: 1px solid rgba(128,128,128,.15);
            border-radius: 8px;
            cursor: pointer;
            transition: .15s;
        }

        .worship-day:hover {
            background: rgba(128,128,128,.08);
        }

        .worship-day.selected {
            border-color: #f59e0b;
        }

        .worship-dot {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #f59e0b;
        }

        .worship-service {
            padding-bottom: 16px;
            margin-bottom: 16px;
            border-bottom: 1px solid rgba(128,128,128,.15);
        }

        .worship-service-title {
            font-weight: 700;
            margin-bottom: 8px;
        }

        .worship-person {
            padding: 7px 0;
        }

        .worship-person-name {
            font-weight: 600;
        }

        .worship-info {
            font-size: 13px;
            margin-top: 3px;
            opacity: .7;
        }

        @media (max-width: 900px) {
            .worship-layout {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="worship-layout">

        {{-- CALENDÁRIO 70% --}}
        <x-filament::section>

            <div class="worship-calendar-header">

                <button
                    type="button"
                    wire:click="previousMonth"
                    class="worship-nav"
                >
                    ←
                </button>

                <div class="worship-calendar-title">
                    {{
                        \Carbon\Carbon::create($year, $month, 1)
                            ->locale('pt_BR')
                            ->translatedFormat('F \d\e Y')
                    }}
                </div>

                <button
                    type="button"
                    wire:click="nextMonth"
                    class="worship-nav"
                >
                    →
                </button>

            </div>

            <div class="worship-weekdays">
                <div class="worship-weekday">Dom</div>
                <div class="worship-weekday">Seg</div>
                <div class="worship-weekday">Ter</div>
                <div class="worship-weekday">Qua</div>
                <div class="worship-weekday">Qui</div>
                <div class="worship-weekday">Sex</div>
                <div class="worship-weekday">Sáb</div>
            </div>

            @php
                $firstDay = \Carbon\Carbon::create($year, $month, 1);
                $daysInMonth = $firstDay->daysInMonth;
                $startWeekday = $firstDay->dayOfWeek;

                $selectedDay = $selectedDate
                    ? \Carbon\Carbon::parse($selectedDate)->day
                    : null;
            @endphp

            <div class="worship-days">

                @for ($i = 0; $i < $startWeekday; $i++)
                    <div></div>
                @endfor

                @for ($day = 1; $day <= $daysInMonth; $day++)

                    <div
                        wire:click="selectDay({{ $day }})"
                        class="
                            worship-day
                            {{ $selectedDay === $day ? 'selected' : '' }}
                        "
                    >
                        {{ $day }}

                        @if (in_array($day, $this->scheduleDays))
                            <span class="worship-dot"></span>
                        @endif
                    </div>

                @endfor

            </div>

        </x-filament::section>


        {{-- LISTA 30% --}}
        <x-filament::section>

            <x-slot name="heading">
                @if ($selectedDate)
                    Escala em
                    {{ \Carbon\Carbon::parse($selectedDate)->format('d/m/Y') }}
                @else
                    Escala
                @endif
            </x-slot>

            @forelse ($this->selectedSchedules as $schedule)

                <div class="worship-service">

                    <div class="worship-service-title">
                        {{ $schedule->title ?: 'Culto' }}
                    </div>

                    <div class="worship-info">
                        🕒
                        {{ $schedule->start_time
                            ? \Carbon\Carbon::parse($schedule->start_time)->format('H:i')
                            : 'Horário não informado'
                        }}
                    </div>

                    <div class="worship-info">
                        {{
                            match ($schedule->service_type) {
                                'wednesday' => 'Quarta-feira',
                                'sunday_morning' => 'Domingo de manhã',
                                'sunday_evening' => 'Domingo à noite',
                                'special' => 'Especial',
                                default => $schedule->service_type,
                            }
                        }}
                    </div>

                    <div style="margin-top: 10px;">

                        @forelse ($schedule->participants as $participant)

                            <div class="worship-person">

                                <div class="worship-person-name">
                                    {{ $participant->person?->name ?? '—' }}
                                </div>

                                <div class="worship-info">
                                    {{
                                        match ($participant->role_type) {
                                            'vocal' => 'Vocal',
                                            'instrumentalist' => 'Instrumentista',
                                            'both' => 'Vocal e Instrumentista',
                                            default => $participant->role_type,
                                        }
                                    }}
                                </div>

                                @if ($participant->pivot?->instrument)
                                    <div class="worship-info">
                                        🎸 {{ $participant->pivot->instrument }}
                                    </div>
                                @endif

                            </div>

                        @empty

                            <div class="worship-info">
                                Nenhum participante escalado.
                            </div>

                        @endforelse

                    </div>

                </div>

            @empty

                <div style="padding: 15px 0; opacity: .6;">
                    Nenhuma escala nesta data.
                </div>

            @endforelse

        </x-filament::section>

    </div>

</x-filament-panels::page>