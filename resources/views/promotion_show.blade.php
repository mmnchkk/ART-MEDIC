@push('vite')
    @vite('resources/css/app.css')
    @vite('resources/css/promotions.css')
@endpush

<x-main>
    <x-slot:title>
        {{ $promotion->name }} | Арт-Медика
    </x-slot:title>

    <div class="promotions-page">
        @php
            $firstService = $promotion->services->first();
            $serviceCategoryName = $firstService?->name ?? 'Нитевой лифтинг';
        @endphp

        <!-- Хлебные крошки: Арт-Медика > Название услуги/категории -->
        <nav class="promotions-breadcrumbs">
            <a href="/">Арт-Медика</a>
            <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="{{ route('promotions.index') }}">Акции</a>
            <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="current">{{ $serviceCategoryName }}</span>
        </nav>

        <!-- Шапка: Слева название категории со стрелкой ↗, справа заголовок акции -->
        <div class="promotions-header">
            @if ($firstService)
                <a href="{{ route('services.show', $firstService->id) }}" class="promotions-title" title="Перейти к услуге">
                    {{ $serviceCategoryName }}
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                    </svg>
                </a>
            @else
                <a href="{{ route('promotions.index') }}" class="promotions-title">
                    {{ $serviceCategoryName }}
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                    </svg>
                </a>
            @endif

            <h1 class="promotions-detail-title">
                {{ $promotion->name }}
            </h1>
        </div>

        <!-- Контент: Слева фото, справа текст и дата -->
        <div class="promotions-detail-layout">
            <div class="promotions-detail-image-box">
                <img 
                    src="{{ $promotion->image ? asset('storage/' . $promotion->image) : '/img/logo.svg' }}" 
                    alt="{{ $promotion->name }}"
                    onerror="this.onerror=null; this.src='/img/logo.svg'; this.style.objectFit='contain'; this.style.padding='40px';"
                >
            </div>

            <div class="promotions-detail-body">
                <div class="promotions-detail-text">
                    {!! $promotion->description !!}
                </div>

                @if ($promotion->date)
                    <div class="promotions-detail-date">
                        {{ \Carbon\Carbon::parse($promotion->date)->format('d.m.Y') }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Связанные услуги (если привязано больше 1 или нужно перейти) -->
        @if ($promotion->services->isNotEmpty())
            <div class="promotions-detail-services">
                <h3 class="promotions-detail-services-title">
                    Услуги, участвующие в акции:
                </h3>
                <div class="promotions-detail-services-list">
                    @foreach ($promotion->services as $service)
                        <a href="{{ route('services.show', $service->id) }}" class="promotions-detail-service-link">
                            <span>{{ $service->name }}</span>
                            <span>Подробнее →</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Блок «Другие акции» снизу со списком и пагинацией (как на макете) -->
        @if ($otherPromotions->count() > 0)
            <div class="promotions-other-section">
                <div class="promotions-grid">
                    @foreach ($otherPromotions as $other)
                        @php
                            $otherService = $other->services->first();
                            $otherTag = $otherService ? 'Акции / ' . $otherService->name : 'Акции';
                            $otherCleanDesc = strip_tags($other->description);
                        @endphp
                        <a href="{{ route('promotions.show', $other->id) }}" class="promotion-card">
                            <div class="promotion-card-image-col">
                                <img 
                                    src="{{ $other->image ? asset('storage/' . $other->image) : '/img/logo.svg' }}" 
                                    alt="{{ $other->name }}" 
                                    onerror="this.onerror=null; this.src='/img/logo.svg'; this.style.objectFit='contain'; this.style.padding='30px';"
                                >
                            </div>
                            <div class="promotion-card-content-col">
                                <div class="promotion-card-meta-top">
                                    <span class="promotion-card-tag" title="{{ $otherTag }}">{{ $otherTag }}</span>
                                    <div class="promotion-card-arrow-icon" aria-hidden="true">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                                        </svg>
                                    </div>
                                </div>

                                <h2 class="promotion-card-title">
                                    {{ $other->name }}
                                </h2>

                                <div class="promotion-card-desc">
                                    {{ $otherCleanDesc }}
                                </div>

                                <div class="promotion-card-date">
                                    {{ $other->date ? \Carbon\Carbon::parse($other->date)->format('d.m.Y') : '' }}
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Пагинация других акций (если их > 4) -->
                @if ($otherPromotions->hasPages())
                <div class="promotions-pagination">
                    @if ($otherPromotions->onFirstPage())
                        <span class="promotions-page-btn promotions-page-arrow disabled" aria-disabled="true">
                            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </span>
                    @else
                        <a href="{{ $otherPromotions->previousPageUrl() }}" class="promotions-page-btn promotions-page-arrow" aria-label="Предыдущая страница">
                            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </a>
                    @endif

                    <div class="promotions-page-numbers">
                        @foreach ($otherPromotions->links()->elements as $element)
                            @if (is_string($element))
                                <span class="promotions-page-btn promotions-page-dots">{{ $element }}</span>
                            @endif
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $otherPromotions->currentPage())
                                        <span class="promotions-page-btn promotions-page-num active">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}" class="promotions-page-btn promotions-page-num">{{ $page }}</a>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </div>

                    @if ($otherPromotions->hasMorePages())
                        <a href="{{ $otherPromotions->nextPageUrl() }}" class="promotions-page-btn promotions-page-arrow" aria-label="Следующая страница">
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
        @endif
    </div>
</x-main>
