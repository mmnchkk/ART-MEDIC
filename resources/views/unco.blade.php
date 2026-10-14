@push('vite')
@vite('resources/css/app.css')
@vite('resources/css/unco.css')
@endpush

<x-main>
    <x-slot:title>Новости</x-slot:title>

    <div class="news">
        <div class="news-navigation">
            <a href="/">Арт-Медика</a>
            <span>&gt;</span>
            <p>Новости</p>
        </div>

        <div class="news-title">
            <div class="news-title-nav">
                <h1>Новости</h1>
                <!-- <img src="{{ Vite::asset('resources/image/arrow-right.svg') }}" alt="Новости"> -->
            </div>

            <p class="news-title-description">
                В этом разделе мы собираем всё, что формирует доверие пациентов:
                открытые итоги работы, значимые события, запуск новых услуг
                и кадровые изменения, влияющие на качество приёма
            </p>
        </div>

        <div class="news-cards">
            @forelse ($uncos as $unco)
            <a href="{{ route('uncos.show', $unco->id) }}" class="news-card news-card-small">
                <div class="news-card-top">
                    <p>Новости</p>
                    <!-- <img src="{{ Vite::asset('resources/image/arrow-right-small.svg') }}" alt=""> -->
                </div>
                <div class="news-card-image">
                    <img src="{{ asset('storage/' . $unco->image) }}"
                        alt="{{ $unco->title }}"
                        onerror="this.onerror=null; this.src='/img/news/cosmetology.jpg';">
                </div>
                <div class="news-card-content">
                    <p class="news-card-text">{{ \Illuminate\Support\Str::limit($unco->title, 90, '...') }}</p>
                    <p class="news-card-date">{{ \Carbon\Carbon::parse($unco->data)->format('d.m.Y') }}</p>
                </div>
            </a>
            @empty
            <p>Нет новостей.</p>
            @endforelse
        </div>

        @if ($uncos->hasPages())
        <div class="news-pagination">
            @if ($uncos->onFirstPage())
            <span class="pagination-arrow is-disabled" aria-disabled="true">
                <img src="{{ Vite::asset('resources/image/pagination-arrow-left.svg') }}" alt="Назад">
            </span>
            @else
            <a href="{{ $uncos->previousPageUrl() }}" class="pagination-arrow" aria-label="Предыдущая страница">
                <img src="{{ Vite::asset('resources/image/pagination-arrow-left.svg') }}" alt="Назад">
            </a>
            @endif

            <div class="pagination-pages">
                @for ($page = 1; $page <= $uncos->lastPage(); $page++)
                    @if ($page == $uncos->currentPage())
                    <span class="pagination-page is-active" aria-current="page">{{ $page }}</span>
                    @else
                    <a href="{{ $uncos->url($page) }}" class="pagination-page">{{ $page }}</a>
                    @endif
                    @endfor
            </div>

            @if ($uncos->hasMorePages())
            <a href="{{ $uncos->nextPageUrl() }}" class="pagination-arrow">

            </a>
            @else
            <span class="pagination-arrow is-disabled" aria-disabled="true">

            </span>
            @endif
        </div>
        @endif
    </div>
</x-main>