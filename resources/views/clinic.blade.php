@push('vite')
@vite(['resources/css/app.css', 'resources/css/clinic.css'])
@endpush

<x-main>
    <x-slot:title>
        Арт-медика
    </x-slot:title>

    <div class="clinic">
        <div class="clinic-navigation">
            <a href="/">Арт-Медика</a>
            <span>&gt;</span>
            <p>О клинике</p>
        </div>

        <div class="clinic-title">
            <div class="clinic-title-nav">
                <h1>О клинике</h1>
                <!-- <img src="{{ Vite::asset('resources/image/arrow-right.svg') }}" alt="О клинике"> -->
            </div>

            <p class="clinic-title-description">
                Превращаем заветные мечты пациентов в реальность, невзирая на сложность задачи
            </p>
        </div>

        <div class="clinic-about">
            <div class="clinic-about-image">
                <img src="{{ Vite::asset('resources/image/clinic.svg') }}" alt="Клиника">
            </div>
            <div class="clinic-about-info">
                <div class="clinic-about-text">
                    <p>Центр «Арт-Медика» — партнер ЮУГМУ, клиническая база «Межрегионального центра непрерывного медицинского и фармацевтического образования» (г. Москва). Наша клиника является участником международных проектов в направлении "Пластическая хирургия и косметология".</p>
                    <p>Качество результата обеспечивает инновационное высокотехнологичное хирургическое, эндоскопическое и лазерное оборудование.</p>
                </div>
                <div class="clinic-des-cards">
                    <div class="clinic-des-card">
                        <h3>10+</h3>
                        <p>обучений в год проходят специалисты центра</p>
                    </div>
                    <div class="clinic-des-card">
                        <h3>20</h3>
                        <p>проектов уже было реализовано в нашей клинике</p>
                    </div>
                    <div class="clinic-des-card">
                        <h3>90%</h3>
                        <p>положительных отзывов</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="clinic-departments">
            <div class="clinic-policlinic">
                <div class="clinic-department-title">
                    <h3>Поликлиническое отделение</h3>
                    <p>Вы можете получить помощь по направлениям:</p>
                </div>
                <ol class="clinic-policlinic-list">
                    <li>Оториноларингология</li>
                    <li>Косметология</li>
                    <li>Дерматология</li>
                    <li>Венерология</li>
                    <li>Эстетическая гинекология</li>
                    <li>Неврология</li>
                    <li>Диагностика</li>
                    <li>Терапевтические услуги</li>
                </ol>
            </div>
            <div class="clinic-hospital">
                <h3>Стационарное отделение</h3>
                <div class="clinic-hospital-text">
                    <p>На территории отделения мы ежедневно оказываем помощь даже самым маленьким пациентам, выполняя полный спектр операций по направлению «Лор-хирургия», одним из самых востребованных остается аденотомия и септопластика (исправление носовой перегородки).</p>
                    <p>В стационарном отделении к вашим услугам палата европейского уровня с 3-х разовым питанием. Медицинская сестра будет сопровождать Вас 24 часа в сутки для создания самых комфортных условий.</p>
                    <p>Также в стационарном отделении мы оказываем полный спектр операций по направлению «Пластическая хирургия», особое место занимает проект <b>«Доступная пластическая хирургия из Милана»</b>.</p>
                </div>
                <div class="clinic-hospital-bottom">
                    <button class="clinic-button" type="button">Подробнее</button>
                    <div class="clinic-links">
                        <a href="#">Сайт Министерства здравоохранения Российской Федерации</a>
                        <a href="#">Официальный интернет-портал правовой информации</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="clinic-title">
            <div class="clinic-title-nav">
                <h1>Результат операций</h1>
                <!-- <img src="{{ Vite::asset('resources/image/arrow-right.svg') }}" alt="Результат операций"> -->
            </div>

            <p class="clinic-title-description">
                Мы гордимся результатами, которых достигаем вместе с нашими пациентами благодаря современным методикам и золотым рукам хирургов. Убедитесь сами, как тонко и естественно мы умеем работать с красотой.
            </p>
        </div>

        <div class="clinic-results">
            <div class="clinic-filters">
                <p class="clinic-filter active">Все</p>
                <p class="clinic-filter">Блефаропластика</p>
                <p class="clinic-filter">Ринопластика</p>
                <p class="clinic-filter">Фэйслифтинг</p>
                <p class="clinic-filter">Коррекция губ</p>
                <p class="clinic-filter">Нитевой лифтинг</p>
                <p class="clinic-filter">Маммопластика</p>
                <p class="clinic-filter">Липосакция</p>
                <p class="clinic-filter">Липофилинг</p>
            </div>
            <div class="clinic-gallery">
                <div class="clinic-gallery-item">
                    <img src="{{ Vite::asset('resources/image/clinic2.svg') }}" alt="Результат операции">
                </div>
                <div class="clinic-gallery-item">
                    <img src="{{ Vite::asset('resources/image/clinic2.svg') }}" alt="Результат операции">
                </div>
                <div class="clinic-gallery-item">
                    <img src="{{ Vite::asset('resources/image/clinic2.svg') }}" alt="Результат операции">
                </div>
            </div>
            <div class="clinic-pagination">
                <a href="#" class="pagination-arrow"><img src="{{ Vite::asset('resources/image/pagination-arrow-left.svg') }}" alt="Назад"></a>
                <a href="#" class="pagination-arrow"><img src="{{ Vite::asset('resources/image/pagination-arrow-right.svg') }}" alt="Вперед"></a>
            </div>
        </div>
    </div>
</x-main>