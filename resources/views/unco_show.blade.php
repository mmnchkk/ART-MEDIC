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
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.5004 0.75V10.5C13.5004 10.6989 13.4214 10.8897 13.2807 11.0303C13.1401 11.171 12.9493 11.25 12.7504 11.25C12.5515 11.25 12.3607 11.171 12.2201 11.0303C12.0794 10.8897 12.0004 10.6989 12.0004 10.5V2.56031L1.28104 13.2806C1.14031 13.4214 0.94944 13.5004 0.750417 13.5004C0.551394 13.5004 0.360523 13.4214 0.219792 13.2806C0.0790615 13.1399 0 12.949 0 12.75C0 12.551 0.0790615 12.3601 0.219792 12.2194L10.9401 1.5H3.00042C2.8015 1.5 2.61074 1.42098 2.47009 1.28033C2.32943 1.13968 2.25042 0.948912 2.25042 0.75C2.25042 0.551088 2.32943 0.360322 2.47009 0.21967C2.61074 0.0790178 2.8015 0 3.00042 0H12.7504C12.9493 0 13.1401 0.0790178 13.2807 0.21967C13.4214 0.360322 13.5004 0.551088 13.5004 0.75Z" fill="#212529" />
                        </svg>
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