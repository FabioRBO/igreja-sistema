<x-filament-panels::page>

    <style>
        .baptism-layout {
            display: grid;
            grid-template-columns: 7fr 3fr;
            gap: 18px;
        }

        .baptism-calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .baptism-calendar-title {
            font-size: 20px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .baptism-nav {
            cursor: pointer;
            padding: 8px 14px;
            border: 1px solid rgba(128,128,128,.25);
            border-radius: 8px;
            background: transparent;
            color: inherit;
        }

        .baptism-weekdays,
        .baptism-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 6px;
        }

        .baptism-weekday {
            padding: 8px;
            text-align: center;
            font-size: 12px;
            font-weight: 600;
            opacity: .6;
        }

        .baptism-day {
            position: relative;
            min-height: 75px;
            padding: 10px;
            border: 1px solid rgba(128,128,128,.15);
            border-radius: 8px;
            cursor: pointer;
        }

        .baptism-day:hover {
            background: rgba(128,128,128,.08);
        }

        .baptism-day.selected {
            border-color: #f59e0b;
        }

        .baptism-dot {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #f59e0b;
        }

        .baptism-person {
            padding: 12px 0;
            border-bottom: 1px solid rgba(128,128,128,.15);
        }

        .baptism-name {
            font-weight: 600;
        }

        .baptism-info {
            margin-top: 5px;
            font-size: 13px;
            opacity: .7;
        }

        @media (max-width: 900px) {
            .baptism-layout {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="baptism-layout">

        <x-filament::section>

            <div class="baptism-calendar-header">

                <button
                    type="button"
                    wire:click="previousMonth"
                    class="baptism-nav"
                >
                    ←
                </button>

                <div class="baptism-calendar-title">
                    {{
                        \Carbon\Carbon::create($year, $month, 1)
                            ->locale('pt_BR')
                            ->translatedFormat('F \d\e Y')
                    }}
                </div>

                <button
                    type="button"
                    wire:click="nextMonth"
                    class="baptism-nav"
                >
                    →
                </button>

            </div>

            <div class="baptism-weekdays">
                <div class="baptism-weekday">Dom</div>
                <div class="baptism-weekday">Seg</div>
                <div class="baptism-weekday">Ter</div>
                <div class="baptism-weekday">Qua</div>
                <div class="baptism-weekday">Qui</div>
                <div class="baptism-weekday">Sex</div>
                <div class="baptism-weekday">Sáb</div>
            </div>

            @php
                $firstDay = \Carbon\Carbon::create($year, $month, 1);

                $daysInMonth = $firstDay->daysInMonth;

                $startWeekday = $firstDay->dayOfWeek;

                $selectedDay = $selectedDate
                    ? \Carbon\Carbon::parse($selectedDate)->day
                    : null;
            @endphp

            <div class="baptism-days">

                @for ($i = 0; $i < $startWeekday; $i++)
                    <div></div>
                @endfor

                @for ($day = 1; $day <= $daysInMonth; $day++)

                    <div
                        wire:click="selectDay({{ $day }})"
                        class="
                            baptism-day
                            {{ $selectedDay === $day ? 'selected' : '' }}
                        "
                    >

                        {{ $day }}

                        @if (in_array($day, $this->baptismDays))
                            <span class="baptism-dot"></span>
                        @endif

                    </div>

                @endfor

            </div>

        </x-filament::section>


        <x-filament::section>

            <x-slot name="heading">
                @if ($selectedDate)
                    Batismos em
                    {{ \Carbon\Carbon::parse($selectedDate)->format('d/m/Y') }}
                @else
                    Batismos
                @endif
            </x-slot>

            @forelse ($this->selectedBaptisms as $baptism)

                <div class="baptism-person">

                    <div class="baptism-name">
                        {{ $baptism->person?->name ?? '—' }}
                    </div>

                    <div class="baptism-info">
                        📅
                        {{ \Carbon\Carbon::parse($baptism->baptism_date)->format('d/m/Y') }}
                    </div>

                    @if ($baptism->location)
                        <div class="baptism-info">
                            📍 {{ $baptism->location }}
                        </div>
                    @endif

                    @if ($baptism->officiant)
                        <div class="baptism-info">
                            👤 {{ $baptism->officiant }}
                        </div>
                    @endif

                </div>

            @empty

                <div style="padding: 15px 0; opacity: .6;">
                    Nenhum batismo nesta data.
                </div>

            @endforelse

        </x-filament::section>

    </div>

</x-filament-panels::page>