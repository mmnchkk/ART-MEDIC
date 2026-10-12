@push('vite')
    @vite('resources/css/app.css')
    @vite('resources/css/projects.css')
@endpush

<x-main>
    <x-slot:title>
        {{ $project->name }}
    </x-slot:title>

    <div class="projects-page">
        <!-- Хлебные крошки -->
        <nav class="projects-breadcrumbs">
            <a href="/">Арт-Медика</a>
            <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
            <a href="{{ route('projects') }}">Проекты</a>
            <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
            <span class="current">{{ $project->name }}</span>
        </nav>

        <!-- Заголовок страницы проекта -->
        <div class="project-detail-header">
            <h1 class="project-detail-title">{{ $project->name }}</h1>
            @if($project->short_desc)
                <div class="project-detail-subtitle">{{ $project->short_desc }}</div>
            @endif
        </div>

        <!-- Главное панорамное фото (баннер проекта) -->
        @php
            $heroPhoto = $project->images->first()?->image;
        @endphp
        <div class="project-hero-wrapper">
            <img 
                src="{{ $heroPhoto ? asset('storage/' . $heroPhoto) : '/img/logo.svg' }}" 
                alt="{{ $project->name }}" 
                onerror="this.onerror=null; this.src='/img/logo.svg'; this.style.objectFit='contain'; this.style.padding='60px';"
            >
        </div>

        <!-- Описание проекта -->
        @if($project->description)
        <div class="project-desc-layout">
            <h2 class="project-section-heading">Описание проекта</h2>
            <div class="project-desc-columns">
                @php
                    $paragraphs = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $project->description))));
                    if (count($paragraphs) === 0 && !empty($project->description)) {
                        $paragraphs = [$project->description];
                    }
                    $half = ceil(count($paragraphs) / 2);
                    $col1 = array_slice($paragraphs, 0, $half);
                    $col2 = array_slice($paragraphs, $half);
                @endphp
                <div class="project-desc-col">
                    @foreach($col1 as $p)
                        <p>{{ $p }}</p>
                    @endforeach
                </div>
                @if(count($col2) > 0)
                <div class="project-desc-col">
                    @foreach($col2 as $p)
                        <p>{{ $p }}</p>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Метрики и показатели -->
        <div class="project-stats-grid">
            <div class="project-stat-card">
                <div class="project-stat-number">{{ $project->count_season }}</div>
                <div class="project-stat-label">сезонов проекта</div>
            </div>
            <div class="project-stat-card">
                <div class="project-stat-number">{{ $project->count_members }}</div>
                <div class="project-stat-label">участников</div>
            </div>
            <div class="project-stat-card">
                <div class="project-stat-number">{{ $project->count_expert }}</div>
                <div class="project-stat-label">экспертов</div>
            </div>
            <div class="project-stat-card">
                <div class="project-stat-number">{{ $project->count_parterns }}</div>
                <div class="project-stat-label">партнеров</div>
            </div>
        </div>

        <!-- Форматы работы -->
        @if($project->formatWorks && $project->formatWorks->count() > 0)
        <div class="project-formats-section {{ $project->formatWorks->count() <= 1 ? 'is-single' : '' }}">
            <x-slider title="Форматы работы" class="project-formats-slider">
                @foreach($project->formatWorks as $format)
                    <div class="project-format-card">
                        <img 
                            src="{{ asset('storage/' . $format->image) }}" 
                            alt="{{ $format->name }}"
                            onerror="this.onerror=null; this.src='/img/logo.svg'; this.style.objectFit='contain'; this.style.padding='40px';"
                        >
                        <div class="project-format-overlay"></div>
                        <div class="project-format-info">
                            <h3 class="project-format-name">{{ $format->name }}</h3>
                            <p class="project-format-text">{{ $format->description }}</p>
                        </div>
                    </div>
                @endforeach
            </x-slider>
        </div>
        @endif

        <!-- Этапы проекта -->
        @if($project->projectStages && $project->projectStages->count() > 0)
        <div class="project-stages-layout">
            <h2 class="project-section-heading">Этапы проекта</h2>
            <div class="project-stages-list">
                @foreach($project->projectStages as $index => $stage)
                    <div class="project-stage-row">
                        <div class="project-stage-idx">{{ $index + 1 }}</div>
                        <div class="project-stage-title">{{ $stage->name }}</div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Фотографии -->
        @if($project->images && $project->images->count() > 0)
        <div class="project-gallery-section {{ $project->images->count() <= 1 ? 'is-single' : '' }}">
            <div class="project-gallery-header">
                <h2 class="project-section-heading">Фотографии</h2>
            </div>
            <x-slider :show-nav="false" class="project-gallery-slider">
                @foreach($project->images as $img)
                    <div class="project-gallery-slide">
                        <img 
                            src="{{ asset('storage/' . $img->image) }}" 
                            alt="Фотография проекта {{ $project->name }}" 
                            onerror="this.onerror=null; this.src='/img/logo.svg'; this.style.objectFit='contain'; this.style.padding='40px';"
                        >
                    </div>
                @endforeach
            </x-slider>
        </div>
        @endif

        <!-- Партнеры -->
        @if($project->partners && $project->partners->count() > 0)
        <div class="project-partners-section">
            <div class="project-partners-header">
                <h2 class="project-section-heading">Партнеры</h2>
            </div>
            <div class="project-partners-table">
                @foreach($project->partners as $partner)
                    <div class="project-partner-item">
                        <div class="project-partner-name">{{ $partner->name }}</div>
                        <div class="project-partner-badge">{{ $partner->description }}</div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</x-main>
