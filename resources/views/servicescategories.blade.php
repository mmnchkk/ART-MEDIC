@push('vite')
    @vite(['resources/css/app.css', 'resources/css/servicescategories.css'])
@endpush

<x-main>
    <x-slot:title>
        {{ !empty($section?->name) ? $section->name . ' | Арт-Медика' : 'Услуги | Арт-Медика' }}
    </x-slot:title>

    <div class="services-categories-page">
        <!-- Хлебные крошки -->
        <nav class="services-breadcrumbs">
            <a href="/">Арт-Медика</a>
            <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="{{ route('services.index') }}">Услуги</a>
            @if(!empty($section?->sectionAll))
                <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('services.section', $section->sectionAll->id) }}">
                    {{ $section->sectionAll->name }}
                </a>
            @endif
            @if(!empty($section?->name))
                <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="current">{{ $section->name }}</span>
            @endif
        </nav>

        @if(!empty($section?->name))
            <!-- Заголовок страницы -->
            <div class="services-categories-header">
                <h1 class="services-categories-title">
                    {{ $section->name }}
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                    </svg>
                </h1>
            </div>
        @endif

        <!-- Сетка категорий (3 колонки) -->
        <div class="services-categories-grid">
            @forelse($categories as $cat)
                <a href="{{ route('services.show', $cat->id) }}" class="services-category-card">
                    <h2 class="services-category-name">{{ $cat->name }}</h2>
                </a>
            @empty
                <div class="services-empty-placeholder" style="grid-column: 1 / -1;">
                    Категории услуг пока не добавлены.
                </div>
            @endforelse
        </div>
    </div>
</x-main>
