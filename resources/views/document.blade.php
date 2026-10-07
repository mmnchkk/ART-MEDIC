@push('vite')
    @vite('resources/css/app.css')
    @vite('resources/css/documents.css')
@endpush

<x-main>
    
    <x-slot:title>
    звзв
    </x-slot:title>
    <div class="doc-page">
        <nav class="doc-breadcrumbs">
            <a href="/">Арт-Медика</a>
            <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
            <span class="current">Документы</span>
        </nav>

        <h1 class="doc-title">
            Документы
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path></svg>
        </h1>

        <div x-data="{ active: 0 }" class="doc-accordion-container">
            @foreach($documents as $index => $type)
                <div class="doc-section">
                    <button @click="active = active === {{ $index }} ? null : {{ $index }}" class="doc-section-btn">
                        <span class="doc-section-title">{{ $type->name }}</span>
                        <svg :class="{'rotate': active === {{ $index }}}" class="doc-section-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                    </button>
                    <div x-show="active === {{ $index }}" x-collapse>
                        <div class="doc-content">
                            @if($type->documents && $type->documents->count() > 0)
                                <div class="doc-list">
                                    @foreach($type->documents as $doc)
                                        <a href="{{ asset('storage/' . $doc->document) }}" target="_blank" class="doc-item">
                                            <div class="doc-item-left">
                                                <svg class="doc-item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 9h1.5m-1.5 4h6m-6 4h6"></path></svg>
                                                <span class="doc-item-name">{{ $doc->name }}</span>
                                            </div>
                                            <svg class="doc-item-download" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <p class="doc-empty">Документы в данной категории отсутствуют.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>



</x-main>
