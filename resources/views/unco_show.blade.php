@push('vite')
@vite('resources/css/app.css')
@vite('resources/css/unco_show.css')
@endpush

<x-main>
    <x-slot:title>{{ $unco->title }}</x-slot:title>

    <div class="news news-show">
        <div class="news-navigation">
            <a href="/">Арт-Медика</a>
            <span>&gt;</span>
            <a href="{{ route('uncos') }}">Новости</a>
            <span>&gt;</span>
            <p class="news-navigation-current">{{ $unco->title }}</p>
        </div>

        <div class="news-title news-show-title">
            <div class="news-title-nav">
                <a href="{{ route('uncos') }}" class="news-show-back" aria-label="Вернуться к новостям">
                    <h1>Хирургия</h1>
                </a>
            </div>
            <h2 class="news-title-description">{{ $unco->title }}</h2>
        </div>

        <div class="news-description news-show-description">
            <div class="news-description-img">
                <img src="{{ asset('storage/' . $unco->image) }}"
                    alt="{{ $unco->title }}"
                    onerror="this.onerror=null; this.src='/img/news/cosmetology.jpg';">
            </div>
            <div class="news-description-text">
                {!! $unco->description !!}
                <p class="news-description-date">{{ \Carbon\Carbon::parse($unco->data)->format('d.m.Y') }}</p>
            </div>
        </div>

        @if (isset($otherUncos) && $otherUncos->count() > 0)
        <section class="news-show-related">
            <div class="news-cards">
                @foreach ($otherUncos as $other)
                <a href="{{ route('uncos.show', $other->id) }}" class="news-card news-card-small">
                    <div class="news-card-top">
                        <p>Новости</p>
                        <img src="{{ Vite::asset('resources/image/arrow-right-small.svg') }}" alt="">
                    </div>
                    <div class="news-card-image">
                        <img src="{{ asset('storage/' . $other->image) }}"
                            alt="{{ $other->title }}"
                            onerror="this.onerror=null; this.src='/img/news/cosmetology.jpg';">
                    </div>
                    <div class="news-card-content">
                        <p class="news-card-text">{{ \Illuminate\Support\Str::limit($other->title, 90, '...') }}</p>
                        <p class="news-card-date">{{ \Carbon\Carbon::parse($other->data)->format('d.m.Y') }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </section>
        @endif
    </div>
</x-main>