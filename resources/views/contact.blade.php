@push('vite')
@vite('resources/css/app.css')
@vite('resources/css/contacts.css')
@endpush

<x-main>
    <x-slot:title>
        Контакты
    </x-slot:title>

    <div class="contact-page">
        <!-- Хлебные крошки -->
        <nav class="contact-breadcrumbs">
            <a href="/">Арт-Медика</a>
            <svg class="separator" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="current">Контакты</span>
        </nav>

        <!-- Шапка -->
        <div class="contact-header">
            <h1 class="contact-title">
                Контакты
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                </svg>
            </h1>
            <div class="contact-intro">
                Пишите нам, когда вам удобно — даже в выходные или ночью. Ваш запрос будет обработан в ближайшее рабочее время
            </div>
        </div>

        <!-- Карта 2ГИС -->
        <div id="map-container" class="contact-map-container"></div>

        <!-- Блок контактов -->
        @if($contact)
        <div class="contact-grid">
            <!-- Карточка 1: Адрес -->
            <div class="contact-card">
                <h3>Адрес</h3>
                <p>{{ $contact->adress }}</p>
            </div>

            <!-- Карточка 2: Телефоны -->
            <div class="contact-card">
                <h3>Телефоны</h3>
                @foreach($contact->phones as $phone)
                <p>{{ $phone->phone }} - {{ $phone->description }}</p>
                @endforeach
            </div>

            <!-- Карточка 3: E-mail -->
            <div class="contact-card">
                <h3>E-mail</h3>
                @foreach($contact->mails as $mail)
                <p>{{ $mail->mail }} - {{ $mail->description }}</p>
                @endforeach
            </div>

            <!-- Карточка 4: Сообщения -->
            <div class="contact-card">
                <h3>Сообщения</h3>
                <p>{{ $contact->sms }}</p>
            </div>

            <!-- Карточка 5: Режим работы -->
            <div class="contact-card">
                <h3>Режим работы</h3>
                <p>{{ $contact->schedule }}</p>
            </div>
        </div>
        @else
        <p>Контакты пока не заполнены.</p>
        @endif


    </div>

    <script src="https://mapgl.2gis.com/api/js/v1"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const map = new mapgl.Map('map-container', {
                center: [61.449142, 55.160836],
                zoom: 17,
                key: '2596746f-69ca-47f4-b661-215d46b31128',
            });

            const marker = new mapgl.Marker(map, {
                coordinates: [61.449142, 55.160836],
            });
        });
    </script>
</x-main>