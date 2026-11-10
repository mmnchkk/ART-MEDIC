@push('vite')
@vite('resources/css/app.css')
@vite('resources/css/unco.css')
@endpush

<x-main>
    <x-slot:title>
        Новости
    </x-slot:title>

    <div class="news-page">
        <!-- Хлебные крошки -->
        <nav class="news-breadcrumbs">
            <a href="/">Арт-Медика</a>
            <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="current">Новости</span>
        </nav>

        <!-- Шапка -->
        <div class="news-header">
            <h1 class="news-title">
                Новости
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                </svg>
            </h1>
            <div class="news-intro">
                В этом разделе мы собираем всё, что формирует доверие пациентов: открытые итоги работы, значимые события, запуск новых услуг и кадровые изменения, влияющие на качество приёма
            </div>
        </div>

        <!-- Сетка карточек -->
        <div class="news-grid">
            @forelse ($uncos as $unco)
            <a href="{{ route('uncos.show', $unco->id) }}" class="news-card">
                <div class="news-card-header">
                    <span>Новость</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                    </svg>
                </div>
                <div class="news-card-img-wrapper">
                    <img src="{{ asset('storage/' . $unco->image) }}" alt="{{ $unco->title }}" onerror="this.src='/img/news/cosmetology.jpg'">
                </div>
                <div class="news-card-title">{{ \Illuminate\Support\Str::limit($unco->title, 55, '...') }}</div>
                <div class="news-card-date">{{ \Carbon\Carbon::parse($unco->data)->format('d.m.Y') }}</div>
            </a>
            @empty
                <div class="services-empty-placeholder" style="grid-column: 1 / -1;">
                    Новости пока не добавлены.
                </div>
            @endforelse
        </div>

        <!-- Пагинация -->
        @if ($uncos->hasPages())
        <div class="news-pagination">
            @if ($uncos->onFirstPage())
            <span class="news-page-btn news-page-arrow disabled">
                <svg width="24" height="24" fill="none" stroke="#ffffff" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </span>
            @else
            <a href="{{ $uncos->previousPageUrl() }}" class="news-page-btn news-page-arrow">
                <svg width="24" height="24" fill="none" stroke="#ffffff" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            @endif

            <div class="news-page-numbers">
                @foreach ($uncos->links()->elements as $element)
                @if (is_string($element))
                <span class="news-page-btn news-page-dots">{{ $element }}</span>
                @endif
                @if (is_array($element))
                @foreach ($element as $page => $url)
                @if ($page == $uncos->currentPage())
                <span class="news-page-btn news-page-num active">{{ $page }}</span>
                @else
                <a href="{{ $url }}" class="news-page-btn news-page-num">{{ $page }}</a>
                @endif
                @endforeach
                @endif
                @endforeach
            </div>

            @if ($uncos->hasMorePages())
            <a href="{{ $uncos->nextPageUrl() }}" class="news-page-btn news-page-arrow">
                <svg width="24" height="24" fill="none" stroke="#ffffff" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
            @else
            <span class="news-page-btn news-page-arrow disabled">
                <svg width="24" height="24" fill="none" stroke="#ffffff" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </span>
            @endif
        </div>
        @endif
    </div>
</x-main>