<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/css/header-footer.css', 'resources/css/fontello.css', 'resources/js/app.js'])
    @stack('vite')
</head>

<body>
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
                        <a href="/services" @click="mobileMenuOpen = false">Пластическая хирургия</a>
                        <a href="/services" @click="mobileMenuOpen = false">Косметология</a>
                        <a href="/services" @click="mobileMenuOpen = false">Топ-продукты</a>
                        <a href="/services" @click="mobileMenuOpen = false">Дерматология</a>
                        <a href="/services" @click="mobileMenuOpen = false">Оториноларингология</a>
                        <a href="/services" @click="mobileMenuOpen = false">Лор-хирургия</a>
                        <a href="/services" @click="mobileMenuOpen = false">Неврология и рефлексотерапия</a>
                        <a href="/services" @click="mobileMenuOpen = false">Эстетическая гинекология</a>
                        <a href="/services" @click="mobileMenuOpen = false">Терапевтический приём</a>
                        <a href="/services" @click="mobileMenuOpen = false">Массаж</a>
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
                        <img src="img/logo.svg" alt="logo" class="logo-img">
                    </a>
                    <div class="footer-socials">
                        <a href="#"><img src="img/icons/max.svg" alt="max"></a>
                        <a href="#"><img src="img/icons/vk.svg" alt="vk"></a>
                        <a href="#"><img src="img/icons/telegram.svg" alt="telegram"></a>
                    </div>
                </div>
                <a href="#" class="footer-accessibility"><i class="demo-icon icon-subtract"></i>Версия для слабовидящих</a>
                <div class="footer-copy">
                    © Медико-косметологический центр Арт-медика 2026<br>
                    Категория 18+
                </div>
            </div>
            <div class="footer-column">
                <h3>Клиника</h3>
                <a href="#">О клинике</a>
                <a href="#">Специалисты</a>
                <a href="#">Услуги</a>
                <a href="#">Проекты</a>
                <a href="#">Акции</a>
                <a href="#">Новости</a>
                <a href="#">Цены</a>
                <a href="#">Контакты</a>
                <a href="#">Документы</a>
                <a href="/quesAns">Вопросы и ответы</a>
            </div>
            <div class="footer-column">
                <h3>Услуги</h3>
                <a href="#">Пластическая хирургия</a>
                <a href="#">Косметология</a>
                <a href="#">Топ-продукты</a>
                <a href="#">Дерматология</a>
                <a href="#">Оториноларингология</a>
                <a href="#">Лор-хирургия</a>
                <a href="#">Неврология и рефлексотерапия</a>
                <a href="#">Эстетическая гинекология</a>
                <a href="#">Терапевтический приём</a>
                <a href="#">Массаж</a>
            </div>
            <div class="footer-contacts">
                <div class="footer-buttons">
                    <a href="#" class="footer-appointment">Записаться</a>
                    <a href="#" class="phone-button"><img src="img/icons/phone-icon.svg" alt="phone" class="phone-icon"></a>
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
</body>

</html>