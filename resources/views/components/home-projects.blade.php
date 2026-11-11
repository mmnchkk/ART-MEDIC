@props([
    'projects' => null,
])

@php
    if (!isset($projects)) {
        try {
            $projects = \App\Models\Project::with('images')->latest('date')->get();
        } catch (\Throwable $e) {
            $projects = collect();
        }
    }
@endphp

@if($projects && $projects->count() > 0)
    <section class="home-projects-section" id="homeProjectsSection">
        <div class="home-projects-container">
            <!-- Шапка: Проекты -->
            <div class="home-projects-header">
                <a href="{{ route('projects') }}" class="home-projects-title">
                    <span>Проекты</span>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                    </svg>
                </a>

                <div class="home-projects-intro">
                    Подбираем для вас самые актуальные и интересные проекты из нашей практики, медицины и эстетической хирургии, с заботой о вас.
                </div>
            </div>

            <!-- Галерея карточек проектов только из БД -->
            <div class="home-projects-gallery" id="homeProjectsGallery">
                @foreach($projects as $p)
                    @php
                        $coverImg = $p->images->first()?->image;
                    @endphp
                    <a href="{{ route('projects.show', $p->id) }}" class="home-project-card">
                        <div class="home-project-card-top">
                            <span class="home-project-tag">Проекты</span>
                            <svg class="home-project-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </div>

                        <div class="home-project-image-wrap">
                            @if($coverImg)
                                <img src="{{ asset('storage/' . $coverImg) }}" alt="{{ $p->name }}" loading="lazy" onerror="this.onerror=null; this.src='/img/logo.svg'; this.style.objectFit='contain';">
                            @else
                                <img src="/img/logo.svg" alt="{{ $p->name }}" style="object-fit: contain; padding: 20px;">
                            @endif
                        </div>

                        <div class="home-project-card-bottom">
                            <h3 class="home-project-card-title">{{ $p->name }}</h3>
                            <span class="home-project-card-date">{{ $p->date ? \Carbon\Carbon::parse($p->date)->format('d.m.Y') : '' }}</span>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Пагинация снизу (слева Назад, справа Вперед) -->
            <div class="home-projects-pagination" id="homeProjectsPagination">
                <button type="button" class="pagination-arrow" id="homeProjectsPrevBtn" aria-label="Назад">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5M12 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button type="button" class="pagination-arrow" id="homeProjectsNextBtn" aria-label="Вперед">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7 7l7-7-7-7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <script>
        (function () {
            function initHomeProjects() {
                const gallery = document.getElementById('homeProjectsGallery');
                if (!gallery) return;

                const cards = Array.from(gallery.querySelectorAll('.home-project-card'));
                const prevBtn = document.getElementById('homeProjectsPrevBtn');
                const nextBtn = document.getElementById('homeProjectsNextBtn');
                const paginationWrap = document.getElementById('homeProjectsPagination');
                if (!cards.length) return;

                let currentPage = 1;

                function getItemsPerPage() {
                    const w = window.innerWidth;
                    if (w < 640) return 1;
                    if (w < 1024) return 2;
                    return 4;
                }

                function render() {
                    const itemsPerPage = getItemsPerPage();
                    const totalPages = Math.max(1, Math.ceil(cards.length / itemsPerPage));
                    
                    if (paginationWrap) {
                        paginationWrap.style.display = totalPages > 1 ? 'flex' : 'none';
                    }

                    if (currentPage > totalPages) {
                        currentPage = 1;
                    }

                    const startIndex = (currentPage - 1) * itemsPerPage;
                    const endIndex = startIndex + itemsPerPage;

                    cards.forEach((card, index) => {
                        if (index >= startIndex && index < endIndex) {
                            card.style.display = 'flex';
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    if (prevBtn) {
                        prevBtn.disabled = currentPage <= 1;
                        prevBtn.style.opacity = currentPage <= 1 ? '0.35' : '1';
                        prevBtn.style.cursor = currentPage <= 1 ? 'not-allowed' : 'pointer';
                    }

                    if (nextBtn) {
                        nextBtn.disabled = currentPage >= totalPages;
                        nextBtn.style.opacity = currentPage >= totalPages ? '0.35' : '1';
                        nextBtn.style.cursor = currentPage >= totalPages ? 'not-allowed' : 'pointer';
                    }
                }

                if (prevBtn) {
                    prevBtn.onclick = function () {
                        if (currentPage > 1) {
                            currentPage--;
                            render();
                        }
                    };
                }

                if (nextBtn) {
                    nextBtn.onclick = function () {
                        const totalPages = Math.ceil(cards.length / getItemsPerPage());
                        if (currentPage < totalPages) {
                            currentPage++;
                            render();
                        }
                    };
                }

                window.addEventListener('resize', render);
                render();
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initHomeProjects);
            } else {
                initHomeProjects();
            }
        })();
    </script>
@endif
