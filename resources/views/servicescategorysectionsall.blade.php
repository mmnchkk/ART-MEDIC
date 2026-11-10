@push('vite')
    @vite(['resources/css/app.css', 'resources/css/servicescategorysectionsall.css'])
@endpush

<x-main>
    <x-slot:title>
        Услуги | Арт-Медика
    </x-slot:title>

    <div class="services-page">
        <!-- Хлебные крошки -->
        <nav class="services-breadcrumbs">
            <a href="/">Арт-Медика</a>
            <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="current">Услуги</span>
        </nav>

        <!-- Шапка страницы -->
        <div class="services-header">
            <h1 class="services-title">
                Услуги
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                </svg>
            </h1>

            <p class="services-header-description">
                В клинике «Арт-медика» мы объединили многолетний опыт врачей и современные технологии, чтобы предложить вам максимально широкий спектр медицинских и эстетических услуг.
            </p>
        </div>

        <!-- Сетка категорий -->
        <div class="services-grid">
            @forelse($sections as $item)
                <a href="{{ route('services.section', $item->id) }}" class="service-card">
                    <div class="service-card-image-wrap">
                        @if(!empty($item->image))
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="service-card-image" loading="lazy">
                        @else
                            <div class="service-card-image-placeholder">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="service-card-body">
                        <h2 class="service-card-title">{{ $item->name }}</h2>
                        @if(!empty($item->description))
                            <div class="service-card-desc">{{ trim(preg_replace("/[\r\n]{3,}/", "\n\n", $item->description)) }}</div>
                        @endif
                    </div>
                </a>
            @empty
                <div class="services-empty-placeholder" style="grid-column: 1 / -1;">
                    Разделы услуг пока не добавлены.
                </div>
            @endforelse
        </div>
    </div>
</x-main>
