@push('vite')
    @vite(['resources/css/app.css', 'resources/css/specialists.css', 'resources/css/services.css'])
@endpush

<x-main>
    <x-slot:title>
        {{ !empty($service?->name) ? $service->name . ' | Арт-Медика' : 'Услуга | Арт-Медика' }}
    </x-slot:title>

    <div class="services-detail-page">
        <!-- Хлебные крошки -->
        <nav class="services-breadcrumbs">
            <a href="/">Арт-Медика</a>
            <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="{{ route('services.index') }}">Услуги</a>

            @if(!empty($service?->category?->section?->sectionAll))
                <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('services.section', $service->category->section->sectionAll->id) }}">
                    {{ $service->category->section->sectionAll->name }}
                </a>
            @endif

            @if(!empty($service?->category?->section))
                <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('services.category', $service->category->section->id) }}">
                    {{ $service->category->section->name }}
                </a>
            @endif

            @if(!empty($service?->category?->name) && $service->category->name !== $service?->name)
                <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('services.show', $service->category->id) }}">
                    {{ $service->category->name }}
                </a>
            @endif

            @if(!empty($service?->name))
                <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="current">{{ $service->name }}</span>
            @endif
        </nav>

        @if(!$service)
            <div class="services-empty-placeholder" style="margin: 3rem 0; padding: 3rem 1.5rem;">
                <h2 style="font-size: 22px; margin-bottom: 0.5rem; color: #1A1D20;">Услуга пока не найдена</h2>
                <p style="margin: 0; color: #64748B;">В данном разделе пока нет информации об услуге.</p>
            </div>
        @else
            <!-- Шапка услуги -->
            <div class="service-header">
                <h1 class="service-title">
                    {{ $service->name }}
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                    </svg>
                </h1>

                <div class="service-header-desc">
                    @if(!empty($service->description))
                        {!! $service->description !!}
                    @else
                        <p class="service-empty-text">Описание услуги готовится к публикации.</p>
                    @endif
                </div>
            </div>

            <!-- Какие проблемы позволяет решить -->
            <div class="service-problems-section">
                <h2 class="service-section-title">Какие проблемы позволяет решить {{ mb_strtolower($service->name) }}</h2>
                @if($service->problems && $service->problems->isNotEmpty())
                    <div class="service-problems-list">
                        @foreach($service->problems as $idx => $problem)
                            <div class="service-problem-item">
                                <span class="service-problem-num">{{ $idx + 1 }}</span>
                                <span class="service-problem-name">{{ $problem->name }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="service-empty-placeholder">Информация о показаниях и решаемых проблемах пока не добавлена.</p>
                @endif
            </div>

            <!-- Виды услуги -->
            <div class="service-types-section">
                <h2 class="service-blue-title">
                    Виды {{ mb_strtolower($service->name) }}
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                    </svg>
                </h2>

                @if($service->types && $service->types->isNotEmpty())
                    <div class="service-types-grid">
                        @foreach($service->types as $type)
                            <div class="service-type-card">
                                <h3 class="service-type-desc">{{ $type->description }}</h3>
                                <div class="service-type-image-wrap">
                                    @if(!empty($type->image))
                                        <img src="{{ asset('storage/' . $type->image) }}" alt="{{ $type->description }}" class="service-type-image" loading="lazy">
                                    @else
                                        <div class="service-placeholder-box">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="service-empty-placeholder">Информация о разновидностях процедуры готовится к публикации.</p>
                @endif
            </div>

            <!-- Подготовка к операции -->
            <div class="service-split-section">
                <h2 class="service-blue-title">
                    Подготовка к операции
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                    </svg>
                </h2>
                <div class="service-split-text" style="width: 100%;">
                    @if(!empty($service->preparation))
                        {!! nl2br(e($service->preparation)) !!}
                    @else
                        <p class="service-empty-text">Подробные рекомендации по подготовке к операции уточняются.</p>
                    @endif
                </div>
            </div>

            <!-- Почему выбирают специалистов «Арт-Медики» -->
            <div class="service-why-us">
                <h2 class="service-section-title">Почему выбирают специалистов «Арт-Медики»</h2>
                <div class="service-why-grid">
                    <div class="service-why-card">
                        <span class="service-why-num">01</span>
                        <p class="service-why-text">Опыт работы врачей от 10 лет</p>
                    </div>
                    <div class="service-why-card">
                        <span class="service-why-num">02</span>
                        <p class="service-why-text">Современное оборудование</p>
                    </div>
                    <div class="service-why-card">
                        <span class="service-why-num">03</span>
                        <p class="service-why-text">Индивидуальный подход</p>
                    </div>
                    <div class="service-why-card">
                        <span class="service-why-num">04</span>
                        <p class="service-why-text">Комфортные условия стационара</p>
                    </div>
                </div>
            </div>

            <!-- Способ выполнения -->
            <div class="service-split-section">
                <h2 class="service-blue-title">
                    Способ выполнения {{ mb_strtolower($service->name) }}
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                    </svg>
                </h2>
                <div class="service-split-text" style="width: 100%;">
                    @if(!empty($service->method))
                        {!! nl2br(e($service->method)) !!}
                    @else
                        <p class="service-empty-text">Информация о методике и ходе процедуры готовится к публикации.</p>
                    @endif
                </div>
            </div>

            <!-- Результаты процедуры -->
            @php
                $hasResults = $service->results && $service->results->isNotEmpty();
                $resultsCount = $hasResults ? $service->results->count() : 0;
                $hasSlider = $resultsCount > 4;
            @endphp

            <div class="service-results-section" 
                 @if($hasSlider)
                     x-data="{
                         canScrollPrev: false,
                         canScrollNext: true,
                         checkScroll() {
                             const track = this.$refs.resultsTrack;
                             if (!track) return;
                             this.canScrollPrev = track.scrollLeft > 10;
                             this.canScrollNext = track.scrollLeft < track.scrollWidth - track.clientWidth - 10;
                         },
                         scrollPrev() {
                             const track = this.$refs.resultsTrack;
                             track.scrollBy({ left: -track.clientWidth, behavior: 'smooth' });
                         },
                         scrollNext() {
                             const track = this.$refs.resultsTrack;
                             track.scrollBy({ left: track.clientWidth, behavior: 'smooth' });
                         }
                     }" 
                     x-init="$nextTick(() => checkScroll())"
                 @endif
            >
                <h2 class="service-section-title">Результаты процедуры</h2>
                @if($hasResults)
                    <div class="service-results-grid {{ $hasSlider ? 'is-slider' : 'is-grid' }}"
                         @if($hasSlider) x-ref="resultsTrack" @scroll.debounce.50ms="checkScroll()" @endif>
                        @foreach($service->results as $result)
                            <div class="service-result-card">
                                <img src="{{ asset('storage/' . $result->image) }}" alt="Результат процедуры" class="service-result-img" loading="lazy">
                            </div>
                        @endforeach
                    </div>

                    @if($hasSlider)
                        <div class="service-results-pagination">
                            <button type="button" class="pagination-arrow" @click="scrollPrev" :disabled="!canScrollPrev" aria-label="Назад">
                                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <button type="button" class="pagination-arrow" @click="scrollNext" :disabled="!canScrollNext" aria-label="Вперед">
                                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>
                    @endif
                @else
                    <p class="service-empty-placeholder">Фотографии результатов процедуры скоро будут добавлены.</p>
                @endif
            </div>

            <!-- Врачи, проводящие процедуру -->
            <div class="service-specialists-section">
                <h2 class="service-blue-title">
                    Врачи, проводящие процедуру
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                    </svg>
                </h2>

                @if($service->specialists && $service->specialists->isNotEmpty())
                    <div class="specialists-grid" style="margin-top: 2rem;">
                        @foreach($service->specialists as $specialist)
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
                        @endforeach
                    </div>
                @else
                    <p class="service-empty-placeholder">Список принимающих специалистов уточняется.</p>
                @endif
            </div>
        @endif
    </div>
</x-main>
