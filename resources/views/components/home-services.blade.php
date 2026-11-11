@props(['sectionsAll' => null])

@php
    if (!isset($sectionsAll)) {
        try {
            $sectionsAll = \App\Models\ServiceCategorySectionAll::with(['sections.categories'])->get();
        } catch (\Throwable $e) {
            $sectionsAll = collect();
        }
    }
    // По умолчанию раскрыты первые два блока, как на макете
    $initialOpenIds = $sectionsAll->take(2)->pluck('id')->values()->all();
@endphp

<section class="home-services-section">
    <div class="home-services-container">
        <!-- Шапка блока: 1 к 1 как в каталоге услуг (servicescategorysectionsall) -->
        <div class="home-services-header">
            <a href="{{ route('services.index') }}" class="home-services-title">
                <span>Услуги</span>
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                </svg>
            </a>

            <p class="home-services-intro">
                В клинике «Арт-медика» мы объединили многолетний опыт врачей и современные технологии, чтобы предложить вам максимально широкий спектр медицинских и эстетических услуг.
            </p>
        </div>

        <!-- Список аккордеонов по service_category_section_all -->
        <div class="home-services-accordions" x-data="{
            openIds: {{ json_encode($initialOpenIds) }},
            toggle(id) {
                if (this.openIds.includes(id)) {
                    this.openIds = this.openIds.filter(i => i !== id);
                } else {
                    this.openIds.push(id);
                }
            },
            isOpen(id) {
                return this.openIds.includes(id);
            }
        }">
            @forelse($sectionsAll as $allSec)
                <div class="home-services-accordion-item">
                    <!-- Заголовок / кнопка аккордеона (отдельная плашка) -->
                    <button type="button" class="home-services-accordion-btn" @click="toggle({{ $allSec->id }})">
                        <span class="home-services-accordion-title">{{ $allSec->name }}</span>
                        <svg :class="{'rotate': isOpen({{ $allSec->id }})}" class="home-services-accordion-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </button>

                    <!-- Выпадающий список карточек (вне серой плашки кнопки) -->
                    <div x-show="isOpen({{ $allSec->id }})" x-collapse class="home-services-collapse-wrap">
                        <div class="home-services-cards-grid">
                            @forelse($allSec->sections as $sec)
                                <div class="home-service-card">
                                    <div class="home-service-card-content">
                                        <a href="{{ route('services.category', $sec->id) }}" class="home-service-card-title">
                                            {{ $sec->name }}
                                        </a>

                                        @if($sec->categories && $sec->categories->count() > 0)
                                            <div class="home-service-categories-list">
                                                @foreach($sec->categories as $cat)
                                                    <a href="{{ route('services.show', $cat->id) }}" class="home-service-category-link">
                                                        <span class="home-service-category-name">{{ $cat->name }}</span>
                                                        <svg class="home-service-category-arrow" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                                            <polyline points="12 5 19 12 12 19"></polyline>
                                                        </svg>
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    @if(!empty($sec->image))
                                        <div class="home-service-card-image-wrap">
                                            <img src="{{ asset('storage/' . $sec->image) }}" alt="{{ $sec->name }}" class="home-service-card-image" loading="lazy">
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="home-services-empty-item">
                                    Подразделы для данного направления пока не добавлены.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            @empty
                <div class="services-empty-placeholder">
                    Категории услуг пока не добавлены.
                </div>
            @endforelse
        </div>
    </div>
</section>
