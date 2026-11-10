@push('vite')
@vite('resources/css/app.css')
@vite('resources/css/unco.css')
@endpush

<x-main>
    <x-slot:title>
        {{ $unco->title ?? '"Освежиться, но не более!"' }}
    </x-slot:title>

    <div class="news-page">
        <!-- Хлебные крошки -->
        <nav class="news-breadcrumbs">
            <a href="/">Арт-Медика</a>
            <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="{{ route('uncos') }}">Новости</a>
            <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="current">{{ $unco->title }}</span>
        </nav>

        <!-- Шапка: Иконка слева, заголовок справа -->
        <div class="news-header">
            <div class="news-title-nav">
                <a href="{{ route('uncos') }}" class="news-title-link">
                    <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                    </svg>
                </a>
            </div>
            <div class="news-intro" style="font-weight: 500;">
                {{ $unco->title }}
            </div>
        </div>

        <!-- Контент: Картинка слева, текст справа -->
        <div class="news-content-layout">
            <div class="news-detail-image-wrapper">
                <img src="{{ asset('storage/' . $unco->image) }}" alt="{{ $unco->title }}" onerror="this.src='/img/news/cosmetology.jpg'">
            </div>
            <div class="news-detail-text">
                {!! $unco->description !!}
            </div>
        </div>

        <!-- Похожие новости (сетка из 4 карточек) -->
        @if(count($otherUncos) > 0)
        <div class="news-grid" style="margin-bottom: 0;">
            @foreach ($otherUncos as $other)
            <a href="{{ route('uncos.show', $other->id) }}" class="news-card">
                <div class="news-card-header">
                    <span>Новость</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                    </svg>
                </div>
                <div class="news-card-img-wrapper">
                    <img src="{{ asset('storage/' . $other->image) }}" alt="{{ $other->title }}" onerror="this.src='/img/news/cosmetology.jpg'">
                </div>
                <div class="news-card-title">{{ \Illuminate\Support\Str::limit($other->title, 55, '...') }}</div>
                <div class="news-card-date">{{ \Carbon\Carbon::parse($other->data)->format('d.m.Y') }}</div>
            </a>
            @endforeach
        </div>
        @endif
    </div>
</x-main>