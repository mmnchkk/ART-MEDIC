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
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none">
                    <path
                        d="M19.6847 19.6326L19.6274 1.50556L1.5003 1.56291M19.6274 1.50556L3.06346 18.1746"
                        stroke="#91B5D5"
                        stroke-width="3"
                        stroke-linecap="round" />
                </svg>
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
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none">
                    <path
                        d="M19.6847 19.6326L19.6274 1.50556L1.5003 1.56291M19.6274 1.50556L3.06346 18.1746"
                        stroke="#91B5D5"
                        stroke-width="3"
                        stroke-linecap="round" />
                </svg>
            </div>

            <p class="clinic-title-description">
                Мы гордимся результатами, которых достигаем вместе с нашими пациентами благодаря современным методикам и золотым рукам хирургов. Убедитесь сами, как тонко и естественно мы умеем работать с красотой.
            </p>
        </div>

        <div class="clinic-results">
            <div class="clinic-filters">
                <a href="#" class="clinic-filter active">Все</a>
                <a href="#" class="clinic-filter">Блефаропластика</a>
                <a href="#" class="clinic-filter">Ринопластика</a>
                <a href="#" class="clinic-filter">Фэйслифтинг</a>
                <a href="#" class="clinic-filter">Коррекция губ</a>
                <a href="#" class="clinic-filter">Нитевой лифтинг</a>
                <a href="#" class="clinic-filter">Маммопластика</a>
                <a href="#" class="clinic-filter">Липосакция</a>
                <a href="#" class="clinic-filter">Липофилинг</a>
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
                <a href="#" class="pagination-arrow"><svg width="27" height="21" viewBox="0 0 27 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.12109 10.0605L1.06043 8.99989L-0.000227284 10.0605L1.06043 11.1212L2.12109 10.0605ZM24.6211 11.5605C25.4495 11.5605 26.1211 10.889 26.1211 10.0605C26.1211 9.23212 25.4495 8.56055 24.6211 8.56055L24.6211 10.0605L24.6211 11.5605ZM11.1211 1.06055L10.0604 -0.000112555L1.06043 8.99989L2.12109 10.0605L3.18175 11.1212L12.1818 2.12121L11.1211 1.06055ZM2.12109 10.0605L1.06043 11.1212L10.0604 20.1212L11.1211 19.0605L12.1818 17.9999L3.18175 8.99989L2.12109 10.0605ZM2.12109 10.0605L2.12109 11.5605L24.6211 11.5605L24.6211 10.0605L24.6211 8.56055L2.12109 8.56055L2.12109 10.0605Z" fill="#F4F7FF" />
                    </svg></a>
                <a href="#" class="pagination-arrow"><svg width="27" height="21" viewBox="0 0 27 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24 10.0605L25.0607 11.1212L26.1213 10.0605L25.0607 8.99989L24 10.0605ZM1.5 8.56054C0.671575 8.56054 1.71846e-06 9.23212 1.57361e-06 10.0605C1.42876e-06 10.889 0.671575 11.5605 1.5 11.5605L1.5 10.0605L1.5 8.56054ZM15 19.0605L16.0607 20.1212L25.0607 11.1212L24 10.0605L22.9393 8.99989L13.9393 17.9999L15 19.0605ZM24 10.0605L25.0607 8.99989L16.0607 -0.000113922L15 1.06055L13.9393 2.1212L22.9393 11.1212L24 10.0605ZM24 10.0605L24 8.56055L1.5 8.56054L1.5 10.0605L1.5 11.5605L24 11.5605L24 10.0605Z" fill="#F4F7FF" />
                    </svg></a>
            </div>
        </div>
    </div>
</x-main>