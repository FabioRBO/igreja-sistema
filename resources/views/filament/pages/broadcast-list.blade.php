<x-filament-panels::page>

    <style>
        .broadcast-sections {
            display: grid;
            gap: 32px;
        }

        .broadcast-grid {
            display: grid;
            grid-template-columns: minmax(0, 2fr) minmax(300px, 1fr);
            gap: 18px;
            align-items: start;
        }

        .broadcast-field {
            width: 100%;
        }

        .broadcast-label {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            font-weight: 600;
        }

        .broadcast-select,
        .broadcast-textarea {
            width: 100%;
            box-sizing: border-box;
            border-radius: 8px;
            border: 1px solid rgba(128, 128, 128, .30);
            background: transparent;
            color: inherit;
            padding: 9px 11px;
        }

        .broadcast-textarea {
            min-height: 160px;
            resize: vertical;
        }

        .broadcast-select option {
            background: #18181b;
            color: #ffffff;
        }

        .broadcast-recipients {
            width: 100%;
            min-height: 160px;
            max-height: 260px;
            overflow-y: auto;
            border: 1px solid rgba(128, 128, 128, .30);
            border-radius: 8px;
            padding: 10px 12px;
            box-sizing: border-box;
        }

        .broadcast-recipient {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 2px;
            border-bottom: 1px solid rgba(128, 128, 128, .12);
        }

        .broadcast-recipient:last-child {
            border-bottom: none;
        }

        .broadcast-empty {
            padding: 20px 5px;
            text-align: center;
            opacity: .6;
            font-size: 13px;
        }

        .broadcast-count {
            margin-top: 8px;
            font-size: 12px;
            opacity: .65;
        }

        .broadcast-actions {
            margin-top: 16px;
        }

        @media (max-width: 900px) {
            .broadcast-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>


    <div class="broadcast-sections">

        {{-- PUSH --}}
        <x-filament::section>

            <x-slot name="heading">
                Push
            </x-slot>

            <x-slot name="description">
                Envio de notificações para pessoas cadastradas.
            </x-slot>


            <div class="broadcast-field">

                <label class="broadcast-label">
                    Público
                </label>

                <select
                    wire:model.live="pushAudience"
                    class="broadcast-select"
                >
                    <option value="birthday_today">
                        Aniversariantes de hoje
                    </option>

                    <option value="birthday_week">
                        Aniversariantes da semana
                    </option>

                    <option value="wedding_anniversary">
                        Aniversários de casamento
                    </option>

                    <option value="all">
                        Todos
                    </option>
                </select>

            </div>


            <div
                class="broadcast-grid"
                style="margin-top: 16px;"
            >

                <div>

                    <label class="broadcast-label">
                        Mensagem
                    </label>

                    <textarea
                        wire:model="pushMessage"
                        class="broadcast-textarea"
                        rows="6"
                    ></textarea>

                </div>


                <div>

                    <label class="broadcast-label">
                        Quem vai receber
                    </label>

                    <div class="broadcast-recipients">

                        @forelse ($this->pushRecipients as $person)

                            <label class="broadcast-recipient">

                                <input
                                    type="checkbox"
                                    wire:model.live="pushSelected"
                                    value="{{ $person->id }}"
                                >

                                <span>
                                    {{ $person->name }}
                                </span>

                            </label>

                        @empty

                            <div class="broadcast-empty">
                                Nenhuma pessoa encontrada.
                            </div>

                        @endforelse

                    </div>

                    <div class="broadcast-count">
                        {{ count($pushSelected) }}
                        pessoa(s) selecionada(s)
                    </div>

                </div>

            </div>


            <div class="broadcast-actions">

                <x-filament::button>
                    Enviar Push
                </x-filament::button>

            </div>

        </x-filament::section>



        {{-- SMS --}}
        <x-filament::section>

            <x-slot name="heading">
                SMS
            </x-slot>

            <x-slot name="description">
                Envio de mensagens SMS para pessoas cadastradas.
            </x-slot>


            <div class="broadcast-field">

                <label class="broadcast-label">
                    Público
                </label>

                <select
                    wire:model.live="smsAudience"
                    class="broadcast-select"
                >
                    <option value="birthday_today">
                        Aniversariantes de hoje
                    </option>

                    <option value="birthday_week">
                        Aniversariantes da semana
                    </option>

                    <option value="wedding_anniversary">
                        Aniversários de casamento
                    </option>

                    <option value="all">
                        Todos
                    </option>
                </select>

            </div>


            <div
                class="broadcast-grid"
                style="margin-top: 16px;"
            >

                <div>

                    <label class="broadcast-label">
                        Mensagem
                    </label>

                    <textarea
                        wire:model="smsMessage"
                        class="broadcast-textarea"
                        rows="6"
                    ></textarea>

                </div>


                <div>

                    <label class="broadcast-label">
                        Quem vai receber
                    </label>

                    <div class="broadcast-recipients">

                        @forelse ($this->smsRecipients as $person)

                            <label class="broadcast-recipient">

                                <input
                                    type="checkbox"
                                    wire:model.live="smsSelected"
                                    value="{{ $person->id }}"
                                >

                                <span>
                                    {{ $person->name }}

                                    @if ($person->phone)
                                        — {{ $person->phone }}
                                    @endif
                                </span>

                            </label>

                        @empty

                            <div class="broadcast-empty">
                                Nenhuma pessoa encontrada.
                            </div>

                        @endforelse

                    </div>

                    <div class="broadcast-count">
                        {{ count($smsSelected) }}
                        pessoa(s) selecionada(s)
                    </div>

                </div>

            </div>


            <div class="broadcast-actions">

                <x-filament::button>
                    Enviar SMS
                </x-filament::button>

            </div>

        </x-filament::section>

    </div>

</x-filament-panels::page>