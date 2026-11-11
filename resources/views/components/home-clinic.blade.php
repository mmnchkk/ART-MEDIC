@props(['clinic' => null])

@php
    if (!isset($clinic)) {
        try {
            $clinic = \App\Models\Clinic::first();
        } catch (\Throwable $e) {
            $clinic = null;
        }
    }

    $imageSrc = !empty($clinic?->image) 
        ? asset('storage/' . $clinic->image) 
        : asset('storage/clinics/01M716JM17ATSTF9P20BED6PKE.jpg');

    $studyCount = $clinic?->count_study ?? 10;
    $projectsCount = $clinic?->count_projects ?? 20;
    $reviewsCount = $clinic?->count_reviews ?? 90;
@endphp

<section class="home-clinic-section">
    <div class="home-clinic-container">
        <!-- Шапка блока: О клинике -->
        <div class="home-clinic-header">
            <a href="{{ route('clinic') }}" class="home-clinic-title">
                <span>О клинике</span>
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                </svg>
            </a>

            <div class="home-clinic-intro">
                Превращаем заветные мечты пациентов в реальность, невзирая на сложность задачи
            </div>
        </div>

        <!-- Контент блока: фото слева, описание и цифры справа -->
        <div class="home-clinic-about">
            <div class="home-clinic-image-wrap">
                <img src="{{ $imageSrc }}" alt="Клиника Арт-Медика" class="home-clinic-image" loading="lazy">
            </div>

            <div class="home-clinic-info">
                <div class="home-clinic-text">
                    @if(!empty($clinic?->description))
                        {!! $clinic->description !!}
                    @else
                        <p>Центр «Арт-Медика» — партнер ЮУГМУ, клиническая база «Межрегионального центра непрерывного медицинского и фармацевтического образования» (г. Москва). Наша клиника является участником международных проектов в направлении "Пластическая хирургия и косметология".</p>
                        <p>Качество результата обеспечивает инновационное высокотехнологичное хирургическое, эндоскопическое и лазерное оборудование.</p>
                    @endif
                </div>

                <div class="home-clinic-stats">
                    <div class="home-clinic-stat-card">
                        <span class="home-clinic-stat-num">{{ $studyCount }}+</span>
                        <span class="home-clinic-stat-label">обучений в год проходят специалисты центра</span>
                    </div>

                    <div class="home-clinic-stat-card">
                        <span class="home-clinic-stat-num">{{ $projectsCount }}</span>
                        <span class="home-clinic-stat-label">проектов уже было реализовано в нашей клинике</span>
                    </div>

                    <div class="home-clinic-stat-card">
                        <span class="home-clinic-stat-num">{{ $reviewsCount }}%</span>
                        <span class="home-clinic-stat-label">положительных отзывов</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
