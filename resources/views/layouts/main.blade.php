<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/css/header-footer.css', 'resources/css/fontello.css'])
    @stack('vite')
</head>
<body>
    <header class="header">
        <div class="header-container">
            <a href="/" class="logo">
                <img src="img/logo.svg" alt="logo" class="logo-img">
            </a>
            <nav class="navigation">
                <a href="#clinic">О клинике</a>
                <a href="#services">Услуги</a>
                <a href="#specialists">Специалисты</a>
                <a href="#offers">Акции</a>
                <a href="#documents">Документы</a>
                <a href="#contacts">Контакты</a>
            </nav>
            <div class="header-right">
                <div class="header-info">
                    <div class="header-address">
                        Челябинск, пр. Ленина 12а
                    </div>
                    <div class="header-time">
                        ПН-СБ с 9:00 до 20:00
                    </div>
                </div>
                <div class="header-buttons">
                    <a href="#" class="phone-button"><img src="img/icons/phone-icon.svg" alt="phone" class="phone-icon"></a>
                    <a href="#appointment" class="appointment-button">Записаться</a>
                </div>
            </div>
        </div>
    </header>
    <main>
        {{ $slot }}
    </main>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-brand">
                <img src="img/logo.svg" alt="logo" class="logo-img">
                <div class="footer-socials">
                    <a href="#"><img src="img/icons/max.svg" alt="max"></a>
                    <a href="#"><img src="img/icons/vk.svg" alt="vk"></a>
                    <a href="#"><img src="img/icons/telegram.svg" alt="telegram"></a>
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
                <div class="footer-contact"><i class="demo-icon icon-subtract-1"></i>Челябинск, пр. Ленина 12а</div>
                <div class="footer-contact"><i class="demo-icon icon-vector-189"></i>+7 (351) 775-19-18</div>
                <div class="footer-contact"><i class="demo-icon icon-subtract-2"></i>marketing.art-medica@mail.ru</div>
                <div class="footer-contact">
                    <i class="demo-icon icon-subtract-3"></i>
                    09:00 до 20:00<br>
                    понедельник - суббота
                </div>
            </div>
        </div>
        <div class="footer-warning">
            ИМЕЮТСЯ ПРОТИВОПОКАЗАНИЯ. НЕОБХОДИМА КОНСУЛЬТАЦИЯ СПЕЦИАЛИСТА
        </div>
    </footer>
</body>
</html>