@push('vite')
@vite(['resources/css/app.css', 'resources/css/hero.css', 'resources/css/home-services.css', 'resources/css/home-clinic.css', 'resources/css/home-results.css', 'resources/css/home-specialists.css', 'resources/css/home-projects.css', 'resources/css/home-work.css'])
@endpush

<x-main>
    <x-slot:title>
        Главная
    </x-slot:title>

    <x-hero :clinic="$clinic ?? null" />

    <x-home-services :sections-all="$serviceSectionsAll ?? null" />

    <x-home-clinic :clinic="$clinic ?? null" />

    <x-home-results :services-filter="$servicesFilter ?? null" :results-list="$resultsList ?? null" />

    <x-home-specialists :specialities="$specialities ?? null" :specialists="$specialists ?? null" />

    <x-home-projects :projects="$projects ?? null" />

    <x-home-work />

    <div class="reviews-page">
        <x-reviews-section :reviews="\App\Models\Review::all()" />
    </div>
</x-main>
