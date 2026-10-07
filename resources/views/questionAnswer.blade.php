@push('vite')
    @vite('resources/css/app.css')
    @vite('resources/css/qa.css')
@endpush

<x-main>
    <x-slot:title>
        Вопросы и ответы
    </x-slot:title>

    <div class="qa-page">
        <!-- Хлебные крошки -->
        <nav class="qa-breadcrumbs">
            <a href="/">Арт-Медика</a>
            <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
            <span class="current">Вопросы и ответы</span>
        </nav>

        <!-- Шапка (заголовок + текст) -->
        <div class="qa-header">
            <h1 class="qa-title">
                Вопросы и ответы
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path></svg>
            </h1>
            <div class="qa-intro">
                Прозрачность медицинской помощи начинается с понятных ответов на сложные вопросы. Мы собрали самые частые обращения пациентов и детальные разъяснения наших врачей
            </div>
        </div>

        <!-- Аккордеон (Вопросы и ответы) -->
        <!-- x-data="{ active: 0 }" делает первый вопрос открытым по умолчанию, как на макете -->
        <div x-data="{ active: 0 }" class="qa-accordion-container">
            @foreach($quesAnss as $index => $quesAns)
                <div class="qa-item">
                    <button @click="active = active === {{ $index }} ? null : {{ $index }}" class="qa-item-btn">
                        <span class="qa-item-question">{{ $quesAns->question }}</span>
                        <svg :class="{'rotate': active === {{ $index }}}" class="qa-item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                    </button>
                    <div x-show="active === {{ $index }}" x-collapse>
                        <div class="qa-item-content">
                            <p class="qa-item-answer">{{ $quesAns->answer }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-main>