@push('vite')
    @vite(['resources/css/app.css', 'resources/css/servicescategorysections.css'])
@endpush

<x-main>
    <x-slot:title>
        {{ !empty($sectionAll?->name) ? $sectionAll->name . ' | Арт-Медика' : 'Услуги | Арт-Медика' }}
    </x-slot:title>

    <div class="services-sections-page">
        <!-- Хлебные крошки -->
        <nav class="services-breadcrumbs">
            <a href="/">Арт-Медика</a>
            <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="{{ route('services.index') }}">Услуги</a>
            @if(!empty($sectionAll?->name))
                <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="current">{{ $sectionAll->name }}</span>
            @endif
        </nav>

        @if(!empty($sectionAll?->name))
            <!-- Шапка раздела -->
            <div class="services-sections-header">
                <h1 class="services-sections-title">
                    {{ $sectionAll->name }}
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                    </svg>
                </h1>

                @if(!empty($sectionAll->description))
                    <p class="services-sections-desc">
                        {{ $sectionAll->description }}
                    </p>
                @endif
            </div>
        @endif

        <!-- Список подразделов (servicescategorysections) -->
        <div class="services-sections-list">
            @forelse($sections as $item)
                <div class="services-section-card">
                    <div class="services-section-content">
                        <div class="services-section-content-top">
                            <h2 class="services-section-name">{{ $item->name }}</h2>
                            @if(!empty($item->description))
                                <div class="services-section-text">{{ trim(preg_replace("/[\r\n]{3,}/", "\n\n", $item->description)) }}</div>
                            @endif
                        </div>
                        <div class="services-section-content-bottom">
                            <a href="{{ route('services.category', $item->id) }}" class="services-section-btn">
                                Подробнее
                            </a>
                        </div>
                    </div>

                    <div class="services-section-image-wrap">
                        @if(!empty($item->image))
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="services-section-image" loading="lazy">
                        @else
                            <div class="services-section-placeholder">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="services-empty-placeholder">
                    Подразделы для данного направления пока не добавлены.
                </div>
            @endforelse
        </div>
    </div>
</x-main>
