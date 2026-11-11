@push('vite')
    @vite('resources/css/app.css')
    @vite('resources/css/promotions.css')
@endpush

<x-main>
    <x-slot:title>
        Акции | Арт-Медика
    </x-slot:title>

    <div class="promotions-page">
        <!-- Хлебные крошки -->
        <nav class="promotions-breadcrumbs">
            <a href="/">Арт-Медика</a>
            <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="current">Акции</span>
        </nav>

        <!-- Заголовок и вводный текст -->
        <div class="promotions-header">
            <h1 class="promotions-title">
                Акции
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                </svg>
            </h1>
            <div class="promotions-intro">
                Мы регулярно предлагаем выгодные акции и специальные предложения на популярные услуги, чтобы вы могли получать качественную медицинскую помощь по привлекательной стоимости
            </div>
        </div>

        <!-- Сетка карточек акций -->
        <div class="promotions-grid">
            @forelse ($promotions as $promotion)
                @php
                    $firstService = $promotion->services->first();
                    $tagText = $firstService ? 'Акции / ' . $firstService->name : 'Акции';
                    $cleanDesc = strip_tags($promotion->description);
                @endphp
                <a href="{{ route('promotions.show', $promotion->id) }}" class="promotion-card">
                    <div class="promotion-card-image-col">
                        <img 
                            src="{{ $promotion->image ? asset('storage/' . $promotion->image) : '/img/logo.svg' }}" 
                            alt="{{ $promotion->name }}" 
                            onerror="this.onerror=null; this.src='/img/logo.svg'; this.style.objectFit='contain'; this.style.padding='30px';"
                        >
                    </div>
                    <div class="promotion-card-content-col">
                        <div class="promotion-card-meta-top">
                            <span class="promotion-card-tag" title="{{ $tagText }}">{{ $tagText }}</span>
                            <div class="promotion-card-arrow-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                                </svg>
                            </div>
                        </div>

                        <h2 class="promotion-card-title">
                            {{ $promotion->name }}
                        </h2>

                        <div class="promotion-card-desc">
                            {{ $cleanDesc }}
                        </div>

                        <div class="promotion-card-date">
                            {{ $promotion->date ? \Carbon\Carbon::parse($promotion->date)->format('d.m.Y') : '' }}
                        </div>
                    </div>
                </a>
            @empty
                <div class="promotions-empty-placeholder" style="grid-column: 1 / -1;">
                    В данный момент действующих акций нет.
                </div>
            @endforelse
        </div>

        <!-- Пагинация -->
        @if ($promotions->hasPages())
        <div class="promotions-pagination">
            @if ($promotions->onFirstPage())
                <span class="promotions-page-btn promotions-page-arrow disabled" aria-disabled="true">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                </span>
            @else
                <a href="{{ $promotions->previousPageUrl() }}" class="promotions-page-btn promotions-page-arrow" aria-label="Предыдущая страница">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
            @endif

            <div class="promotions-page-numbers">
                @foreach ($promotions->links()->elements as $element)
                    @if (is_string($element))
                        <span class="promotions-page-btn promotions-page-dots">{{ $element }}</span>
                    @endif
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $promotions->currentPage())
                                <span class="promotions-page-btn promotions-page-num active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="promotions-page-btn promotions-page-num">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            @if ($promotions->hasMorePages())
                <a href="{{ $promotions->nextPageUrl() }}" class="promotions-page-btn promotions-page-arrow" aria-label="Следующая страница">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            @else
                <span class="promotions-page-btn promotions-page-arrow disabled" aria-disabled="true">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </span>
            @endif
        </div>
        @endif
    </div>
</x-main>

