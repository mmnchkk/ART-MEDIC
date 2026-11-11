@props([
    'youtubeId' => 'HVpOo6alIeo',
])

<section class="home-work-section" id="homeWorkSection">
    <div class="home-work-container">
        <!-- Шапка блока: Наша работа -->
        <div class="home-work-header">
            <div class="home-work-title">
                <span>Наша работа</span>
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                </svg>
            </div>

            <div class="home-work-intro">
                Наша работа начинается с глубокой диагностики и детального планирования, а современное оборудование и сертифицированные материалы гарантируют безопасность на каждом этапе.
            </div>
        </div>

        <!-- Видео-плеер блока напрямую с YouTube -->
        <div class="home-work-video-wrapper">
            <iframe 
                class="home-work-video"
                src="https://www.youtube-nocookie.com/embed/{{ $youtubeId }}?rel=0&modestbranding=1" 
                title="Наша работа" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                allowfullscreen>
            </iframe>
        </div>
    </div>
</section>
