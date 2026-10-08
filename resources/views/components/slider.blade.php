@push('vite')
    @vite('resources/css/slider.css')
@endpush

<div class="slider-wrapper" x-data="{
    scrollNext() {
        const container = $refs.track;
        const cards = Array.from(container.children);
        const nextCard = cards.find(card => card.offsetLeft > container.scrollLeft + 10);
        if (nextCard) {
            container.scrollTo({ left: nextCard.offsetLeft, behavior: 'smooth' });
        }
    },
    scrollPrev() {
        const container = $refs.track;
        const cards = Array.from(container.children);
        const prevCard = cards.reverse().find(card => card.offsetLeft < container.scrollLeft - 10);
        if (prevCard) {
            container.scrollTo({ left: prevCard.offsetLeft, behavior: 'smooth' });
        } else {
            container.scrollTo({ left: 0, behavior: 'smooth' });
        }
    }
}">
    
    <div class="slider-track" x-ref="track">
        {{ $slot }}
    </div>

    <div class="slider-nav">
        <button class="slider-nav-btn" @click="scrollPrev" aria-label="Предыдущий">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </button>
        <button class="slider-nav-btn" @click="scrollNext" aria-label="Следующий">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </button>
    </div>
</div>
