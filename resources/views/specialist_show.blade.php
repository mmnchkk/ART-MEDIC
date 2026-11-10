@push('vite')
@vite(['resources/css/app.css', 'resources/css/specialist_show.css'])
@endpush

<x-main>
    <x-slot:title>{{ $specialist->full_name }} | Арт-Медика</x-slot:title>

    <div class="spec-page">
        <!-- Хлебные крошки (стиль как в Документах / О клинике) -->
        <nav class="spec-breadcrumbs">
            <a href="/">Арт-Медика</a>
            <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="{{ route('specialists') }}">Специалисты</a>
            <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="current">{{ $specialist->full_name }}</span>
        </nav>

        <!-- Главный верхний блок: 2 колонки в точности по макету -->
        <div class="spec-hero-grid">
            <!-- Левая колонка: Ссылка "Специалисты ↗", Фото, Кнопка записи -->
            <div class="spec-col-left">
                <a href="{{ route('specialists') }}" class="spec-back-title">
                    <span>Специалисты</span>
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                    </svg>
                </a>

                <div class="spec-photo-card">
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

                <a href="#appointment" class="spec-btn-appointment">
                    Записаться на приём
                </a>
            </div>

            <!-- Правая колонка: ФИО врача, Биография, 3 карточки с показателями -->
            <div class="spec-col-right">
                <h1 class="spec-doctor-name">
                    {{ $specialist->full_name }}
                </h1>

                <p class="spec-bio-text">
                    {{ $specialist->description }}
                </p>

                <!-- Метрики (стиль карточек .clinic-des-card) -->
                <div class="spec-stats-grid">
                    <div class="spec-stat-card">
                        <h3>
                            @if($specialist->experience)
                                с {{ date('Y') - $specialist->experience }} года
                            @else
                                с 2002 года
                            @endif
                        </h3>
                        <p>стаж</p>
                    </div>

                    <div class="spec-stat-card">
                        <h3>{{ $specialist->count_operations ?? 34 }}</h3>
                        <p>операций за время работы в нашей клинике</p>
                    </div>

                    <div class="spec-stat-card">
                        <h3>{{ $specialist->percentage_reviews ?? 90 }}%</h3>
                        <p>положительных отзывов</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Направление деятельности (стиль плашки .clinic-departments со стрелками) -->
        @if($specialist->directions && $specialist->directions->count() > 0)
            <div class="spec-directions-box">
                <h3 class="spec-directions-title">Направление деятельности:</h3>
                <ul class="spec-directions-list">
                    @foreach($specialist->directions as $dir)
                        <li class="spec-direction-item">
                            <svg class="spec-direction-arrow" width="13" height="13" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 13L13 1M13 1H4M13 1V10" stroke="#37241B" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>{{ $dir->name }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Аккордеоны с таблицами: ТОТ ЖЕ КОМПОНЕНТ, ЧТО В ДОКУМЕНТАХ -->
        <div x-data="{ active: [0, 1] }" class="doc-accordion-container">
            <!-- 1. Данные об образовании -->
            <div class="doc-section">
                <button type="button" @click="active.includes(0) ? active = active.filter(i => i !== 0) : active.push(0)" class="doc-section-btn">
                    <span class="doc-section-title">Данные об образовании из Федерального реестра медицинских работников</span>
                    <svg :class="{'rotate': active.includes(0)}" class="doc-section-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </button>

                <div x-show="active.includes(0)" x-collapse>
                    <div class="doc-content">
                        @if($specialist->educations && $specialist->educations->count() > 0)
                            <div class="spec-table-wrap">
                                <table class="spec-table-clean">
                                    <thead>
                                        <tr>
                                            <th style="width: 20%;">Уровень образования</th>
                                            <th style="width: 44%;">Образовательная организация</th>
                                            <th style="width: 13%;">Год выдачи</th>
                                            <th style="width: 23%;">Квалификация, специальность</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($specialist->educations as $edu)
                                            <tr>
                                                <td>{{ $edu->level }}</td>
                                                <td>{{ $edu->organisation }}</td>
                                                <td>{{ $edu->year_issue }}</td>
                                                <td>{{ $edu->qualification }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="doc-empty">Данные об образовании вносятся в реестр.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- 2. Аккредитация (сертификация) -->
            <div class="doc-section">
                <button type="button" @click="active.includes(1) ? active = active.filter(i => i !== 1) : active.push(1)" class="doc-section-btn">
                    <span class="doc-section-title">Аккредитация (сертификация) специалиста</span>
                    <svg :class="{'rotate': active.includes(1)}" class="doc-section-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </button>

                <div x-show="active.includes(1)" x-collapse>
                    <div class="doc-content">
                        @if($specialist->accreditations && $specialist->accreditations->count() > 0)
                            <div class="spec-table-wrap">
                                <table class="spec-table-clean">
                                    <thead>
                                        <tr>
                                            <th style="width: 14%;">Тип документа</th>
                                            <th style="width: 20%;">Специальность</th>
                                            <th style="width: 25%;">Должность</th>
                                            <th style="width: 13%;">Дата выдачи</th>
                                            <th style="width: 13%;">Срок действия</th>
                                            <th style="width: 15%;">Примечание</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($specialist->accreditations as $acc)
                                            <tr>
                                                <td>{{ $acc->type_doc }}</td>
                                                <td>{{ $acc->speciality }}</td>
                                                <td>{{ $acc->position }}</td>
                                                <td>{{ \Carbon\Carbon::parse($acc->date_issue)->format('d.m.Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($acc->validity_period)->format('d.m.Y') }}</td>
                                                <td>{{ $acc->note ?? 'Пролонгировано по приказу до 31.12.2026' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="doc-empty">Данные об аккредитации обновляются.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @php
            // Получаем услуги специалиста или общие услуги с результатами
            $servicesFilter = \App\Models\Service::whereHas('results')->get();
            $resultsList = \App\Models\ServiceResult::with('service')->latest()->get();
        @endphp

        <!-- Раздел: Результат операций (динамический из ServiceResult) -->
        @if($resultsList->count() > 0)
            <div class="clinic-title">
                <div class="clinic-title-nav">
                    <h1>Результат операций</h1>
                    <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 17L17 7M17 7H9M17 7V15"></path>
                    </svg>
                </div>

                <p class="clinic-title-description">
                    Мы гордимся результатами, которых достигаем вместе с нашими пациентами благодаря современным методикам и золотым рукам хирургов. Убедитесь сами, как тонко и естественно мы умеем работать с красотой.
                </p>
            </div>

            <div class="clinic-results" id="specResultsSection">
                <div class="clinic-filters">
                    <button type="button" class="clinic-filter active" data-filter="all">Все</button>
                    @foreach($servicesFilter as $srv)
                        <button type="button" class="clinic-filter" data-filter="service-{{ $srv->id }}">{{ $srv->name }}</button>
                    @endforeach
                </div>

                <!-- Галерея с размытием (filter: blur) и эффектом при наведении -->
                <div class="clinic-gallery" id="specGallery">
                    @foreach($resultsList as $res)
                        <div class="clinic-gallery-item" data-service="service-{{ $res->service_id }}">
                            <img src="{{ asset('storage/' . $res->image) }}" alt="{{ $res->service?->name ?? 'Результат операции' }}">
                        </div>
                    @endforeach
                </div>

                <!-- Стрелки пагинации галереи (по краям слева и справа) -->
                <div class="clinic-pagination">
                    <button type="button" class="pagination-arrow" id="specPrevBtn" aria-label="Назад">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button type="button" class="pagination-arrow" id="specNextBtn" aria-label="Вперед">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const filterButtons = document.querySelectorAll('#specResultsSection .clinic-filter');
                    const galleryItems = Array.from(document.querySelectorAll('#specGallery .clinic-gallery-item'));
                    const prevBtn = document.getElementById('specPrevBtn');
                    const nextBtn = document.getElementById('specNextBtn');
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
