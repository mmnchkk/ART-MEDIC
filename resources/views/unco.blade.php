```blade
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
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none">
                    <path
                        d="M19.6847 19.6326L19.6274 1.50556L1.5003 1.56291M19.6274 1.50556L3.06346 18.1746"
                        stroke="#91B5D5"
                        stroke-width="3"
                        stroke-linecap="round" />
                </svg>
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
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M13.5004 0.75V10.5C13.5004 10.6989 13.4214 10.8897 13.2807 11.0303C13.1401 11.171 12.9493 11.25 12.7504 11.25C12.5515 11.25 12.3607 11.171 12.2201 11.0303C12.0794 10.8897 12.0004 10.6989 12.0004 10.5V2.56031L1.28104 13.2806C1.14031 13.4214 0.94944 13.5004 0.750417 13.5004C0.551394 13.5004 0.360523 13.4214 0.219792 13.2806C0.0790615 13.1399 0 12.949 0 12.75C0 12.551 0.0790615 12.3601 0.219792 12.2194L10.9401 1.5H3.00042C2.8015 1.5 2.61074 1.42098 2.47009 1.28033C2.32943 1.13968 2.25042 0.948912 2.25042 0.75C2.25042 0.551088 2.32943 0.360322 2.47009 0.21967C2.61074 0.0790178 2.8015 0 3.00042 0H12.7504C12.9493 0 13.1401 0.0790178 13.2807 0.21967C13.4214 0.360322 13.5004 0.551088 13.5004 0.75Z"
                            fill="#212529" />
                    </svg>
                </div>

                <div class="news-card-image">
                    <img src="{{ asset('storage/' . $unco->image) }}"
                        alt="{{ $unco->title }}"
                        onerror="this.onerror=null; this.src='/img/news/cosmetology.jpg';">
                </div>

                <div class="news-card-content">
                    <p class="news-card-text">
                        {{ \Illuminate\Support\Str::limit($unco->title, 90, '...') }}
                    </p>

                    <p class="news-card-date">
                        {{ \Carbon\Carbon::parse($unco->data)->format('d.m.Y') }}
                    </p>
                </div>
            </a>
            @empty
            <p>Нет новостей.</p>
            @endforelse
        </div>

        @if ($uncos->hasPages())
        <div class="news-pagination">

            {{-- Кнопка предыдущей страницы --}}
            @if ($uncos->onFirstPage())
            <span class="pagination-arrow is-disabled" aria-disabled="true">
                <svg width="27" height="21" viewBox="0 0 27 21" fill="none">
                    <path
                        d="M2.12109 10.0605L1.06043 8.99989L-0.000227284 10.0605L1.06043 11.1212L2.12109 10.0605ZM24.6211 11.5605C25.4495 11.5605 26.1211 10.889 26.1211 10.0605C26.1211 9.23212 25.4495 8.56055 24.6211 8.56055L24.6211 10.0605L24.6211 11.5605ZM11.1211 1.06055L10.0604 -0.000112555L1.06043 8.99989L2.12109 10.0605L3.18175 11.1212L12.1818 2.12121L11.1211 1.06055ZM2.12109 10.0605L1.06043 11.1212L10.0604 20.1212L11.1211 19.0605L12.1818 17.9999L3.18175 8.99989L2.12109 10.0605ZM2.12109 10.0605L2.12109 11.5605L24.6211 11.5605L24.6211 10.0605L24.6211 8.56055L2.12109 8.56055L2.12109 10.0605Z"
                        fill="#F4F7FF" />
                </svg>
            </span>
            @else
            <a href="{{ $uncos->previousPageUrl() }}"
                class="pagination-arrow"
                aria-label="Предыдущая страница">
                <svg width="27" height="21" viewBox="0 0 27 21" fill="none">
                    <path
                        d="M2.12109 10.0605L1.06043 8.99989L-0.000227284 10.0605L1.06043 11.1212L2.12109 10.0605ZM24.6211 11.5605C25.4495 11.5605 26.1211 10.889 26.1211 10.0605C26.1211 9.23212 25.4495 8.56055 24.6211 8.56055L24.6211 10.0605L24.6211 11.5605ZM11.1211 1.06055L10.0604 -0.000112555L1.06043 8.99989L2.12109 10.0605L3.18175 11.1212L12.1818 2.12121L11.1211 1.06055ZM2.12109 10.0605L1.06043 11.1212L10.0604 20.1212L11.1211 19.0605L12.1818 17.9999L3.18175 8.99989L2.12109 10.0605ZM2.12109 10.0605L2.12109 11.5605L24.6211 11.5605L24.6211 10.0605L24.6211 8.56055L2.12109 8.56055L2.12109 10.0605Z"
                        fill="#F4F7FF" />
                </svg>
            </a>
            @endif

            {{-- Номера страниц --}}
            <div class="pagination-pages">
                @for ($page = 1; $page <= $uncos->lastPage(); $page++)
                    @if ($page == $uncos->currentPage())
                    <span class="pagination-page is-active" aria-current="page">
                        {{ $page }}
                    </span>
                    @else
                    <a href="{{ $uncos->url($page) }}" class="pagination-page">
                        {{ $page }}
                    </a>
                    @endif
                    @endfor
            </div>

            {{-- Кнопка следующей страницы --}}
            @if ($uncos->hasMorePages())
            <a href="{{ $uncos->nextPageUrl() }}"
                class="pagination-arrow"
                aria-label="Следующая страница">
                <svg width="27" height="21" viewBox="0 0 27 21" fill="none">
                    <path
                        d="M24 10.0605L25.0607 11.1212L26.1213 10.0605L25.0607 8.99989L24 10.0605ZM1.5 8.56054C0.671575 8.56054 1.71846e-06 9.23212 1.57361e-06 10.0605C1.42876e-06 10.889 0.671575 11.5605 1.5 11.5605L1.5 10.0605L1.5 8.56054ZM15 19.0605L16.0607 20.1212L25.0607 11.1212L24 10.0605L22.9393 8.99989L13.9393 17.9999L15 19.0605ZM24 10.0605L25.0607 8.99989L16.0607 -0.000113922L15 1.06055L13.9393 2.1212L22.9393 11.1212L24 10.0605ZM24 10.0605L24 8.56055L1.5 8.56054L1.5 10.0605L1.5 11.5605L24 11.5605L24 10.0605Z"
                        fill="#F4F7FF" />
                </svg>
            </a>
            @else
            <span class="pagination-arrow is-disabled" aria-disabled="true">
                <svg width="27" height="21" viewBox="0 0 27 21" fill="none">
                    <path
                        d="M24 10.0605L25.0607 11.1212L26.1213 10.0605L25.0607 8.99989L24 10.0605ZM1.5 8.56054C0.671575 8.56054 1.71846e-06 9.23212 1.57361e-06 10.0605C1.42876e-06 10.889 0.671575 11.5605 1.5 11.5605L1.5 10.0605L1.5 8.56054ZM15 19.0605L16.0607 20.1212L25.0607 11.1212L24 10.0605L22.9393 8.99989L13.9393 17.9999L15 19.0605ZM24 10.0605L25.0607 8.99989L16.0607 -0.000113922L15 1.06055L13.9393 2.1212L22.9393 11.1212L24 10.0605ZM24 10.0605L24 8.56055L1.5 8.56054L1.5 10.0605L1.5 11.5605L24 10.0605Z"
                        fill="#F4F7FF" />
                </svg>
            </span>
            @endif

        </div>
        @endif
    </div>
</x-main>
```