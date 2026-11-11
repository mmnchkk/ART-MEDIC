@props([
    'specialities' => null,
    'specialists' => null,
])

@php
    if (!isset($specialities)) {
        try {
            $specialities = \App\Models\Speciality::whereHas('specialists')->get();
        } catch (\Throwable $e) {
            $specialities = collect();
        }
    }

    if (!isset($specialists)) {
        try {
            $specialists = \App\Models\Specialist::with('specialities')->get();
        } catch (\Throwable $e) {
            $specialists = collect();
        }
    }
@endphp

@if($specialists->count() > 0)
    <section class="home-specialists-section" id="homeSpecialistsSection">
        <div class="home-specialists-container">
            <!-- Шапка: Наши специалисты -->
            <div class="home-specialists-header">
                <a href="{{ route('specialists') }}" class="home-specialists-title">
                    <span>Наши специалисты</span>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                    </svg>
                </a>

                <div class="home-specialists-intro">
                    Наши специалисты — это команда профессионалов с многолетним опытом в пластической хирургии и косметологии. Они постоянно повышают своё мастерство, чтобы дарить вам гармонию, уверенность в себе и в своём теле.
                </div>
            </div>

            <!-- Фильтры категорий врачей -->
            <div class="home-specialists-filters" id="homeSpecialistsFilters">
                <button type="button" class="home-specialists-filter active" data-filter="all">Все</button>
                @foreach($specialities as $spec)
                    <button type="button" class="home-specialists-filter" data-filter="{{ $spec->name }}">{{ $spec->name }}</button>
                @endforeach
            </div>

            <!-- Сетка карточек врачей: 4 на десктопе, 2 на планшете, 1 на мобильном -->
            <div class="home-specialists-gallery" id="homeSpecialistsGallery">
                @foreach($specialists as $s)
                    @php
                        $specNames = $s->specialities->pluck('name')->all();
                        $cardImg = $s->image 
                            ? (str_starts_with($s->image, 'http') || str_starts_with($s->image, '/') ? $s->image : asset('storage/' . $s->image))
                            : '/img/specialist-1.svg';
                    @endphp
                    <a href="{{ route('specialists.show', $s->id) }}" 
                       class="home-specialist-card" 
                       data-specs="{{ json_encode($specNames) }}">
                        <img src="{{ $cardImg }}" alt="{{ $s->full_name }}" class="home-specialist-img" loading="lazy" onerror="this.src='/img/specialist-1.svg'">
                        <div class="home-specialist-overlay"></div>
                        <div class="home-specialist-info">
                            <h3 class="home-specialist-name">{{ $s->full_name }}</h3>
                            @if(!empty($s->description))
                                <p class="home-specialist-desc">{{ $s->description }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Стрелки пагинации (слева Назад, справа Вперед) -->
            <div class="home-specialists-pagination" id="homeSpecialistsPagination">
                <button type="button" class="home-specialists-nav-btn" id="homeSpecialistsPrevBtn" aria-label="Назад">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5M12 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button type="button" class="home-specialists-nav-btn" id="homeSpecialistsNextBtn" aria-label="Вперед">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7 7l7-7-7-7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <script>
        (function () {
            function initHomeSpecialists() {
                const gallery = document.getElementById('homeSpecialistsGallery');
                if (!gallery) return;

                const cards = Array.from(gallery.querySelectorAll('.home-specialist-card'));
                const filterBtns = Array.from(document.querySelectorAll('#homeSpecialistsFilters .home-specialists-filter'));
                const prevBtn = document.getElementById('homeSpecialistsPrevBtn');
                const nextBtn = document.getElementById('homeSpecialistsNextBtn');
                const paginationWrap = document.getElementById('homeSpecialistsPagination');

                if (!cards.length) return;

                let currentFilter = 'all';
                let currentPage = 1;

                function getItemsPerPage() {
                    const w = window.innerWidth;
                    if (w < 640) return 1;
                    if (w < 1024) return 2;
                    return 4;
                }

                function getFilteredCards() {
                    if (currentFilter === 'all') {
                        return cards;
                    }
                    return cards.filter(card => {
                        try {
                            const specs = JSON.parse(card.getAttribute('data-specs') || '[]');
                            return specs.includes(currentFilter);
                        } catch (e) {
                            return false;
                        }
                    });
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
                            card.style.display = 'flex';
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
                document.addEventListener('DOMContentLoaded', initHomeSpecialists);
            } else {
                initHomeSpecialists();
            }
        })();
    </script>
@endif
