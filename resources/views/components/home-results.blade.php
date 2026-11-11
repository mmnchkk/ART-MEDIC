@props([
    'servicesFilter' => null,
    'resultsList' => null,
])

@php
    if (!isset($servicesFilter)) {
        try {
            $servicesFilter = \App\Models\Service::whereHas('results')->get();
        } catch (\Throwable $e) {
            $servicesFilter = collect();
        }
    }

    if (!isset($resultsList)) {
        try {
            $resultsList = \App\Models\ServiceResult::with('service')->latest()->get();
        } catch (\Throwable $e) {
            $resultsList = collect();
        }
    }
@endphp

@if($resultsList->count() > 0)
    <section class="home-results-section" id="homeResultsSection">
        <div class="home-results-container">
            <!-- Шапка блока: Результат операций -->
            <div class="home-results-header">
                <a href="{{ route('services.index') }}" class="home-results-title">
                    <span>Результат операций</span>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                    </svg>
                </a>

                <div class="home-results-intro">
                    Мы гордимся результатами, которых достигаем вместе с нашими пациентами благодаря современным методикам и золотым рукам хирургов. Убедитесь сами, как тонко и естественно мы умеем работать с красотой.
                </div>
            </div>

            <!-- Фильтры -->
            <div class="home-results-filters" id="homeResultsFilters">
                <button type="button" class="home-results-filter active" data-filter="all">Все</button>
                @foreach($servicesFilter as $srv)
                    <button type="button" class="home-results-filter" data-filter="service-{{ $srv->id }}">{{ $srv->name }}</button>
                @endforeach
            </div>

            <!-- Сетка карточек До / После (нативный HTML без Alpine for для максимальной стабильности сетки) -->
            <div class="home-results-gallery" id="homeResultsGallery">
                @foreach($resultsList as $result)
                    <div class="home-results-card" data-service="service-{{ $result->service_id }}">
                        <img 
                            src="{{ asset('storage/' . $result->image) }}" 
                            alt="{{ $result->service?->name ?? 'Результат операции' }}" 
                            loading="lazy"
                            onerror="this.src='/img/review.png'"
                        >
                    </div>
                @endforeach
            </div>

            <!-- Стрелки пагинации внизу: слева Назад, справа Вперед -->
            <div class="home-results-pagination" id="homeResultsPagination">
                <button type="button" class="home-results-nav-btn" id="homeResultsPrevBtn" aria-label="Назад">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5M12 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button type="button" class="home-results-nav-btn" id="homeResultsNextBtn" aria-label="Вперед">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7 7l7-7-7-7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <script>
        (function () {
            function initHomeResults() {
                const gallery = document.getElementById('homeResultsGallery');
                if (!gallery) return;

                const cards = Array.from(gallery.querySelectorAll('.home-results-card'));
                const filterBtns = Array.from(document.querySelectorAll('#homeResultsFilters .home-results-filter'));
                const prevBtn = document.getElementById('homeResultsPrevBtn');
                const nextBtn = document.getElementById('homeResultsNextBtn');
                const paginationWrap = document.getElementById('homeResultsPagination');

                if (!cards.length) return;

                let currentFilter = 'all';
                let currentPage = 1;

                function getItemsPerPage() {
                    const w = window.innerWidth;
                    if (w < 640) return 1;
                    if (w < 1024) return 2;
                    return 3;
                }

                function getFilteredCards() {
                    if (currentFilter === 'all') {
                        return cards;
                    }
                    return cards.filter(card => card.getAttribute('data-service') === currentFilter);
                }

                function render() {
                    const filtered = getFilteredCards();
                    const itemsPerPage = getItemsPerPage();
                    const totalPages = Math.max(1, Math.ceil(filtered.length / itemsPerPage));

                    if (currentPage > totalPages) {
                        currentPage = 1;
                    }

                    if (paginationWrap) {
                        paginationWrap.style.display = totalPages > 1 ? 'flex' : 'none';
                    }

                    const startIndex = (currentPage - 1) * itemsPerPage;
                    const endIndex = startIndex + itemsPerPage;

                    cards.forEach(card => {
                        card.style.display = 'none';
                    });

                    filtered.forEach((card, index) => {
                        if (index >= startIndex && index < endIndex) {
                            card.style.display = 'block';
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

                filterBtns.forEach(btn => {
                    btn.addEventListener('click', function () {
                        filterBtns.forEach(b => b.classList.remove('active'));
                        this.classList.add('active');
                        currentFilter = this.getAttribute('data-filter') || 'all';
                        currentPage = 1;
                        render();
                    });
                });

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
                        const filtered = getFilteredCards();
                        const itemsPerPage = getItemsPerPage();
                        const totalPages = Math.max(1, Math.ceil(filtered.length / itemsPerPage));
                        if (currentPage < totalPages) {
                            currentPage++;
                            render();
                        }
                    };
                }

                let resizeTimeout;
                window.addEventListener('resize', function () {
                    clearTimeout(resizeTimeout);
                    resizeTimeout = setTimeout(render, 150);
                });

                render();
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initHomeResults);
            } else {
                initHomeResults();
            }
        })();
    </script>
@endif
