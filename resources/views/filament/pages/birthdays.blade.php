<x-filament-panels::page>

    <style>
        .birthday-layout {
            display: grid;
            grid-template-columns: 7fr 3fr;
            gap: 18px;
        }

        .birthday-calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .birthday-calendar-title {
            font-size: 20px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .birthday-nav {
            cursor: pointer;
            border: 1px solid rgba(128,128,128,.25);
            border-radius: 8px;
            padding: 8px 14px;
            background: transparent;
            color: inherit;
        }

        .birthday-weekdays,
        .birthday-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 6px;
        }

        .birthday-weekday {
            text-align: center;
            padding: 8px;
            font-size: 12px;
            font-weight: 600;
            opacity: .6;
        }

        .birthday-day {
            position: relative;
            min-height: 75px;
            padding: 10px;
            border: 1px solid rgba(128,128,128,.15);
            border-radius: 8px;
            cursor: pointer;
            transition: .15s;
        }

        .birthday-day:hover {
            background: rgba(128,128,128,.08);
        }

        .birthday-day.selected {
            border-color: #f59e0b;
        }

        .birthday-dot {
            position: absolute;
            right: 8px;
            top: 8px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #f59e0b;
        }

        .birthday-person {
            padding: 12px 0;
            border-bottom: 1px solid rgba(128,128,128,.15);
        }

        .birthday-name {
            font-weight: 600;
        }

        .birthday-info {
            margin-top: 5px;
            font-size: 13px;
            opacity: .7;
        }

        @media (max-width: 900px) {
            .birthday-layout {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="birthday-layout">

        {{-- 70% - CALENDÁRIO --}}
        <x-filament::section>

            <div class="birthday-calendar-header">

                <button
                    type="button"
                    wire:click="previousMonth"
                    class="birthday-nav"
                >
                    ←
                </button>

                <div class="birthday-calendar-title">
                    {{
                        \Carbon\Carbon::create($year, $month, 1)
                            ->locale('pt_BR')
                            ->translatedFormat('F \d\e Y')
                    }}
                </div>

                <button
                    type="button"
                    wire:click="nextMonth"
                    class="birthday-nav"
                >
                    →
                </button>

            </div>

            <div class="birthday-weekdays">
                <div class="birthday-weekday">Dom</div>
                <div class="birthday-weekday">Seg</div>
                <div class="birthday-weekday">Ter</div>
                <div class="birthday-weekday">Qua</div>
                <div class="birthday-weekday">Qui</div>
                <div class="birthday-weekday">Sex</div>
                <div class="birthday-weekday">Sáb</div>
            </div>

            @php
                $firstDay = \Carbon\Carbon::create($year, $month, 1);

                $daysInMonth = $firstDay->daysInMonth;

                $startWeekday = $firstDay->dayOfWeek;

                $selectedDay = $selectedDate
                    ? \Carbon\Carbon::parse($selectedDate)->day
                    : null;
            @endphp

            <div class="birthday-days">

                {{-- Espaços antes do dia 1 --}}
                @for ($i = 0; $i < $startWeekday; $i++)
                    <div></div>
                @endfor

                {{-- Dias --}}
                @for ($day = 1; $day <= $daysInMonth; $day++)

                    <div
                        wire:click="selectDay({{ $day }})"
                        class="
                            birthday-day
                            {{ $selectedDay === $day ? 'selected' : '' }}
                        "
                    >

                        {{ $day }}

                        @if (in_array($day, $this->birthdayDays))
                            <span class="birthday-dot"></span>
                        @endif

                    </div>

                @endfor

            </div>

        </x-filament::section>


        {{-- 30% - LISTA --}}
        <x-filament::section>

            <x-slot name="heading">
                @if ($selectedDate)
                    {{ \Carbon\Carbon::parse($selectedDate)->format('d/m') }}
                @else
                    Aniversariantes
                @endif
            </x-slot>

            @forelse ($this->selectedBirthdays as $member)

                @php
                    $person = $member->person;
                @endphp

                <div class="birthday-person">

                    <div class="birthday-name">
                        {{ $person->name }}
                    </div>

                    <div class="birthday-info">
                        🎂 {{ $person->birth_date->format('d/m') }}
                    </div>

                    <div class="birthday-info">
                        📱 {{ $person->whatsapp ?: ($person->phone ?: '—') }}
                    </div>

                </div>

            @empty

                <div style="padding: 15px 0; opacity: .6;">
                    Nenhum aniversariante nesta data.
                </div>

            @endforelse

        </x-filament::section>

    </div>

</x-filament-panels::page>