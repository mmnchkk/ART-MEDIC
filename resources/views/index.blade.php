@push('vite')
@vite('resources/css/app.css')
@endpush

<x-main>
    <x-slot:title>
        Главная
    </x-slot:title>

    <div class="reviews-page">
        <x-reviews-section :reviews="\App\Models\Review::all()" />
    </div>
</x-main>