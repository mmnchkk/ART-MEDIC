@push('vite')
@vite(['resources/css/app.css', 'resources/css/clinic.css'])
@endpush

<x-main>
    <x-slot:title>
        О клинике | Арт-Медика
    </x-slot:title>

    <div class="clinic">
        <!-- Хлебные крошки -->
        <nav class="clinic-breadcrumbs">
            <a href="/">Арт-Медика</a>
            <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="current">О клинике</span>
        </nav>

        <!-- Шапка раздела -->
        <div class="clinic-header">
            <h1 class="clinic-title">
                О клинике
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                </svg>
            </h1>

            <div class="clinic-intro">
                Превращаем заветные мечты пациентов в реальность, невзирая на сложность задачи
            </div>
        </div>

        <!-- О нас: Картинка и описание с карточками -->
        <div class="clinic-about">
            <div class="clinic-about-image">
                @if(!empty($clinic?->image))
                    <img src="{{ asset('storage/' . $clinic->image) }}" alt="Клиника Арт-Медика">
                @endif
            </div>
            <div class="clinic-about-info">
                <div class="clinic-about-text">
                    @if(!empty($clinic?->description))
                        {!! $clinic->description !!}
                    @endif
                </div>
                <div class="clinic-des-cards">
                    <div class="clinic-des-card">
                        <h3>{{ $clinic?->count_study ?? 0 }}+</h3>
                        <p>обучений в год проходят специалисты центра</p>
                    </div>
                    <div class="clinic-des-card">
                        <h3>{{ $clinic?->count_projects ?? 0 }}</h3>
                        <p>проектов уже было реализовано в нашей клинике</p>
                    </div>
                    <div class="clinic-des-card">
                        <h3>{{ $clinic?->count_reviews ?? 0 }}%</h3>
                        <p>положительных отзывов</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Отделения клиники из БД -->
        @if(!empty($clinic?->departments) && $clinic->departments->count() > 0)
            <div class="clinic-departments">
                @foreach($clinic->departments as $dept)
                    <div class="clinic-department-item">
                        <div class="clinic-department-title">
                            <h3>{{ $dept->name }}</h3>
                            @if(!empty($dept->description))
                                <div class="clinic-department-desc">{!! $dept->description !!}</div>
                            @endif
                        </div>

                        @if(!empty($dept->directions) && $dept->directions->count() > 0)
                            <ul class="clinic-policlinic-list">
                                @foreach($dept->directions as $direction)
                                    <li>
                                        <svg class="clinic-direction-arrow" width="13" height="13" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 13L13 1M13 1H4M13 1V10" stroke="#37241B" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span>{{ $direction->name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach

                <!-- Общий подвал блока отделений: кнопка и ссылки один раз -->
                <div class="clinic-departments-bottom">
                    <a href="/specialists" class="clinic-button">Подробнее</a>
                    <div class="clinic-links">
                        <a href="https://minzdrav.gov.ru" target="_blank" rel="noopener">Сайт Министерства здравоохранения Российской Федерации</a>
                        <a href="http://pravo.gov.ru" target="_blank" rel="noopener">Официальный интернет-портал правовой информации</a>
                    </div>
                </div>
            </div>
        @endif

        @php
            $servicesFilter = \App\Models\Service::whereHas('results')->get();
            $resultsList = \App\Models\ServiceResult::with('service')->latest()->get();
        @endphp

        <!-- Результат операций: отображается только если есть результаты -->
        @if($resultsList->count() > 0)
            <div class="clinic-header clinic-results-header">
                <h1 class="clinic-title">
                    Результат операций
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                    </svg>
                </h1>

                <div class="clinic-intro">
                    Мы гордимся результатами, которых достигаем вместе с нашими пациентами благодаря современным методикам и золотым рукам хирургов. Убедитесь сами, как тонко и естественно мы умеем работать с красотой.
                </div>
            </div>

            <div class="clinic-results" id="clinicResultsSection">
                <div class="clinic-filters">
                    <button type="button" class="clinic-filter active" data-filter="all">Все</button>
                    @foreach($servicesFilter as $srv)
                        <button type="button" class="clinic-filter" data-filter="service-{{ $srv->id }}">{{ $srv->name }}</button>
                    @endforeach
                </div>

                <div class="clinic-gallery" id="clinicGallery">
                    @foreach($resultsList as $res)
                        <div class="clinic-gallery-item" data-service="service-{{ $res->service_id }}">
                            <img src="{{ asset('storage/' . $res->image) }}" alt="{{ $res->service?->name ?? 'Результат операции' }}">
                        </div>
                    @endforeach
                </div>

                <div class="clinic-pagination">
                    <button type="button" class="pagination-arrow" id="clinicPrevBtn" aria-label="Назад">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button type="button" class="pagination-arrow" id="clinicNextBtn" aria-label="Вперед">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const filterButtons = document.querySelectorAll('.clinic-filter');
                    const galleryItems = Array.from(document.querySelectorAll('.clinic-gallery-item'));
                    const prevBtn = document.getElementById('clinicPrevBtn');
                    const nextBtn = document.getElementById('clinicNextBtn');
                    const ITEMS_PER_PAGE = 3;

                    let currentFilter = 'all';
                    let currentPage = 1;

                    function getFilteredItems() {
                        if (currentFilter === 'all') {
                            return galleryItems;
                        }
                        return galleryItems.filter(item => item.getAttribute('data-service') === currentFilter);
                    }

                    function renderGallery() {
                        const filtered = getFilteredItems();
                        const totalPages = Math.max(1, Math.ceil(filtered.length / ITEMS_PER_PAGE));

                        if (currentPage > totalPages) {
                            currentPage = 1;
                        }

                        const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
                        const endIndex = startIndex + ITEMS_PER_PAGE;

                        galleryItems.forEach(item => {
                            item.style.display = 'none';
                        });

                        filtered.forEach((item, index) => {
                            if (index >= startIndex && index < endIndex) {
                                item.style.display = 'block';
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

                    filterButtons.forEach(btn => {
                        btn.addEventListener('click', function () {
                            filterButtons.forEach(b => b.classList.remove('active'));
                            this.classList.add('active');

                            currentFilter = this.getAttribute('data-filter');
                            currentPage = 1;
                            renderGallery();
                        });
                    });

                    if (prevBtn) {
                        prevBtn.addEventListener('click', function () {
                            if (currentPage > 1) {
                                currentPage--;
                                renderGallery();
                            }
                        });
                    }

                    if (nextBtn) {
                        nextBtn.addEventListener('click', function () {
                            const filtered = getFilteredItems();
                            const totalPages = Math.ceil(filtered.length / ITEMS_PER_PAGE);
                            if (currentPage < totalPages) {
                                currentPage++;
                                renderGallery();
                            }
                        });
                    }

                    renderGallery();
                });
            </script>
        @endif
    </div>
</x-main>
