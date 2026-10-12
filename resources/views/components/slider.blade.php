@props(['title' => null, 'header' => null, 'showNav' => true])

@push('vite')
    @vite('resources/css/slider.css')
@endpush

<div {{ $attributes->merge(['class' => 'slider-wrapper']) }} x-data="{
    scrollNext() {
        const container = $refs.track;
        const cards = Array.from(container.children);
        const nextCard = cards.find(card => card.offsetLeft > container.scrollLeft + 15);
        if (nextCard) {
            container.scrollTo({ left: nextCard.offsetLeft, behavior: 'smooth' });
        } else {
            container.scrollTo({ left: 0, behavior: 'smooth' });
        }
    },
    scrollPrev() {
        const container = $refs.track;
        const cards = Array.from(container.children);
        const prevCard = cards.reverse().find(card => card.offsetLeft < container.scrollLeft - 15);
        if (prevCard) {
            container.scrollTo({ left: prevCard.offsetLeft, behavior: 'smooth' });
        } else {
            const originalCards = Array.from(container.children);
            const lastCard = originalCards[originalCards.length - 1];
            if (lastCard) {
                container.scrollTo({ left: lastCard.offsetLeft, behavior: 'smooth' });
            }
        }
    }
}">
    @if(isset($header) || $title)
        <div class="slider-header">
            @if(isset($header))
                {{ $header }}
            @elseif($title)
                <h2 class="project-section-heading">{{ $title }}</h2>
            @endif
            @if($showNav)
                <div class="slider-nav">
                    <button type="button" class="slider-nav-btn" @click="scrollPrev" aria-label="Предыдущий">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    </button>
                    <button type="button" class="slider-nav-btn" @click="scrollNext" aria-label="Следующий">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            @endif
        </div>
    @endif

    <div class="slider-track" x-ref="track">
        {{ $slot }}
    </div>

    @if(!isset($header) && !$title && $showNav)
        <div class="slider-nav">
            <button type="button" class="slider-nav-btn" @click="scrollPrev" aria-label="Предыдущий">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </button>
            <button type="button" class="slider-nav-btn" @click="scrollNext" aria-label="Следующий">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </div>
    @endif
</div>
