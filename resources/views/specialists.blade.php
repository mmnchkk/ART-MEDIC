@push('vite')
@vite(['resources/css/app.css', 'resources/css/specialists.css'])
@endpush

<x-main>
    <x-slot:title>Наши специалисты | Арт-Медика</x-slot:title>

    <div class="specialists-page">
        <!-- Хлебные крошки -->
        <nav class="specialists-breadcrumbs">
            <a href="/">Арт-Медика</a>
            <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="current">Специалисты</span>
        </nav>

        <!-- Шапка -->
        <div class="specialists-header">
            <h1 class="specialists-title">
                Наши специалисты
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                </svg>
            </h1>

            <div class="specialists-intro">
                Наши специалисты — это команда профессионалов с многолетним опытом в пластической хирургии и косметологии. Они постоянно повышают своё мастерство, чтобы дарить вам гармонию, уверенность в себе и в своём теле.
            </div>
        </div>

        <!-- Фильтры по специальностям -->
        <div class="specialists-filters">
            <a href="{{ route('specialists') }}" class="specialists-filter-item {{ empty($selectedSpeciality) ? 'active' : '' }}">
                Все
            </a>
            @foreach($specialities as $spec)
                <a href="{{ route('specialists', ['speciality' => $spec->name]) }}" 
                   class="specialists-filter-item {{ $selectedSpeciality == $spec->name || $selectedSpeciality == $spec->id ? 'active' : '' }}">
                    {{ $spec->name }}
                </a>
            @endforeach
        </div>

        <!-- Сетка карточек специалистов -->
        <div class="specialists-grid">
            @forelse($specialists as $specialist)
                <a href="{{ route('specialists.show', $specialist->id) }}" class="specialist-card">
                    <div class="specialist-card-image">
                        @if($specialist->image)
                            @if(str_starts_with($specialist->image, 'http') || str_starts_with($specialist->image, '/'))
                                <img src="{{ $specialist->image }}" alt="{{ $specialist->full_name }}" onerror="this.onerror=null;this.src='/img/specialist-1.svg'">
                            @else
                                <img src="{{ asset('storage/' . $specialist->image) }}" alt="{{ $specialist->full_name }}" onerror="this.onerror=null;this.src='/img/specialist-1.svg'">
                            @endif
                        @else
                            <img src="/img/specialist-1.svg" alt="{{ $specialist->full_name }}">
                        @endif
                    </div>

                    <div class="specialist-card-content">
                        <div class="specialist-card-top">
                            <div class="specialist-tags">
                                @forelse($specialist->specialities as $spec)
                                    <span class="specialist-tag">{{ $spec->name }}</span>
                                @empty
                                    <span class="specialist-tag">Специалист</span>
                                @endforelse
                            </div>
                            <svg class="specialist-card-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                            </svg>
                        </div>

                        <div class="specialist-card-body">
                            <h2 class="specialist-card-name">{{ $specialist->full_name }}</h2>
                            <p class="specialist-card-desc">
                                {{ $specialist->description }}
                            </p>
                        </div>
                    </div>
                </a>
            @empty
                <div class="specialists-empty">
                    В данной категории специалисты пока не добавлены.
                </div>
            @endforelse
        </div>
    </div>
</x-main>
