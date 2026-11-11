@push('vite')
    @vite('resources/css/app.css')
    @vite('resources/css/promotions.css')
@endpush

<x-main>
    <x-slot:title>
        {{ $promotion->name }} | Арт-Медика
    </x-slot:title>

    <div class="promotions-page">
        <!-- Хлебные крошки -->
        <nav class="promotions-breadcrumbs">
            <a href="/">Арт-Медика</a>
            <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="{{ route('promotions.index') }}">Акции</a>
            <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="current">{{ $promotion->name }}</span>
        </nav>

        <div style="max-width: 900px; margin: 0 auto;">
            <div style="margin-bottom: 24px;">
                @if ($promotion->date)
                    <div style="font-size: 15px; color: #92B5DF; font-weight: 500; margin-bottom: 8px;">
                        Действует до: {{ \Carbon\Carbon::parse($promotion->date)->format('d.m.Y') }}
                    </div>
                @endif
                <h1 style="font-size: 36px; font-weight: 600; color: #1A1D20; margin: 0; line-height: 1.25;">
                    {{ $promotion->name }}
                </h1>
            </div>

            @if ($promotion->image)
                <div style="width: 100%; border-radius: 20px; overflow: hidden; margin-bottom: 32px; background-color: #F5F8FC; max-height: 480px;">
                    <img 
                        src="{{ asset('storage/' . $promotion->image) }}" 
                        alt="{{ $promotion->name }}" 
                        style="width: 100%; height: 100%; object-fit: cover; display: block;"
                    >
                </div>
            @endif

            <div style="font-size: 16px; line-height: 1.7; color: #374151; margin-bottom: 40px;">
                {!! $promotion->description !!}
            </div>

            @if ($promotion->services->isNotEmpty())
                <div style="margin-top: 40px; padding-top: 32px; border-top: 1px solid #E5E7EB;">
                    <h3 style="font-size: 24px; font-weight: 500; margin-bottom: 20px; color: #1A1D20;">
                        Услуги, участвующие в акции:
                    </h3>
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        @foreach ($promotion->services as $service)
                            <a href="{{ route('services.show', $service->id) }}" style="display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; background-color: #F5F8FC; border-radius: 12px; text-decoration: none; color: #1A1D20; font-weight: 500; transition: background-color 0.2s;">
                                <span>{{ $service->name }}</span>
                                <span style="color: #92B5DF;">Подробнее →</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-main>

