@push('vite')
    @vite('resources/css/reviews.css')
    @vite('resources/css/slider.css')
@endpush

<div class="reviews-section">
    <!-- Шапка -->
    <div class="reviews-header">
        <h2 class="reviews-title">
            Кейсы клиентов
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path></svg>
        </h2>
        <div class="reviews-intro">
            Высокий уровень доверия и качества медицинской помощи подтверждает рейтинг нашей клиники — 4.5 на основе 118 отзывов о врачах на сайте «ПроДокторов».
        </div>
    </div>

    <!-- Карусель с отзывами -->
    <x-slider>
        @foreach ($reviews as $review)
            <div class="review-card">
                
                <div class="review-card-header">
                    <h3 class="review-author">
                        {{ $review->first_name }}
                        <div class="review-stars">
                            @php $rating = intval($review->rating ?: 5); @endphp
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $rating)
                                    <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                @else
                                    <svg viewBox="0 0 24 24" style="color: #cbd5e1;"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                @endif
                            @endfor
                        </div>
                    </h3>
                    <svg class="review-link-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H9M17 7V15"></path></svg>
                </div>

                <div class="review-content">
                    <div class="review-section">
                        <h4>История пациента</h4>
                        <p>{{ $review->desc_story }}</p>
                    </div>
                    <div class="review-section">
                        <h4>Понравилось</h4>
                        <p>{{ $review->desc_like }}</p>
                    </div>
                </div>

                <div class="review-footer">
                    <div class="review-date">{{ $review->date }}</div>
                </div>

            </div>
        @endforeach
    </x-slider>
</div>
