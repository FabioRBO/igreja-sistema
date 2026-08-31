<x-filament-panels::page>

    <style>
        .wedding-layout {
            display: grid;
            grid-template-columns: 7fr 3fr;
            gap: 18px;
        }

        .wedding-calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .wedding-calendar-title {
            font-size: 20px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .wedding-nav {
            cursor: pointer;
            padding: 8px 14px;
            border: 1px solid rgba(128,128,128,.25);
            border-radius: 8px;
            background: transparent;
            color: inherit;
        }

        .wedding-weekdays,
        .wedding-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 6px;
        }

        .wedding-weekday {
            padding: 8px;
            text-align: center;
            font-size: 12px;
            font-weight: 600;
            opacity: .6;
        }

        .wedding-day {
            position: relative;
            min-height: 75px;
            padding: 10px;
            border: 1px solid rgba(128,128,128,.15);
            border-radius: 8px;
            cursor: pointer;
        }

        .wedding-day:hover {
            background: rgba(128,128,128,.08);
        }

        .wedding-day.selected {
            border-color: #f59e0b;
        }

        .wedding-dot {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #f59e0b;
        }

        .wedding-person {
            padding: 12px 0;
            border-bottom: 1px solid rgba(128,128,128,.15);
        }

        .wedding-name {
            font-weight: 600;
        }

        .wedding-info {
            margin-top: 5px;
            font-size: 13px;
            opacity: .7;
        }

        @media (max-width: 900px) {
            .wedding-layout {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="wedding-layout">

        <x-filament::section>

            <div class="wedding-calendar-header">

                <button
                    type="button"
                    wire:click="previousMonth"
                    class="wedding-nav"
                >
                    ←
                </button>

                <div class="wedding-calendar-title">
                    {{
                        \Carbon\Carbon::create($year, $month, 1)
                            ->locale('pt_BR')
                            ->translatedFormat('F \d\e Y')
                    }}
                </div>

                <button
                    type="button"
                    wire:click="nextMonth"
                    class="wedding-nav"
                >
                    →
                </button>

            </div>

            <div class="wedding-weekdays">
                <div class="wedding-weekday">Dom</div>
                <div class="wedding-weekday">Seg</div>
                <div class="wedding-weekday">Ter</div>
                <div class="wedding-weekday">Qua</div>
                <div class="wedding-weekday">Qui</div>
                <div class="wedding-weekday">Sex</div>
                <div class="wedding-weekday">Sáb</div>
            </div>

            @php
                $firstDay = \Carbon\Carbon::create($year, $month, 1);

                $daysInMonth = $firstDay->daysInMonth;

                $startWeekday = $firstDay->dayOfWeek;

                $selectedDay = $selectedDate
                    ? \Carbon\Carbon::parse($selectedDate)->day
                    : null;
            @endphp

            <div class="wedding-days">

                @for ($i = 0; $i < $startWeekday; $i++)
                    <div></div>
                @endfor

                @for ($day = 1; $day <= $daysInMonth; $day++)

                    <div
                        wire:click="selectDay({{ $day }})"
                        class="
                            wedding-day
                            {{ $selectedDay === $day ? 'selected' : '' }}
                        "
                    >

                        {{ $day }}

                        @if (in_array($day, $this->weddingDays))
                            <span class="wedding-dot"></span>
                        @endif

                    </div>

                @endfor

            </div>

        </x-filament::section>


        <x-filament::section>

            <x-slot name="heading">
                @if ($selectedDate)
                    Aniversários em
                    {{ \Carbon\Carbon::parse($selectedDate)->format('d/m/Y') }}
                @else
                    Aniversários de Casamento
                @endif
            </x-slot>

            @forelse ($this->selectedMarriages as $marriage)

                @php
                    $anniversaryDate = \Carbon\Carbon::create(
                        $year,
                        $marriage->marriage_date->month,
                        $marriage->marriage_date->day
                    );

                    $years = $marriage->marriage_date
                        ->diffInYears($anniversaryDate);
                @endphp

                <div class="wedding-person">

                    <div class="wedding-name">
                        {{ $marriage->personOne?->name ?? '—' }}
                        &
                        {{ $marriage->personTwo?->name ?? '—' }}
                    </div>

                    <div class="wedding-info">
                        📅
                        {{ $marriage->marriage_date->format('d/m/Y') }}
                    </div>

                    <div class="wedding-info">
                        ❤️ {{ $years }} anos de casamento
                    </div>

                    @if ($marriage->church)
                        <div class="wedding-info">
                            ⛪ {{ $marriage->church->name }}
                        </div>
                    @endif

                </div>

            @empty

                <div style="padding: 15px 0; opacity: .6;">
                    Nenhum aniversário de casamento nesta data.
                </div>

            @endforelse

        </x-filament::section>

    </div>

</x-filament-panels::page>