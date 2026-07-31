<x-filament-widgets::widget>
    <x-filament::section>
        
        <!-- O SEGREDO ESTÁ AQUI: flex e flex-row forçam os itens a ficarem lado a lado -->
        <div class="flex flex-row items-center gap-4">

            <!-- LADO DIREITO: Textos -->
            <!-- flex-col empilha o Título e o Versículo -->
            <div class="flex flex-col min-w-0">
                <div class="text-base font-semibold text-gray-950 dark:text-white truncate">
                    Versículo do dia
                </div>
                
                <div class="text-sm text-gray-500 dark:text-gray-400 truncate">
                    “{{ $verse }}” — {{ $reference }}
                </div>
            </div>

        </div>

    </x-filament::section>
</x-filament-widgets::widget>