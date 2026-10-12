@push('vite')
    @vite('resources/css/app.css')
    @vite('resources/css/projects.css')
@endpush

<x-main>
    <x-slot:title>
        Проекты
    </x-slot:title>

    <div class="projects-page">
        <!-- Хлебные крошки -->
        <nav class="projects-breadcrumbs">
            <a href="/">Арт-Медика</a>
            <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
            <span class="current">Проекты</span>
        </nav>

        <!-- Заголовок страницы -->
        <div class="projects-header">
            <h1 class="projects-title">
                Проекты
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path></svg>
            </h1>
            <div class="projects-intro">
                Подбираем для вас самые актуальные и интересные проекты из нашей практики, медицины и эстетической хирургии, с заботой о вас
            </div>
        </div>

        <!-- Список проектов -->
        <div class="projects-list">
            @forelse ($projects as $project)
                @php
                    $coverImg = $project->images->first()?->image;
                @endphp
                <div class="project-card">
                    <div class="project-card-image-col">
                        <a href="{{ route('projects.show', $project->id) }}">
                            <img 
                                src="{{ $coverImg ? asset('storage/' . $coverImg) : '/img/logo.svg' }}" 
                                alt="{{ $project->name }}" 
                                onerror="this.onerror=null; this.src='/img/logo.svg'; this.style.objectFit='contain'; this.style.padding='40px';"
                            >
                        </a>
                    </div>
                    <div class="project-card-content-col">
                        <div class="project-card-content-top">
                            <div class="project-card-meta-top">
                                <span class="project-card-tag">Проекты</span>
                                <a href="{{ route('projects.show', $project->id) }}" class="project-card-arrow-icon" aria-label="Перейти к проекту">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path></svg>
                                </a>
                            </div>
                            <h2 class="project-card-title">
                                <a href="{{ route('projects.show', $project->id) }}" style="color: inherit; text-decoration: none;">
                                    {{ $project->name }}
                                </a>
                            </h2>
                            <div class="project-card-desc">
                                {{ $project->short_desc }}
                            </div>
                            <div class="project-card-btn-wrap">
                                <a href="{{ route('projects.show', $project->id) }}" class="project-card-btn">
                                    Подробнее
                                </a>
                            </div>
                        </div>
                        <div class="project-card-date">
                            {{ $project->date ? \Carbon\Carbon::parse($project->date)->format('d.m.Y') : '' }}
                        </div>
                    </div>
                </div>
            @empty
                <p style="color: #6b7280; font-size: 16px;">Список проектов пока пуст.</p>
            @endforelse
        </div>

        <!-- Пагинация -->
        @if ($projects->hasPages())
        <div class="projects-pagination">
            @if ($projects->onFirstPage())
                <span class="projects-page-btn projects-page-arrow disabled">
                    <svg width="24" height="24" fill="none" stroke="#ffffff" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </span>
            @else
                <a href="{{ $projects->previousPageUrl() }}" class="projects-page-btn projects-page-arrow">
                    <svg width="24" height="24" fill="none" stroke="#ffffff" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </a>
            @endif

            <div class="projects-page-numbers">
                @foreach ($projects->links()->elements as $element)
                    @if (is_string($element))
                        <span class="projects-page-btn projects-page-dots">{{ $element }}</span>
                    @endif
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $projects->currentPage())
                                <span class="projects-page-btn projects-page-num active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="projects-page-btn projects-page-num">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            @if ($projects->hasMorePages())
                <a href="{{ $projects->nextPageUrl() }}" class="projects-page-btn projects-page-arrow">
                    <svg width="24" height="24" fill="none" stroke="#ffffff" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
            @else
                <span class="projects-page-btn projects-page-arrow disabled">
                    <svg width="24" height="24" fill="none" stroke="#ffffff" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            @endif
        </div>
        @endif
    </div>
</x-main>
