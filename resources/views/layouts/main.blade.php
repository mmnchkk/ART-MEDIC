<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/css/header-footer.css', 'resources/css/accessible.css', 'resources/css/fontello.css', 'resources/js/app.js'])
    @stack('vite')
</head>

<body>
@php
    if (!isset($headerServices)) {
        $headerServices = \App\Models\ServiceCategorySectionAll::all();
    }
@endphp
    <header class="header" x-data="{ mobileMenuOpen: false, servicesOpen: false }">
        <div class="header-container">
            <!-- Бургер (виден на экранах < 1200px) -->
            <button class="burger-button" @click="mobileMenuOpen = true" aria-label="Открыть меню">
                <span class="burger-line"></span>
                <span class="burger-line"></span>
                <span class="burger-line"></span>
            </button>

            <!-- Логотип -->
            <a href="/" class="logo">
                <img src="/img/logo.svg" alt="Арт-Медика" class="logo-img">
            </a>

            <!-- Десктопная навигация -->
            <nav class="navigation">
                <a href="/clinic">О клинике</a>
                <a href="/services">Услуги</a>
                <a href="/specialists">Специалисты</a>
                <a href="/offers">Акции</a>
                <a href="/documents">Документы</a>
                <a href="/contacts">Контакты</a>
            </nav>

            <!-- Правая часть -->
            <div class="header-right">
                <div class="header-info">
                    <div class="header-address">
                        <span class="address-city">Челябинск,<span class="address-space"> </span></span>
                        <span class="address-street">пр. Ленина 12а</span>
                    </div>
                    <div class="header-time">
                        ПН-СБ с 9:00 до 20:00
                    </div>
                </div>
                <div class="header-buttons">
                    <a href="#appointment" class="appointment-button">Записаться</a>
                </div>
            </div>
        </div>

        <!-- Оверлей модального меню -->
        <div 
            class="mobile-menu-backdrop" 
            x-show="mobileMenuOpen" 
            x-transition.opacity.duration.300ms
            @click="mobileMenuOpen = false"
            @keydown.escape.window="mobileMenuOpen = false"
            x-cloak
        ></div>

        <!-- Модалка / Drawer со списком по макету -->
        <div 
            class="mobile-menu-drawer" 
            x-show="mobileMenuOpen" 
            x-transition:enter="drawer-transition"
            x-transition:enter-start="drawer-closed"
            x-transition:enter-end="drawer-open"
            x-transition:leave="drawer-transition"
            x-transition:leave-start="drawer-open"
            x-transition:leave-end="drawer-closed"
            x-cloak
        >
            <div class="mobile-drawer-header">
                <a href="/" class="drawer-logo" @click="mobileMenuOpen = false">
                    <img src="/img/logo.svg" alt="Арт-Медика" class="drawer-logo-img">
                </a>
                <button class="drawer-close-btn" @click="mobileMenuOpen = false" aria-label="Закрыть">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <nav class="drawer-nav">
                <!-- Услуги со стрелкой вниз -->
                <div class="drawer-accordion-item">
                    <button type="button" class="drawer-accordion-btn" @click="servicesOpen = !servicesOpen">
                        <span>Услуги</span>
                        <svg class="drawer-arrow" :class="{ 'rotate': servicesOpen }" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <polyline points="19 12 12 19 5 12"></polyline>
                        </svg>
                    </button>
                    <div x-show="servicesOpen" x-collapse class="drawer-services-sublist">
                        @foreach($headerServices as $allSec)
                            <a href="{{ route('services.section', $allSec->id) }}" @click="mobileMenuOpen = false">
                                {{ $allSec->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <a href="/clinic" class="drawer-link" @click="mobileMenuOpen = false">О клинике</a>
                <a href="/specialists" class="drawer-link" @click="mobileMenuOpen = false">Специалисты</a>
                <a href="/services" class="drawer-link" @click="mobileMenuOpen = false">Услуги</a>
                <a href="/projects" class="drawer-link" @click="mobileMenuOpen = false">Проекты</a>
                <a href="/offers" class="drawer-link" @click="mobileMenuOpen = false">Акции</a>
                <a href="/uncos" class="drawer-link" @click="mobileMenuOpen = false">Новости</a>
                <a href="/prices" class="drawer-link" @click="mobileMenuOpen = false">Цены</a>
                <a href="/contacts" class="drawer-link" @click="mobileMenuOpen = false">Контакты</a>
                <a href="/documents" class="drawer-link" @click="mobileMenuOpen = false">Документы</a>
                <a href="/quesAns" class="drawer-link" @click="mobileMenuOpen = false">Вопросы и ответы</a>
            </nav>
        </div>
    </header>
    <main>
        {{ $slot }}
    </main>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-brand">
                <div class="footer-brand-top">
                    <a href="/" class="footer-logo">
                        <img src="/img/logo.svg" alt="logo" class="logo-img">
                    </a>
                    <div class="footer-socials">
                        <a href="#"><img src="/img/icons/max.svg" alt="max"></a>
                        <a href="#"><img src="/img/icons/vk.svg" alt="vk"></a>
                        <a href="#"><img src="/img/icons/telegram.svg" alt="telegram"></a>
                    </div>
                </div>
                <a href="#" class="footer-accessibility" id="accessibilityToggle" onclick="toggleAccessibility(); return false;"><i class="demo-icon icon-subtract"></i>Версия для слабовидящих</a>
                <div class="footer-copy">
                    © Медико-косметологический центр Арт-медика 2026<br>
                    Категория 18+
                </div>
            </div>
            <div class="footer-column">
                <h3>Клиника</h3>
                <a href="/clinic">О клинике</a>
                <a href="/specialists">Специалисты</a>
                <a href="/services">Услуги</a>
                <a href="/projects">Проекты</a>
                <a href="/offers">Акции</a>
                <a href="/uncos">Новости</a>
                <a href="/prices">Цены</a>
                <a href="/contacts">Контакты</a>
                <a href="/documents">Документы</a>
                <a href="/quesAns">Вопросы и ответы</a>
            </div>
            <div class="footer-column">
                <h3>Услуги</h3>
                @foreach($headerServices as $allSec)
                    <a href="{{ route('services.section', $allSec->id) }}">
                        {{ $allSec->name }}
                    </a>
                @endforeach
            </div>
            <div class="footer-contacts">
                <div class="footer-buttons">
                    <a href="#" class="footer-appointment">Записаться</a>
                    <a href="#" class="phone-button"><img src="/img/icons/phone-icon.svg" alt="phone" class="phone-icon"></a>
                </div>
                <div class="footer-contact-list">
                    <div class="footer-contact"><i class="demo-icon icon-subtract-1"></i>Челябинск, пр. Ленина 12а</div>
                    <div class="footer-contact"><i class="demo-icon icon-vector-189"></i>+7 (351) 775-19-18</div>
                    <div class="footer-contact"><i class="demo-icon icon-subtract-2"></i>marketing.art-medica@mail.ru</div>
                    <div class="footer-contact">
                        <i class="demo-icon icon-subtract-3"></i>
                        <span>09:00 до 20:00<span class="hours-sep"> </span><br class="hours-br">понедельник - суббота</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-warning">
            ИМЕЮТСЯ ПРОТИВОПОКАЗАНИЯ. НЕОБХОДИМА КОНСУЛЬТАЦИЯ СПЕЦИАЛИСТА
        </div>
    </footer>

    <!-- Панель слабовидящих -->
    <div class="a11y-panel" id="a11yPanel" aria-label="Настройки версии для слабовидящих">
        <div class="a11y-panel-inner">

            <!-- Шапка панели -->
            <div class="a11y-panel-header">
                <div class="a11y-panel-title">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M2 12s3.636-7 10-7 10 7 10 7-3.636 7-10 7S2 12 2 12z"/></svg>
                    <span>Версия для слабовидящих</span>
                </div>
                <button class="a11y-close-btn" id="a11yClose" title="Вернуться к обычной версии">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    <span>Обычная версия</span>
                </button>
            </div>

            <div class="a11y-panel-body">

                <!-- Цветовая схема -->
                <div class="a11y-group">
                    <div class="a11y-group-label">Цвет</div>
                    <div class="a11y-btn-row">
                        <button class="a11y-color-btn" data-scheme="none" title="Без изменений">
                            <span class="a11y-color-swatch a11y-swatch-none"></span>
                            <span>Стандарт</span>
                        </button>
                        <button class="a11y-color-btn" data-scheme="dark" title="Чёрный фон, белый текст">
                            <span class="a11y-color-swatch a11y-swatch-dark"></span>
                            <span>Тёмная</span>
                        </button>
                        <button class="a11y-color-btn" data-scheme="light" title="Белый фон, чёрный текст">
                            <span class="a11y-color-swatch a11y-swatch-light"></span>
                            <span>Светлая</span>
                        </button>
                        <button class="a11y-color-btn" data-scheme="yellow" title="Чёрный фон, жёлтый текст">
                            <span class="a11y-color-swatch a11y-swatch-yellow"></span>
                            <span>Жёлтая</span>
                        </button>
                        <button class="a11y-color-btn" data-scheme="blue" title="Синий фон, голубой текст">
                            <span class="a11y-color-swatch a11y-swatch-blue"></span>
                            <span>Синяя</span>
                        </button>
                    </div>
                </div>

                <!-- Размер шрифта -->
                <div class="a11y-group">
                    <div class="a11y-group-label">Размер шрифта</div>
                    <div class="a11y-btn-row">
                        <button class="a11y-size-btn" data-size="md" title="Обычный">
                            <span class="a11y-size-letter">A</span>
                            <span>Стандарт</span>
                        </button>
                        <button class="a11y-size-btn" data-size="lg" title="Крупный">
                            <span class="a11y-size-letter a11y-size-letter--lg">A</span>
                            <span>Крупный</span>
                        </button>
                        <button class="a11y-size-btn" data-size="xl" title="Очень крупный">
                            <span class="a11y-size-letter a11y-size-letter--xl">A</span>
                            <span>Макси</span>
                        </button>
                    </div>
                </div>

                <!-- Дополнительно -->
                <div class="a11y-group">
                    <div class="a11y-group-label">Дополнительно</div>
                    <div class="a11y-btn-row">
                        <button class="a11y-toggle-btn" id="a11ySpacing" title="Увеличенный межбуквенный интервал">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 7l3-3-3-3"/><path d="M20 7l-3-3 3-3"/><line x1="4" y1="4" x2="20" y2="4"/><line x1="12" y1="8" x2="12" y2="21"/></svg>
                            <span>Интервал</span>
                        </button>
                        <button class="a11y-toggle-btn" id="a11yImages" title="Скрыть изображения">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/><line x1="2" y1="2" x2="22" y2="22"/></svg>
                            <span>Без фото</span>
                        </button>
                    </div>
                </div>

            </div>

        </div>
    </div>

</body>

<script>
(function () {
    const body = document.body;
    const panel = document.getElementById('a11yPanel');
    const toggleBtn = document.getElementById('accessibilityToggle');

    const SCHEMES = ['dark', 'light', 'yellow', 'blue'];
    const SIZES   = ['md', 'lg', 'xl'];

    function getState() {
        try { return JSON.parse(localStorage.getItem('a11y') || '{}'); } catch { return {}; }
    }
    function saveState(s) {
        localStorage.setItem('a11y', JSON.stringify(s));
    }

    function applyState(s) {
        const isOn = !!s.on;
        body.classList.toggle('accessible', isOn);
        panel.classList.toggle('a11y-panel--visible', isOn);

        // Схема (none = без цветовой схемы)
        SCHEMES.forEach(sc => body.classList.remove('a11y-' + sc));
        if (isOn && s.scheme && s.scheme !== 'none') body.classList.add('a11y-' + s.scheme);

        // Размер
        SIZES.forEach(sz => body.classList.remove('a11y-font-' + sz));
        if (isOn && s.size) body.classList.add('a11y-font-' + s.size);

        // Интервал
        body.classList.toggle('a11y-spacing', isOn && !!s.spacing);

        // Скрыть картинки
        body.classList.toggle('a11y-no-images', isOn && !!s.noImages);

        // Активность кнопок цвета
        document.querySelectorAll('.a11y-color-btn').forEach(btn => {
            const active = isOn && btn.dataset.scheme === (s.scheme || 'none');
            btn.classList.toggle('a11y-active', active);
        });

        // Активность кнопок размера
        document.querySelectorAll('.a11y-size-btn').forEach(btn => {
            btn.classList.toggle('a11y-active', isOn && btn.dataset.size === (s.size || 'md'));
        });

        const spacingBtn = document.getElementById('a11ySpacing');
        if (spacingBtn) spacingBtn.classList.toggle('a11y-active', isOn && !!s.spacing);
        const imagesBtn = document.getElementById('a11yImages');
        if (imagesBtn) imagesBtn.classList.toggle('a11y-active', isOn && !!s.noImages);

        if (toggleBtn) {
            toggleBtn.innerHTML = isOn
                ? '<i class="demo-icon icon-subtract"></i>Обычная версия'
                : '<i class="demo-icon icon-subtract"></i>Версия для слабовидящих';
        }
    }

    // Включить/выключить
    window.toggleAccessibility = function () {
        const s = getState();
        s.on = !s.on;
        if (s.on && !s.scheme) s.scheme = 'none';
        if (s.on && !s.size) s.size = 'md';
        saveState(s);
        applyState(s);
    };

    // Смена схемы (клик по уже активной — сбрасывает на 'none')
    document.querySelectorAll('.a11y-color-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const s = getState();
            const clicked = btn.dataset.scheme;
            s.scheme = (s.scheme === clicked && clicked !== 'none') ? 'none' : clicked;
            saveState(s);
            applyState(s);
        });
    });

    // Смена размера
    document.querySelectorAll('.a11y-size-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const s = getState();
            s.size = btn.dataset.size;
            saveState(s);
            applyState(s);
        });
    });

    // Межбуквенный интервал
    const spacingBtn = document.getElementById('a11ySpacing');
    if (spacingBtn) spacingBtn.addEventListener('click', () => {
        const s = getState();
        s.spacing = !s.spacing;
        saveState(s);
        applyState(s);
    });

    // Скрыть изображения
    const imagesBtn = document.getElementById('a11yImages');
    if (imagesBtn) imagesBtn.addEventListener('click', () => {
        const s = getState();
        s.noImages = !s.noImages;
        saveState(s);
        applyState(s);
    });

    // Закрыть
    const closeBtn = document.getElementById('a11yClose');
    if (closeBtn) closeBtn.addEventListener('click', () => {
        const s = getState();
        s.on = false;
        saveState(s);
        applyState(s);
    });

    // При загрузке — восстановить сохранённое
    applyState(getState());
})();
</script>

</html>