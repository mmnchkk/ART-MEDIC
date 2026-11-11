@props(['clinic' => null])

@php
    if (!isset($clinic)) {
        $clinic = \App\Models\Clinic::first();
    }
    $heroBg = !empty($clinic?->image) ? asset('storage/' . $clinic->image) : '/img/hero-bg.jpg';
@endphp

<section class="hero-section" style="background-image: url('{{ $heroBg }}');">
    <div class="hero-overlay"></div>
    <div class="hero-container">
        <div class="hero-content">
            <h1 class="hero-title">Ваше здоровье — наша забота</h1>
            <p class="hero-subtitle">Медико-косметологический центр с современным оборудованием и опытными специалистами</p>
        </div>

        @if(!empty($clinic?->count_study) || !empty($clinic?->count_projects) || !empty($clinic?->count_reviews))
            <div class="hero-stats-grid">
                @if(!empty($clinic?->count_study))
                    <div class="hero-stat-card">
                        <div class="hero-stat-value">{{ $clinic->count_study }}+</div>
                        <div class="hero-stat-label">обучений в год проходят специалисты центра</div>
                    </div>
                @endif

                @if(!empty($clinic?->count_projects))
                    <div class="hero-stat-card">
                        <div class="hero-stat-value">{{ $clinic->count_projects }}</div>
                        <div class="hero-stat-label">проектов уже реализовано в нашей клинике</div>
                    </div>
                @endif

                @if(!empty($clinic?->count_reviews))
                    <div class="hero-stat-card">
                        <div class="hero-stat-value">{{ $clinic->count_reviews }}%</div>
                        <div class="hero-stat-label">положительных отзывов</div>
                    </div>
                @endif
            </div>
        @endif

        <a href="#appointment" class="hero-phone-cta" aria-label="Связаться с клиникой">
            <svg viewBox="0 0 24 24">
                <path d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
            </svg>
        </a>
    </div>
</section>
