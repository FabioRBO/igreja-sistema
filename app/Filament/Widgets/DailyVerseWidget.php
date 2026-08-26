<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class DailyVerseWidget extends Widget
{
    protected string $view = 'filament.widgets.daily-verse-widget';

    //protected int|string|array $columnSpan = 1;

    protected int|string|array $columnSpan = [
        'md' => 2,
        'xl' => 2,
    ];

    public string $verse = '';
    public string $reference = '';

    public function mount(): void
    {
        $dailyVerse = Cache::remember(
            'daily_bible_verse_' . now()->format('Y-m-d'),
            now()->endOfDay(),
            fn (): array => $this->fetchDailyVerse()
        );

        $this->verse = $dailyVerse['verse'];
        $this->reference = $dailyVerse['reference'];
    }

    private function fetchDailyVerse(): array
    {
        /*
         * Por enquanto usamos uma lista local segura.
         * Depois podemos ligar à API.Bible usando uma chave.
         */
        $verses = [
            [
                'verse' => 'O Senhor é o meu pastor; nada me faltará.',
                'reference' => 'Salmos 23:1',
            ],
            [
                'verse' => 'Tudo posso naquele que me fortalece.',
                'reference' => 'Filipenses 4:13',
            ],
            [
                'verse' => 'Lâmpada para os meus pés é a tua palavra e luz para o meu caminho.',
                'reference' => 'Salmos 119:105',
            ],
            [
                'verse' => 'Entrega o teu caminho ao Senhor; confia nele, e ele tudo fará.',
                'reference' => 'Salmos 37:5',
            ],
            [
                'verse' => 'Porque para Deus não haverá impossíveis em todas as suas promessas.',
                'reference' => 'Lucas 1:37',
            ],
        ];

        $index = now()->dayOfYear % count($verses);

        return $verses[$index];
    }
}