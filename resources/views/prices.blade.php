@push('vite')
    @vite(['resources/css/app.css', 'resources/css/prices.css'])
@endpush

<x-main>
    <x-slot:title>
        Цены на услуги | Арт-Медика
    </x-slot:title>

    <div class="prices-page">
        <div class="prices-container" x-data="{
            // Открытые секции по id (первая секция открыта по умолчанию, как на макете)
            active: [{{ !empty($priceSections[0]['items'][0]['id']) ? $priceSections[0]['items'][0]['id'] : 0 }}],
            toggle(id) {
                if (this.active.includes(id)) {
                    this.active = this.active.filter(item => item !== id);
                } else {
                    this.active.push(id);
                }
            },
            isOpen(id) {
                return this.active.includes(id);
            }
        }">
            <!-- Шапка страницы -->
            <div class="prices-header">
                <a href="{{ route('prices') }}" class="prices-title">
                    <span>Цены на услуги</span>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7V15"></path>
                    </svg>
                </a>
            </div>

            @if(empty($priceSections))
                <div class="prices-empty-placeholder" style="padding: 4rem 1rem; text-align: center; color: #64748B;">
                    <h3 style="font-size: 20px; color: #1A1D20; margin-bottom: 0.5rem;">Прайс-лист формируется</h3>
                    <p style="margin: 0;">Цены на медицинские услуги скоро появятся на сайте.</p>
                </div>
            @else
                <!-- Группы по направлениям -->
                @foreach($priceSections as $sectionGroup)
                    <section class="prices-group">
                        <h2 class="prices-group-title">{{ $sectionGroup['name'] }}</h2>

                        <div class="prices-accordion-container">
                            @foreach($sectionGroup['items'] as $item)
                                @php
                                    $itemId = $item['id'];
                                    $minPriceFormatted = $item['min_price'] ? number_format($item['min_price'], 0, '', ' ') : null;
                                    $hasSimple = !empty($item['simple_prices']) && $item['simple_prices']->isNotEmpty();
                                    $hasCats = !empty($item['category_prices']) && $item['category_prices']->isNotEmpty();
                                @endphp

                                <div class="prices-section">
                                    <!-- Кнопка-шапка выпадающего списка (как в Документах и Специалистах) -->
                                    <button 
                                        type="button" 
                                        class="prices-section-btn" 
                                        @click="toggle({{ $itemId }})"
                                    >
                                        <div class="prices-section-header-left">
                                            <span class="prices-section-title">{{ $item['name'] }}</span>
                                            @if($minPriceFormatted)
                                                <span class="prices-section-from">от {{ $minPriceFormatted }} ₽</span>
                                            @endif
                                        </div>

                                        <svg 
                                            :class="{'rotate': isOpen({{ $itemId }})}" 
                                            class="prices-section-icon" 
                                            fill="none" 
                                            stroke="currentColor" 
                                            viewBox="0 0 24 24"
                                        >
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                        </svg>
                                    </button>

                                    <!-- Выпадающий контент с плавной анимацией Alpine x-collapse -->
                                    <div x-show="isOpen({{ $itemId }})" x-collapse>
                                        <div class="prices-content">
                                            <!-- 1. ТАБЛИЦА: Обычные услуги с единой ценой -->
                                            @if($hasSimple)
                                                <div class="prices-table-wrap">
                                                    <table class="prices-table">
                                                        <thead>
                                                            <tr>
                                                                <th class="col-code">Код<br>Номенклатуры<br>мед услуг</th>
                                                                <th class="col-mis">Код МИС</th>
                                                                <th class="col-name">Наименование медицинской услуги</th>
                                                                <th class="col-time">Время,<br>мин</th>
                                                                <th class="col-price">Цена,<br>руб</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($item['simple_prices'] as $p)
                                                                <tr>
                                                                    <td class="td-code">{{ $p['code'] ?: '—' }}</td>
                                                                    <td class="td-mis">{{ $p['code_mis'] ?: '—' }}</td>
                                                                    <td class="td-name">{{ $p['name'] }}</td>
                                                                    <td class="td-time">{{ $p['duration'] ? ($p['duration'] . ' мин') : '—' }}</td>
                                                                    <td class="td-price">
                                                                        @if($p['price'] !== null && $p['price'] > 0)
                                                                            {{ number_format($p['price'], 0, '', ' ') }} ₽
                                                                        @elseif($p['price'] === 0.0)
                                                                            Бесплатно
                                                                        @else
                                                                            По запросу
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif

                                            @if($hasSimple && $hasCats)
                                                <div class="prices-table-divider"></div>
                                            @endif

                                            <!-- 2. ТАБЛИЦА: Услуги с категориями сложности (I, II, III) -->
                                            @if($hasCats)
                                                <div class="prices-table-wrap">
                                                    <div class="prices-table-note" style="margin-bottom: 0.75rem;">
                                                        *Категория присваивает врач-хирург на консультации, в зависимости от анатомии пациента
                                                    </div>
                                                    <table class="prices-table">
                                                        <thead>
                                                            <tr>
                                                                <th class="col-code">Код<br>Номенклатуры<br>мед услуг</th>
                                                                <th class="col-mis">Код МИС</th>
                                                                <th class="col-name">Наименование медицинской услуги</th>
                                                                <th class="col-time">Время,<br>мин</th>
                                                                <th class="col-cats">
                                                                    <div>Цена, руб / категории сложности</div>
                                                                    <div class="prices-cats-head">
                                                                        <span class="prices-cat-val">I</span>
                                                                        <span class="prices-cat-val">II</span>
                                                                        <span class="prices-cat-val">III</span>
                                                                    </div>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($item['category_prices'] as $p)
                                                                <tr>
                                                                    <td class="td-code">{{ $p['code'] ?: '—' }}</td>
                                                                    <td class="td-mis">{{ $p['code_mis'] ?: '—' }}</td>
                                                                    <td class="td-name">{{ $p['name'] }}</td>
                                                                    <td class="td-time">{{ $p['duration'] ? ($p['duration'] . ' мин') : '—' }}</td>
                                                                    <td class="td-cats">
                                                                        <div class="prices-cats-values">
                                                                            <span class="prices-cat-val">
                                                                                {{ $p['price_category_1'] ? number_format($p['price_category_1'], 0, '', ' ') . ' ₽' : ($p['price'] ? number_format($p['price'], 0, '', ' ') . ' ₽' : '—') }}
                                                                            </span>
                                                                            <span class="prices-cat-val">
                                                                                {{ $p['price_category_2'] ? number_format($p['price_category_2'], 0, '', ' ') . ' ₽' : '—' }}
                                                                            </span>
                                                                            <span class="prices-cat-val">
                                                                                {{ $p['price_category_3'] ? number_format($p['price_category_3'], 0, '', ' ') . ' ₽' : '—' }}
                                                                            </span>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endforeach
            @endif
        </div>
    </div>
</x-main>
