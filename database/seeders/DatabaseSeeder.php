<?php

namespace Database\Seeders;

use App\Models\Accreditation;
use App\Models\Promotion;
use App\Models\Clinic;
use App\Models\Contact;
use App\Models\Department;
use App\Models\DepartmentDirection;
use App\Models\Direction;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Education;
use App\Models\FormatWork;
use App\Models\Image;
use App\Models\Mail;
use App\Models\Parten;
use App\Models\Phone;
use App\Models\Project;
use App\Models\ProjectStages;
use App\Models\QuestionAnswer;
use App\Models\Review;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceCategorySection;
use App\Models\ServiceCategorySectionAll;
use App\Models\ServicePrice;
use App\Models\ServiceProblem;
use App\Models\ServiceResult;
use App\Models\ServiceType;
use App\Models\Specialist;
use App\Models\Speciality;
use App\Models\Unco;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Complete and detailed database seeder for ART-MEDIC.
     */
    public function run(): void
    {
        // ==========================================
        // 1. АДМИНИСТРАТОР
        // ==========================================
        User::firstOrCreate(
            ['email' => 'admin@test.ru'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
            ]
        );

        // ==========================================
        // 2. КЛИНИКА И ОТДЕЛЕНИЯ
        // ==========================================
        $clinic = Clinic::firstOrCreate(
            ['id' => 1],
            [
                'description' => '<p>Многопрофильная клиника пластической хирургии и эстетической медицины «Арт-Медика» работает с 2002 года. Мы объединяем опыт ведущих специалистов Южного Урала, передовые хирургические технологии и бескомпромиссные стандарты безопасности пациентов.</p><p>Каждый наш специалист — признанный эксперт в своей области, регулярно проходящий стажировки в ведущих мировых центрах реконструктивной и эстетической медицины.</p>',
                'image' => 'clinics/01M716JM17ATSTF9P20BED6PKE.jpg',
                'count_study' => 24,
                'count_projects' => 12,
                'count_reviews' => 98,
            ]
        );

        $plasticDept = Department::firstOrCreate(
            ['clinic_id' => $clinic->id, 'name' => 'Отделение пластической хирургии'],
            [
                'description' => 'Хирургическая коррекция возрастных изменений лица и контуров тела с минимальным периодом реабилитации.'
            ]
        );
        foreach ([
            'Пластика лица и шеи',
            'Эстетическая блефаропластика',
            'Ринопластика и септопластика',
            'Маммопластика (увеличение, подтяжка, редукция)',
            'Абдоминопластика и липосакция',
        ] as $dirName) {
            DepartmentDirection::firstOrCreate(['department_id' => $plasticDept->id, 'name' => $dirName]);
        }

        $cosmetologyDept = Department::firstOrCreate(
            ['clinic_id' => $clinic->id, 'name' => 'Отделение врачебной косметологии'],
            [
                'description' => 'Современная аппаратная и инъекционная косметология экспертного уровня для естественного преображения.'
            ]
        );
        foreach ([
            'Инъекционное омоложение и контурная пластика',
            'Ботулинотерапия',
            'Аппаратный SMAS-лифтинг',
            'Лазерное омоложение и шлифовка кожи',
        ] as $dirName) {
            DepartmentDirection::firstOrCreate(['department_id' => $cosmetologyDept->id, 'name' => $dirName]);
        }

        $entDept = Department::firstOrCreate(
            ['clinic_id' => $clinic->id, 'name' => 'Отделение оториноларингологии'],
            [
                'description' => 'Диагностика и высокотехнологичное хирургическое лечение патологий ЛОР-органов.'
            ]
        );
        foreach ([
            'Эндоскопическая риносинусохирургия',
            'Септопластика и реконструкция носового дыхания',
            'Лазерная деструкция носовых раковин',
        ] as $dirName) {
            DepartmentDirection::firstOrCreate(['department_id' => $entDept->id, 'name' => $dirName]);
        }

        // ==========================================
        // 3. КОНТАКТЫ
        // ==========================================
        $contact = Contact::firstOrCreate(
            ['id' => 1],
            [
                'adress' => 'г. Челябинск, ул. Коммуны, 86',
                'sms' => '+7 (922) 750-45-16 (WhatsApp, Telegram)',
                'schedule' => 'Пн-Пт: 08:00 - 20:00, Сб: 09:00 - 18:00, Вс: выходной',
            ]
        );

        Phone::firstOrCreate(
            ['contact_id' => $contact->id, 'phone' => '+7 (351) 779-45-16'],
            ['description' => 'Единый справочный центр']
        );
        Phone::firstOrCreate(
            ['contact_id' => $contact->id, 'phone' => '+7 (922) 750-45-16'],
            ['description' => 'Запись на консультацию и WhatsApp']
        );

        Mail::firstOrCreate(
            ['contact_id' => $contact->id, 'mail' => 'info@art-medica.ru'],
            ['description' => 'Общие вопросы и предложения']
        );
        Mail::firstOrCreate(
            ['contact_id' => $contact->id, 'mail' => 'admin@art-medica.ru'],
            ['description' => 'Администрация клиники']
        );

        // ==========================================
        // 4. СПЕЦИАЛЬНОСТИ И ВРАЧИ
        // ==========================================
        $specSurgeon = Speciality::firstOrCreate(['name' => 'Пластический хирург']);
        $specCosmetologist = Speciality::firstOrCreate(['name' => 'Врач-косметолог']);
        $specDermatologist = Speciality::firstOrCreate(['name' => 'Дерматовенеролог']);
        $specEnt = Speciality::firstOrCreate(['name' => 'Оториноларинголог']);
        $specPhlebologist = Speciality::firstOrCreate(['name' => 'Хирург-флеболог']);
        $specGynecologist = Speciality::firstOrCreate(['name' => 'Акушер-гинеколог']);

        // Врач 1: Перевощиков Юрий Юрьевич
        $doctor1 = Specialist::firstOrCreate(
            ['lastname' => 'Перевощиков', 'name' => 'Юрий', 'middle_name' => 'Юрьевич'],
            [
                'description' => 'Заведующий отделением пластической хирургии клиники «Арт-Медика». Пластический хирург, кандидат медицинских наук. Действительный член Общества пластических, реконструктивных и эстетических хирургов России (ОПРЭХ). Автор более 30 научных публикаций.',
                'experience' => 24,
                'count_operations' => 3450,
                'percentage_reviews' => 99,
                'image' => 'specialists/01M4DJBXAVHJGKH8ZCNR2QS48V.png',
            ]
        );
        $doctor1->specialities()->syncWithoutDetaching([$specSurgeon->id]);
        foreach ([
            'Эстетическая и функциональная блефаропластика',
            'Комплексный SMAS-лифтинг лица и шеи',
            'Эндоскопическая подтяжка лба и бровей',
            'Риносептопластика любой сложности',
        ] as $dir) {
            Direction::firstOrCreate(['specialist_id' => $doctor1->id, 'name' => $dir]);
        }
        Education::firstOrCreate([
            'specialist_id' => $doctor1->id,
            'level' => 'Высшее образование',
            'organisation' => 'Челябинская государственная медицинская академия',
            'year_issue' => 2000,
            'qualification' => 'Лечебное дело, Врач'
        ]);
        Education::firstOrCreate([
            'specialist_id' => $doctor1->id,
            'level' => 'Ординатура',
            'organisation' => 'Уральская государственная медицинская академия дополнительного образования',
            'year_issue' => 2002,
            'qualification' => 'Хирургия'
        ]);
        Accreditation::firstOrCreate([
            'specialist_id' => $doctor1->id,
            'type_doc' => 'Периодическая аккредитация',
            'speciality' => 'Пластическая хирургия',
            'position' => 'Заведующий отделением, пластический хирург',
            'date_issue' => '2022-04-15',
            'validity_period' => '2027-04-15',
            'note' => 'Действующий сертификат специалиста'
        ]);

        // Врач 2: Морозова Елена Сергеевна
        $doctor2 = Specialist::firstOrCreate(
            ['lastname' => 'Морозова', 'name' => 'Елена', 'middle_name' => 'Сергеевна'],
            [
                'description' => 'Ведущий врач-косметолог, дерматовенеролог клиники «Арт-Медика». Сертифицированный эксперт по инъекционным методикам и лазерным технологиям омоложения кожи с опытом работы более 14 лет.',
                'experience' => 14,
                'count_operations' => 1800,
                'percentage_reviews' => 98,
                'image' => '/img/specialist-2.svg',
            ]
        );
        $doctor2->specialities()->syncWithoutDetaching([$specCosmetologist->id, $specDermatologist->id]);

        // Врач 3: Соколов Михаил Андреевич
        $doctor3 = Specialist::firstOrCreate(
            ['lastname' => 'Соколов', 'name' => 'Михаил', 'middle_name' => 'Андреевич'],
            [
                'description' => 'Пластический хирург, оториноларинголог. Эксперт по ринопластике, септопластике и отопластике. Регулярный участник международных конгрессов по эстетической медицине.',
                'experience' => 11,
                'count_operations' => 1200,
                'percentage_reviews' => 97,
                'image' => '/img/specialist-3.svg',
            ]
        );
        $doctor3->specialities()->syncWithoutDetaching([$specSurgeon->id, $specEnt->id]);

        // Врач 4: Григорьев Дмитрий Павлович
        $doctor4 = Specialist::firstOrCreate(
            ['lastname' => 'Григорьев', 'name' => 'Дмитрий', 'middle_name' => 'Павлович'],
            [
                'description' => 'Хирург-флеболог, сердечно-сосудистый хирург высшей категории. Эксперт по лазерному лечению варикоза (ЭВЛК) и минифлебэктомии.',
                'experience' => 16,
                'count_operations' => 2100,
                'percentage_reviews' => 99,
                'image' => '/img/specialist-4.svg',
            ]
        );
        $doctor4->specialities()->syncWithoutDetaching([$specPhlebologist->id]);

        // Врач 5: Василенко Ольга Игоревна
        $doctor5 = Specialist::firstOrCreate(
            ['lastname' => 'Василенко', 'name' => 'Ольга', 'middle_name' => 'Игоревна'],
            [
                'description' => 'Врач акушер-гинеколог высшей категории, специалист по эстетической гинекологии и малоинвазивной хирургии.',
                'experience' => 18,
                'count_operations' => 1650,
                'percentage_reviews' => 98,
                'image' => '/img/specialist-2.svg',
            ]
        );
        $doctor5->specialities()->syncWithoutDetaching([$specGynecologist->id]);

        // =========================================================================
        // 5. ИЕРАРХИЯ УСЛУГ (SectionAll -> Section -> Category -> Service)
        // =========================================================================

        $tree = [
            [
                'name' => 'Пластическая хирургия',
                'image' => 'categories/section-alls/01M727CK7YXJE4F3KTPYECCMES.png',
                'description' => 'Эстетические и реконструктивные операции для восстановления гармонии лица и контуров тела с минимальной травматичностью.',
                'sections' => [
                    [
                        'name' => 'Пластика лица',
                        'image' => 'categories/sections/01M727WVM6PHH0ZHFC2GPSJ92D.png',
                        'description' => 'Хирургическое омоложение век, носа, овала лица и шеи с сохранением индивидуальной мимики и естественности.',
                        'categories' => [
                            [
                                'name' => 'Блефаропластика',
                                'service' => [
                                    'name' => 'Блефаропластика',
                                    'description' => '<p>Блефаропластика — пластическая операция, которая позволяет изменить форму век и разрез глаз, вернуть лицу молодость и свежесть. Операция помогает устранить как эстетические, так и функциональные недостатки век.</p>',
                                    'preparation' => "Первое, что необходимо сделать – попасть на прием к грамотному и высококвалифицированному хирургу. Он определит план и назначит необходимые анализы, даст рекомендации по предоперационной подготовке. В среднем этот период составляет 1 неделю, и уже после готовности анализов назначается день операции.",
                                    'method' => "Операция выполняется под местным наркозом. Он имеет ряд преимуществ перед общим. От местного наркоза проще и легче отходить, он не несет тяжелых последствий в отличии от общего. Стоимость операции существенно дешевле. Существует миф, что операция под местным наркозом болезненна. Мы пользуемся исключительно качественными обезболивающими препаратами, которые сведут дискомфорт, боль к минимуму и Вы почувствуете только введение обезболивающего препарата.",
                                    'problems' => [
                                        'избыточная кожа в области верхних и нижних век',
                                        'жировые грыжи нижних век, так называемые «мешки» под глазами',
                                        'жировые грыжи верхних век',
                                        'синдром «усталого взгляда» («тяжелые» веки)',
                                        'опускание верхнего века',
                                        'изменение формы и разреза глаз',
                                    ],
                                    'types' => [
                                        [
                                            'description' => 'Верхняя блефаропластика – решение проблем излишков век, изменение разреза глаз.',
                                            'image' => 'services/types/01M72MJH9CWBN9R5N4TY5Z4QF9.png',
                                        ],
                                        [
                                            'description' => 'Нижняя трансконъюнктивальная блефаропластика – избавление от морщин, мешков под глазами.',
                                            'image' => 'services/types/01M72MJH9EZAY74A7S5HRYYMTX.jpg',
                                        ],
                                    ],
                                    'results' => [
                                        'services/results/01M72K636QD2ZN5FKECG0GC53H.png',
                                        'services/results/01M72K636RS8K4X0WHC2390EMT.png',
                                        'services/results/01M72KQPWPXGZ4XFTEMYY3CDEG.png',
                                        'services/results/01M72KQPWRGZ3EKRW049Y3HQ1Y.png',
                                        'services/results/01M72MJH9H9NXZZYG6R46T656H.png',
                                    ],
                                    'prices' => [
                                        ['code' => 'A16.26.012', 'code_mis' => 'MIS-0023', 'name' => 'Блефаропластика верхних век (изолированная)', 'duration' => '60', 'price' => 45000, 'cat1' => 45000, 'cat2' => 55000, 'cat3' => 65000],
                                        ['code' => 'A16.26.013', 'code_mis' => 'MIS-0024', 'name' => 'Трансконъюнктивальная блефаропластика нижних век', 'duration' => '75', 'price' => 50000, 'cat1' => 50000, 'cat2' => 62000, 'cat3' => 74000],
                                        ['code' => 'A16.26.014', 'code_mis' => 'MIS-0025', 'name' => 'Круговая блефаропластика (верхние и нижние веки)', 'duration' => '120', 'price' => 90000, 'cat1' => 90000, 'cat2' => 105000, 'cat3' => 125000],
                                    ],
                                    'specialists' => [$doctor1->id, $doctor3->id],
                                ]
                            ],
                            [
                                'name' => 'Ринопластика',
                                'service' => [
                                    'name' => 'Ринопластика',
                                    'description' => '<p>Ринопластика — хирургическая операция, направленная на исправление формы носа, устранение горбинки, сужение кончика и одновременное восстановление полноценного носового дыхания.</p>',
                                    'preparation' => "Консультация хирурга и ЛОР-врача, компьютерная томография придаточных пазух носа (КТ), стандартный комплекс госпитальных анализов и консультация анестезиолога.",
                                    'method' => "Операция проводится под общей анестезией с применением щадящих ультразвуковых методик (пьезоринопластика), что минимизирует отёки и исключает грубые костные сколы.",
                                    'problems' => [
                                        'горбинка на спинке носа',
                                        'искривление перегородки и затрудненное дыхание',
                                        'широкий или опущенный кончик носа',
                                        'посттравматическая деформация носа',
                                    ],
                                    'types' => [
                                        ['description' => 'Открытая риносептопластика с полной реконструкцией хрящевого каркаса.', 'image' => 'services/types/01M72K1HVG2A4GSVF5H4HR5MR8.png'],
                                        ['description' => 'Закрытая пластика кончика носа без наружных разрезов.', 'image' => 'services/types/01M72K1HVMSKQXC0JH8X7RM5S6.png'],
                                    ],
                                    'results' => [
                                        'services/results/01M72MPD0BEASGHQAQZ7WJE1V2.png',
                                        'services/results/01M72N8YMCWSMEFXKQ7XQ9EZ3A.png',
                                        'services/results/01M72N8YME6MED7XNXK804THTF.png',
                                    ],
                                    'prices' => [
                                        ['code' => 'A16.08.015', 'code_mis' => 'MIS-0030', 'name' => 'Эстетическая риносептопластика I категории', 'duration' => '120', 'price' => 180000, 'cat1' => 180000, 'cat2' => 210000, 'cat3' => 250000],
                                        ['code' => 'A16.08.016', 'code_mis' => 'MIS-0031', 'name' => 'Коррекция кончика носа (изолированная)', 'duration' => '90', 'price' => 110000, 'cat1' => 110000, 'cat2' => 130000, 'cat3' => 150000],
                                    ],
                                    'specialists' => [$doctor1->id, $doctor3->id],
                                ]
                            ],
                            [
                                'name' => 'Отопластика',
                                'service' => [
                                    'name' => 'Отопластика',
                                    'description' => '<p>Отопластика позволяет устранить лопоухость, скорректировать асимметрию и форму ушных раковин, а также восстановить мочку уха после травм.</p>',
                                    'preparation' => "Сдача стандартных анализов крови и осмотр хирурга. Рекомендуется прекратить прием препаратов, влияющих на свертываемость крови, за 7 дней до операции.",
                                    'method' => "Операция выполняется амбулаторно под местным обезболиванием. Шов прячется в складку за ухом и абсолютно незаметен для окружающих.",
                                    'problems' => [
                                        'лопоухость (выраженный угол отстояния ушной раковины)',
                                        'асимметрия ушей',
                                        'деформация мочки уха',
                                    ],
                                    'types' => [
                                        ['description' => 'Устранение лопоухости с формированием противозавитка.', 'image' => 'services/types/01M72MJH9FVKYJ1HJR2NNTYST0.jpg'],
                                    ],
                                    'results' => [
                                        'services/results/01M72N8YMGXHXCM7F2B0PAE9PF.jpg',
                                        'services/results/01M72N8YMHZFJZXHXSSV12BCZ6.jpg',
                                    ],
                                    'prices' => [
                                        ['code' => 'A16.25.007', 'code_mis' => 'MIS-0040', 'name' => 'Отопластика двухсторонняя (коррекция лопоухости)', 'duration' => '60', 'price' => 55000, 'cat1' => 55000, 'cat2' => 65000, 'cat3' => 75000],
                                    ],
                                    'specialists' => [$doctor3->id],
                                ]
                            ],
                            [
                                'name' => 'Фейслифтинг',
                                'service' => [
                                    'name' => 'Фейслифтинг (SMAS-подтяжка)',
                                    'description' => '<p>Глубокий SMAS-лифтинг лица и шеи возвращает четкий овал лица, устраняет брыли и глубокие носогубные складки, омолаживая внешность на 10–15 лет.</p>',
                                    'preparation' => "Комплексное клиническое обследование, ЭКГ, терапевтическое заключение и подробная консультация хирурга с фотопротоколом.",
                                    'method' => "Подтяжка затрагивает мышечно-апоневротический слой (SMAS), что гарантирует долговечный и естественный результат без эффекта «натянутой кожи».",
                                    'problems' => [
                                        'птоз тканей средней и нижней трети лица',
                                        'выраженные брыли и нечеткий угол челюсти',
                                        'дряблость кожи шеи («кольца Венеры»)',
                                    ],
                                    'types' => [
                                        ['description' => 'Круговой SMAS-лифтинг с платизмопластикой шеи.', 'image' => 'services/types/01M72N8YMBYC3ZRGC540WV6MHN.jpg'],
                                    ],
                                    'results' => [
                                        'services/results/01M72K636QD2ZN5FKECG0GC53H.png',
                                        'services/results/01M72MPD0BEASGHQAQZ7WJE1V2.png',
                                    ],
                                    'prices' => [
                                        ['code' => 'A16.01.020', 'code_mis' => 'MIS-0050', 'name' => 'SMAS-лифтинг лица и шеи', 'duration' => '180', 'price' => 260000, 'cat1' => 260000, 'cat2' => 310000, 'cat3' => 370000],
                                    ],
                                    'specialists' => [$doctor1->id],
                                ]
                            ],
                        ]
                    ],
                    [
                        'name' => 'Пластика тела',
                        'image' => 'categories/sections/01M727XGT35WRY90385CS90RAA.jpg',
                        'description' => 'Хирургическое моделирование гармоничных пропорций фигуры, плоского живота и красивой груди.',
                        'categories' => [
                            [
                                'name' => 'Маммопластика',
                                'service' => [
                                    'name' => 'Маммопластика (пластика груди)',
                                    'description' => '<p>Увеличение, подтяжка (мастопексия) и уменьшение молочных желез с использованием анатомических или круглых имплантов ведущих мировых производителей.</p>',
                                    'preparation' => "УЗИ молочных желез или маммография, консультация онколога-маммолога, стандартный список предоперационных анализов.",
                                    'method' => "Операция выполняется под эндотрахеальным наркозом. Подбор имплантов осуществляется на 3D-моделировании с учетом анатомии пациентки.",
                                    'problems' => [
                                        'недостаточный объем или асимметрия молочных желез',
                                        'птоз (опущение) груди после родов и кормления',
                                        'гипермастия (чрезмерно большой объем груди)',
                                    ],
                                    'types' => [
                                        ['description' => 'Эндопротезирование груди через субмаммарный или периареолярный доступ.', 'image' => 'services/types/01M72N8YM715Z8PWBBZVYEPCPA.jpg'],
                                        ['description' => 'Т-образная и циркулярная подтяжка груди без имплантов.', 'image' => 'services/types/01M72JXH30ZH3Y5C5M0KG0H9G9.jpg'],
                                    ],
                                    'results' => [
                                        'services/results/01M72KQPWPXGZ4XFTEMYY3CDEG.png',
                                        'services/results/01M72KQPWRGZ3EKRW049Y3HQ1Y.png',
                                    ],
                                    'prices' => [
                                        ['code' => 'A16.20.030', 'code_mis' => 'MIS-0060', 'name' => 'Увеличение груди имплантами (без стоимости имплантов)', 'duration' => '90', 'price' => 160000, 'cat1' => 160000, 'cat2' => 190000, 'cat3' => 220000],
                                        ['code' => 'A16.20.031', 'code_mis' => 'MIS-0061', 'name' => 'Мастопексия (подтяжка груди)', 'duration' => '120', 'price' => 140000, 'cat1' => 140000, 'cat2' => 165000, 'cat3' => 195000],
                                    ],
                                    'specialists' => [$doctor1->id],
                                ]
                            ],
                            [
                                'name' => 'Абдоминопластика',
                                'service' => [
                                    'name' => 'Абдоминопластика (пластика живота)',
                                    'description' => '<p>Операция по удалению кожно-жирового фартука, ушиванию диастаза прямых мышц живота и формированию тонкой талии.</p>',
                                    'preparation' => "УЗИ брюшной полости, консультация терапевта, ношение компрессионного бандажа после операции.",
                                    'method' => "Разрез располагается низко в зоне бикини, прячась под нижним бельем. Одновременно ушивается диастаз и переносится пупок.",
                                    'problems' => [
                                        'диастаз мышц живота после беременности',
                                        'избыток дряблой кожи и растяжек («кожный фартук»)',
                                        'послеоперационные рубцы в области живота',
                                    ],
                                    'types' => [
                                        ['description' => 'Классическая абдоминопластика с ушиванием диастаза и пластикой пупка.', 'image' => 'services/types/01M72MJH9CWBN9R5N4TY5Z4QF9.png'],
                                    ],
                                    'results' => [
                                        'services/results/01M72K636RS8K4X0WHC2390EMT.png',
                                    ],
                                    'prices' => [
                                        ['code' => 'A16.01.025', 'code_mis' => 'MIS-0070', 'name' => 'Абдоминопластика с ушиванием диастаза', 'duration' => '150', 'price' => 190000, 'cat1' => 190000, 'cat2' => 230000, 'cat3' => 270000],
                                    ],
                                    'specialists' => [$doctor1->id],
                                ]
                            ],
                            [
                                'name' => 'Липосакция',
                                'service' => [
                                    'name' => 'Липосакция проблемных зон',
                                    'description' => '<p>Удаление локальных жировых отложений в области живота, талии, бёдер, спины и подбородка с созданием красивого контура тела.</p>',
                                    'preparation' => "Анализы крови, консультация хирурга, подбор компрессионного белья.",
                                    'method' => "Применяются тонкие канюли через микропроколы до 3 мм, которые заживают без заметных шрамов.",
                                    'problems' => [
                                        'жировые ловушки на животе, боках и бёдрах',
                                        'второй подбородок',
                                    ],
                                    'types' => [
                                        ['description' => 'Липосакция одной зоны с контурированием силуэта.', 'image' => 'services/types/01M72MJH9EZAY74A7S5HRYYMTX.jpg'],
                                    ],
                                    'results' => [
                                        'services/results/01M72MPD0BEASGHQAQZ7WJE1V2.png',
                                    ],
                                    'prices' => [
                                        ['code' => 'A16.01.031', 'code_mis' => 'MIS-0080', 'name' => 'Липосакция 1 зоны (живот / бока / галифе)', 'duration' => '45', 'price' => 35000, 'cat1' => 35000, 'cat2' => 45000, 'cat3' => 55000],
                                    ],
                                    'specialists' => [$doctor1->id],
                                ]
                            ],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Косметология',
                'image' => 'categories/section-alls/01M727BC9H51DBE7T7SJ1YXNX6.jpg',
                'description' => 'Передовые инъекционные и аппаратные программы омоложения, коррекции несовершенств и поддержания здоровья кожи.',
                'sections' => [
                    [
                        'name' => 'Инъекционная косметология',
                        'image' => 'categories/sections/01M727WVM6PHH0ZHFC2GPSJ92D.png',
                        'description' => 'Контурная пластика филлерами, ботулинотерапия и глубокое увлажнение кожи гиалуроновой кислотой.',
                        'categories' => [
                            [
                                'name' => 'Контурная пластика',
                                'service' => [
                                    'name' => 'Контурная пластика филлерами',
                                    'description' => '<p>Коррекция формы и объема губ, скул, подбородка и носогубных складок препаратами на основе стабилизированной гиалуроновой кислоты высокой степени очистки.</p>',
                                    'preparation' => "Исключить прием алкоголя и аспирина за 2 дня до процедуры. Процедура проводится после демакияжа и нанесения анестезирующего крема.",
                                    'method' => "Введение филлера атравматичной канюлей или тончайшей иглой. Результат виден сразу после сеанса и сохраняется от 9 до 18 месяцев.",
                                    'problems' => [
                                        'тонкие губы или асимметрия формы',
                                        'выраженные носогубные складки',
                                        'недостаток объема в области скул и подбородка',
                                    ],
                                    'types' => [
                                        ['description' => 'Увеличение и увлажнение губ техникой «плоский бант».', 'image' => 'services/types/01M72K1HVG2A4GSVF5H4HR5MR8.png'],
                                        ['description' => 'Моделирование углов челюсти и подбородка (профиль Джоли).', 'image' => 'services/types/01M72K1HVMSKQXC0JH8X7RM5S6.png'],
                                    ],
                                    'results' => [
                                        'services/results/01M72N8YMCWSMEFXKQ7XQ9EZ3A.png',
                                        'services/results/01M72N8YME6MED7XNXK804THTF.png',
                                    ],
                                    'prices' => [
                                        ['code' => 'A11.01.012', 'code_mis' => 'MIS-0090', 'name' => 'Контурная пластика губ (Juvederm / Stylage 1.0 мл)', 'duration' => '45', 'price' => 19500, 'cat1' => 19500, 'cat2' => 22000, 'cat3' => 25000],
                                        ['code' => 'A11.01.013', 'code_mis' => 'MIS-0091', 'name' => 'Моделирование скул и овала лица (2.0 мл)', 'duration' => '60', 'price' => 36000, 'cat1' => 36000, 'cat2' => 40000, 'cat3' => 45000],
                                    ],
                                    'specialists' => [$doctor2->id],
                                ]
                            ],
                            [
                                'name' => 'Ботулинотерапия',
                                'service' => [
                                    'name' => 'Ботулинотерапия (Диспорт, Релатокс)',
                                    'description' => '<p>Быстрое и безопасное устранение мимических морщин лба, межбровья и зоны вокруг глаз с сохранением живой мимики.</p>',
                                    'preparation' => "Специальной подготовки не требуется. Не рекомендуется наклоняться и посещать сауну в первые 4 часа после процедуры.",
                                    'method' => "Микроинъекции сертифицированного ботулотоксина в гиперактивные мимические мышцы. Эффект наступает на 3–14 день.",
                                    'problems' => [
                                        'горизонтальные морщины на лбу',
                                        'глубокая межбровная складка («хмурый взгляд»)',
                                        '«гусиные лапки» в уголках глаз',
                                    ],
                                    'types' => [
                                        ['description' => 'Full Face ботулинотерапия для гармонизации всей мимики лица.', 'image' => 'services/types/01M72MJH9CWBN9R5N4TY5Z4QF9.png'],
                                    ],
                                    'results' => [
                                        'services/results/01M72K636QD2ZN5FKECG0GC53H.png',
                                    ],
                                    'prices' => [
                                        ['code' => 'A11.02.002', 'code_mis' => 'MIS-0100', 'name' => 'Инъекция ботулотоксина типа А (Релатокс 1 ед.)', 'duration' => '30', 'price' => 320, 'cat1' => 320, 'cat2' => 350, 'cat3' => 400],
                                        ['code' => 'A11.02.003', 'code_mis' => 'MIS-0101', 'name' => 'Коррекция зоны межбровья и лба под ключ', 'duration' => '40', 'price' => 12500, 'cat1' => 12500, 'cat2' => 14000, 'cat3' => 16000],
                                    ],
                                    'specialists' => [$doctor2->id],
                                ]
                            ],
                            [
                                'name' => 'Биоревитализация',
                                'service' => [
                                    'name' => 'Биоревитализация кожи',
                                    'description' => '<p>Глубокое восстановление водного баланса дермы, улучшение тонуса, цвета лица и эластичности кожи.</p>',
                                    'preparation' => "Очищение кожи, аппликационная анестезия кремом для полного комфорта.",
                                    'method' => "Папульное введение высокомолекулярной гиалуроновой кислоты с пептидами и аминокислотами.",
                                    'problems' => [
                                        'сухость, шелушение и обезвоженность кожи',
                                        'тусклый цвет лица и снижение тонуса',
                                        'мелкоморщинистый тип старения',
                                    ],
                                    'types' => [
                                        ['description' => 'Курсовая биоревитализация препаратами премиум-класса.', 'image' => 'services/types/01M72MJH9EZAY74A7S5HRYYMTX.jpg'],
                                    ],
                                    'results' => [
                                        'services/results/01M72N8YMCWSMEFXKQ7XQ9EZ3A.png',
                                    ],
                                    'prices' => [
                                        ['code' => 'A11.01.015', 'code_mis' => 'MIS-0110', 'name' => 'Биоревитализация лица и шеи (Novacutan / Profhilo)', 'duration' => '45', 'price' => 16500, 'cat1' => 16500, 'cat2' => 18500, 'cat3' => 21000],
                                    ],
                                    'specialists' => [$doctor2->id],
                                ]
                            ],
                        ]
                    ],
                    [
                        'name' => 'Аппаратная косметология',
                        'image' => 'categories/sections/01M727XGT35WRY90385CS90RAA.jpg',
                        'description' => 'Высокотехнологичный лифтинг и лазерное омоложение на аппаратах экспертного класса.',
                        'categories' => [
                            [
                                'name' => 'SMAS-лифтинг',
                                'service' => [
                                    'name' => 'Безоперационный SMAS-лифтинг (Ultraformer)',
                                    'description' => '<p>Сфокусированный ультразвук HIFU для безоперационной подтяжки связочного аппарата лица и устранения второго подбородка без периода реабилитации.</p>',
                                    'preparation' => "Консультация косметолога, оценка плотности SMAS-слоя.",
                                    'method' => "Аппаратное воздействие микросфокусированным ультразвуком на глубину до 4.5 мм. Результат нарастает в течение 2–3 месяцев.",
                                    'problems' => [
                                        'гравитационный птоз и поплывший овал лица',
                                        'второй подбородок',
                                        'малярные мешки на скулах',
                                    ],
                                    'types' => [
                                        ['description' => 'Протокол Ultraformer III Full Face (500 линий).', 'image' => 'services/types/01M72N8YMBYC3ZRGC540WV6MHN.jpg'],
                                    ],
                                    'results' => [
                                        'services/results/01M72MPD0BEASGHQAQZ7WJE1V2.png',
                                    ],
                                    'prices' => [
                                        ['code' => 'A17.01.008', 'code_mis' => 'MIS-0120', 'name' => 'SMAS-лифтинг Ultraformer (нижняя треть + подбородок)', 'duration' => '60', 'price' => 38000, 'cat1' => 38000, 'cat2' => 44000, 'cat3' => 50000],
                                    ],
                                    'specialists' => [$doctor2->id],
                                ]
                            ],
                            [
                                'name' => 'Лазерная шлифовка',
                                'service' => [
                                    'name' => 'Фракционная лазерная шлифовка кожи',
                                    'description' => '<p>Глубокое обновление текстуры кожи, удаление постакне, рубцов, сужение пор и разглаживание морщин эрбиевым лазером.</p>',
                                    'preparation' => "Отказ от загара за 2 недели до сеанса, профилактика герпеса.",
                                    'method' => "Фракционный микротермальный пилинг с охлаждением эпидермиса.",
                                    'problems' => [
                                        'рубцы постакне и неровный рельеф',
                                        'расширенные поры и фотостарение',
                                        'сетка морщин вокруг глаз и губ',
                                    ],
                                    'types' => [
                                        ['description' => 'Фракционный лазерный пилинг лица.', 'image' => 'services/types/01M72JXH30ZH3Y5C5M0KG0H9G9.jpg'],
                                    ],
                                    'results' => [
                                        'services/results/01M72K636RS8K4X0WHC2390EMT.png',
                                    ],
                                    'prices' => [
                                        ['code' => 'A22.01.002', 'code_mis' => 'MIS-0130', 'name' => 'Лазерная шлифовка лица (фракционный CO2 / Er:YAG)', 'duration' => '75', 'price' => 22000, 'cat1' => 22000, 'cat2' => 26000, 'cat3' => 30000],
                                    ],
                                    'specialists' => [$doctor2->id],
                                ]
                            ],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Оториноларингология',
                'image' => 'categories/section-alls/01M727HP6ESS0Z6ZGYDT7F4MSG.jpg',
                'description' => 'Диагностика и хирургическое лечение ЛОР-заболеваний на передовом эндоскопическом оборудовании.',
                'sections' => [
                    [
                        'name' => 'Хирургия ЛОР-органов',
                        'image' => 'categories/sections/01M727WVM6PHH0ZHFC2GPSJ92D.png',
                        'description' => 'Малоинвазивные операции для восстановления свободного дыхания и лечения храпа.',
                        'categories' => [
                            [
                                'name' => 'Септопластика',
                                'service' => [
                                    'name' => 'Эндоскопическая септопластика',
                                    'description' => '<p>Хирургическое выпрямление искривленной носовой перегородки для полного восстановления естественного носового дыхания без изменения внешней формы носа.</p>',
                                    'preparation' => "КТ носа и околоносовых пазух, стандартный госпитальный комплекс анализов.",
                                    'method' => "Эндоскопическая малотравматичная методика с установкой современных силиконовых сплинтов вместо марлевых тампонов (дыхание сохраняется сразу после операции).",
                                    'problems' => [
                                        'хроническая заложенность носа и зависимость от капель',
                                        'храп и синдром обструктивного апноэ сна',
                                        'частые синуситы и гаймориты',
                                    ],
                                    'types' => [
                                        ['description' => 'Эндоскопическая септопластика с лазерной вазотомией носовых раковин.', 'image' => 'services/types/01M72K1HVG2A4GSVF5H4HR5MR8.png'],
                                    ],
                                    'results' => [
                                        'services/results/01M72MPD0BEASGHQAQZ7WJE1V2.png',
                                    ],
                                    'prices' => [
                                        ['code' => 'A16.08.013', 'code_mis' => 'MIS-0140', 'name' => 'Септопластика эндоскопическая', 'duration' => '60', 'price' => 65000, 'cat1' => 65000, 'cat2' => 78000, 'cat3' => 90000],
                                    ],
                                    'specialists' => [$doctor3->id],
                                ]
                            ],
                            [
                                'name' => 'Вазотомия',
                                'service' => [
                                    'name' => 'Подслизистая вазотомия носовых раковин',
                                    'description' => '<p>Избавление от медикаментозного ринита и зависимости от сосудосуживающих капель за одну 20-минутную процедуру.</p>',
                                    'preparation' => "Осмотр оториноларинголога с эндоскопией полости носа.",
                                    'method' => "Радиоволновая или лазерная коагуляция гипертрофированных сосудов носовых раковин под местной анестезией.",
                                    'problems' => [
                                        'постоянная заложенность носа',
                                        'многолетнее привыкание к каплям (нафтизин, снуп)',
                                    ],
                                    'types' => [
                                        ['description' => 'Радиоволновая вазотомия носовых раковин.', 'image' => 'services/types/01M72MJH9CWBN9R5N4TY5Z4QF9.png'],
                                    ],
                                    'results' => [
                                        'services/results/01M72K636QD2ZN5FKECG0GC53H.png',
                                    ],
                                    'prices' => [
                                        ['code' => 'A16.08.018', 'code_mis' => 'MIS-0150', 'name' => 'Радиоволновая вазотомия нижних носовых раковин', 'duration' => '30', 'price' => 22000, 'cat1' => 22000, 'cat2' => 26000, 'cat3' => 30000],
                                    ],
                                    'specialists' => [$doctor3->id],
                                ]
                            ],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Флебология',
                'image' => 'categories/section-alls/01M727JB9BS5JTM59D1E14EHRT.jpeg',
                'description' => 'Современное лазерное лечение варикозной болезни без разрезов, наркоза и госпитализации.',
                'sections' => [
                    [
                        'name' => 'Лазерная флебология',
                        'image' => 'categories/sections/01M7285163NXQGMDG16W0EW4DF.png',
                        'description' => 'ЭВЛК радиальным световодом и склеротерапия сосудистых сеточек.',
                        'categories' => [
                            [
                                'name' => 'ЭВЛК вен',
                                'service' => [
                                    'name' => 'Эндовазальная лазерная коагуляция вен (ЭВЛК)',
                                    'description' => '<p>Золотой стандарт лечения варикоза вен нижних конечностей. Процедура проводится через один прокол под контролем УЗИ без швов и следов.</p>',
                                    'preparation' => "Ультразвуковое дуплексное сканирование (УЗДС) вен нижних конечностей и консультация флеболога.",
                                    'method' => "Лазерный радиальный световод бережно «заваривает» несостоятельную вену изнутри. Пациент уходит домой пешком через 30 минут.",
                                    'problems' => [
                                        'варикозные узлы и выступающие вены на ногах',
                                        'тяжесть, отёки и боли в ногах к концу дня',
                                        'ночные судороги в икроножных мышцах',
                                    ],
                                    'types' => [
                                        ['description' => 'ЭВЛК одной категории сложности на одной конечности.', 'image' => 'services/types/01M72N8YM715Z8PWBBZVYEPCPA.jpg'],
                                    ],
                                    'results' => [
                                        'services/results/01M72MPD0BEASGHQAQZ7WJE1V2.png',
                                    ],
                                    'prices' => [
                                        ['code' => 'A16.12.041', 'code_mis' => 'MIS-0160', 'name' => 'ЭВЛК ствола БПВ/МПВ на одной ноге (1 категория)', 'duration' => '45', 'price' => 45000, 'cat1' => 45000, 'cat2' => 54000, 'cat3' => 65000],
                                    ],
                                    'specialists' => [$doctor4->id],
                                ]
                            ],
                            [
                                'name' => 'Склеротерапия',
                                'service' => [
                                    'name' => 'Микросклеротерапия сосудистых «звездочек»',
                                    'description' => '<p>Безоперационное удаление сосудистой сетки и ретикулярных вен на ногах инъекционным введением склерозанта.</p>',
                                    'preparation' => "Осмотр флеболога, приобретение компрессионных чулок 1–2 класса.",
                                    'method' => "Тончайшей иглой препарат вводится в сосудистые звездочки, вызывая их бесследное склеивание.",
                                    'problems' => [
                                        'сосудистые звездочки и сеточки (телеангиэктазии)',
                                        'ретикулярные вены синего цвета',
                                    ],
                                    'types' => [
                                        ['description' => 'Пенная Foam-form склеротерапия.', 'image' => 'services/types/01M72MJH9CWBN9R5N4TY5Z4QF9.png'],
                                    ],
                                    'results' => [
                                        'services/results/01M72K636RS8K4X0WHC2390EMT.png',
                                    ],
                                    'prices' => [
                                        ['code' => 'A11.12.001', 'code_mis' => 'MIS-0170', 'name' => 'Склеротерапия 1 зоны (бедро / голень)', 'duration' => '30', 'price' => 12000, 'cat1' => 12000, 'cat2' => 14000, 'cat3' => 16000],
                                    ],
                                    'specialists' => [$doctor4->id],
                                ]
                            ],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Гинекология',
                'image' => 'categories/section-alls/01M727CK7YXJE4F3KTPYECCMES.png',
                'description' => 'Деликатная эстетическая и оперативная гинекология для женского здоровья и уверенности.',
                'sections' => [
                    [
                        'name' => 'Эстетическая гинекология',
                        'image' => 'categories/sections/01M727WVM6PHH0ZHFC2GPSJ92D.png',
                        'description' => 'Интимное омоложение, лабиопластика и коррекция интимной зоны.',
                        'categories' => [
                            [
                                'name' => 'Лабиопластика',
                                'service' => [
                                    'name' => 'Лабиопластика (пластика половых губ)',
                                    'description' => '<p>Хирургическая коррекция размера и формы малых или больших половых губ для устранения физического дискомфорта и достижения эстетической гармонии.</p>',
                                    'preparation' => "Мазок на флору, онкоцитология, анализ крови, консультация оперирующего гинеколога.",
                                    'method' => "Операция выполняется под местной или общей анестезией радиоволновым скальпелем с наложением саморассасывающихся швов.",
                                    'problems' => [
                                        'гипертрофия или выраженная асимметрия половых губ',
                                        'дискомфорт при ношении облегающего белья и занятиях спортом',
                                        'эстетическая неудовлетворенность видом интимной зоны',
                                    ],
                                    'types' => [
                                        ['description' => 'Линейная и W-образная резекция малых половых губ.', 'image' => 'services/types/01M72MJH9EZAY74A7S5HRYYMTX.jpg'],
                                    ],
                                    'results' => [
                                        'services/results/01M72KQPWPXGZ4XFTEMYY3CDEG.png',
                                    ],
                                    'prices' => [
                                        ['code' => 'A16.20.021', 'code_mis' => 'MIS-0180', 'name' => 'Пластика малых половых губ (двухсторонняя)', 'duration' => '60', 'price' => 50000, 'cat1' => 50000, 'cat2' => 60000, 'cat3' => 70000],
                                    ],
                                    'specialists' => [$doctor5->id, $doctor1->id],
                                ]
                            ],
                        ]
                    ],
                ]
            ],
        ];

        foreach ($tree as $itemAll) {
            $sectionAll = ServiceCategorySectionAll::firstOrCreate(
                ['name' => $itemAll['name']],
                [
                    'image' => $itemAll['image'],
                    'description' => $itemAll['description'],
                ]
            );

            foreach ($itemAll['sections'] as $itemSec) {
                $section = ServiceCategorySection::firstOrCreate(
                    [
                        'section_all_id' => $sectionAll->id,
                        'name' => $itemSec['name'],
                    ],
                    [
                        'image' => $itemSec['image'],
                        'description' => $itemSec['description'],
                    ]
                );

                foreach ($itemSec['categories'] as $itemCat) {
                    $category = ServiceCategory::firstOrCreate([
                        'section_id' => $section->id,
                        'name' => $itemCat['name'],
                    ]);

                    if (!empty($itemCat['service'])) {
                        $sData = $itemCat['service'];
                        $service = Service::firstOrCreate(
                            [
                                'category_id' => $category->id,
                                'name' => $sData['name'],
                            ],
                            [
                                'description' => $sData['description'],
                                'preparation' => $sData['preparation'],
                                'method' => $sData['method'],
                            ]
                        );

                        // Проблемы
                        if (!empty($sData['problems'])) {
                            foreach ($sData['problems'] as $problem) {
                                ServiceProblem::firstOrCreate([
                                    'service_id' => $service->id,
                                    'name' => $problem,
                                ]);
                            }
                        }

                        // Виды
                        if (!empty($sData['types'])) {
                            foreach ($sData['types'] as $type) {
                                ServiceType::firstOrCreate(
                                    [
                                        'service_id' => $service->id,
                                        'description' => $type['description'],
                                    ],
                                    [
                                        'image' => $type['image'],
                                    ]
                                );
                            }
                        }

                        // Результаты
                        if (!empty($sData['results'])) {
                            foreach ($sData['results'] as $resImg) {
                                ServiceResult::firstOrCreate([
                                    'service_id' => $service->id,
                                    'image' => $resImg,
                                ]);
                            }
                        }

                        // Прайс
                        if (!empty($sData['prices'])) {
                            foreach ($sData['prices'] as $priceItem) {
                                ServicePrice::firstOrCreate(
                                    [
                                        'service_id' => $service->id,
                                        'code' => $priceItem['code'],
                                    ],
                                    [
                                        'code_mis' => $priceItem['code_mis'],
                                        'name' => $priceItem['name'],
                                        'duration' => $priceItem['duration'],
                                        'price' => $priceItem['price'],
                                        'price_category_1' => $priceItem['cat1'],
                                        'price_category_2' => $priceItem['cat2'],
                                        'price_category_3' => $priceItem['cat3'],
                                    ]
                                );
                            }
                        }

                        // Врачи
                        if (!empty($sData['specialists'])) {
                            $service->specialists()->syncWithoutDetaching($sData['specialists']);
                        }
                    }
                }
            }
        }

        // ==========================================
        // 6. ДОКУМЕНТЫ
        // ==========================================
        $docType1 = DocumentType::firstOrCreate(['name' => 'Лицензии и сертификаты']);
        $docType2 = DocumentType::firstOrCreate(['name' => 'Нормативно-правовая база']);
        $docType3 = DocumentType::firstOrCreate(['name' => 'Правила клиники и документы для пациентов']);

        Document::firstOrCreate(
            ['document_type_id' => $docType1->id, 'name' => 'Лицензия на осуществление медицинской деятельности ЛО-74-01-005612'],
            ['document' => 'documents/01M4AY8DYR687VK9CJ89DX5CAF.pdf']
        );
        Document::firstOrCreate(
            ['document_type_id' => $docType1->id, 'name' => 'Санитарно-эпидемиологическое заключение'],
            ['document' => 'documents/01M4AY8DYR687VK9CJ89DX5CAF.pdf']
        );
        Document::firstOrCreate(
            ['document_type_id' => $docType2->id, 'name' => 'Выписка из Единого государственного реестра юридических лиц (ЕГРЮЛ)'],
            ['document' => 'documents/01M4AY8DYR687VK9CJ89DX5CAF.pdf']
        );
        Document::firstOrCreate(
            ['document_type_id' => $docType3->id, 'name' => 'Правила внутреннего распорядка для потребителей медицинских услуг'],
            ['document' => 'documents/01M4AY8DYR687VK9CJ89DX5CAF.pdf']
        );

        // ==========================================
        // 7. ВОПРОСЫ И ОТВЕТЫ
        // ==========================================
        $qaList = [
            [
                'question' => 'Как проходит первая консультация у пластического хирурга?',
                'answer' => 'На консультации доктор внимательно выслушивает ваши пожелания, проводит анатомический осмотр, оценивает состояние тканей и подбирает оптимальный метод коррекции. Вы также получите подробный список предоперационных анализов и персональный план реабилитации.'
            ],
            [
                'question' => 'Сколько длится реабилитационный период после блефаропластики?',
                'answer' => 'Первичный период реабилитации занимает 7–10 дней. К этому моменту полностью сходят синяки и основные отёки, снимаются швы. Возвращаться к привычному ритму жизни и выходить на работу можно уже на 8–10 день.'
            ],
            [
                'question' => 'Остаются ли заметные рубцы после операции на веках?',
                'answer' => 'При верхней блефаропластике тончайший шов прячется в естественную складку верхнего века и со временем становится совершенно невидимым. При трансконъюнктивальной нижней блефаропластике разрез делается с внутренней стороны века, поэтому наружных рубцов не остаётся вовсе.'
            ],
            [
                'question' => 'Возможна ли операция под местным обезболиванием?',
                'answer' => 'Да, блефаропластика великолепно переносится под современной местной анестезией. Пациент не испытывает боли или неприятных ощущений, при этом полностью исключаются нагрузка на организм и последствия общего наркоза.'
            ],
            [
                'question' => 'Какие анализы необходимо сдать перед операцией?',
                'answer' => 'Стандартный госпитальный комплекс включает: общий и биохимический анализ крови, коагулограмму, тесты на ВИЧ, гепатиты B и C, сифилис, ЭКГ с расшифровкой и флюорографию. Срок действия большинства анализов составляет 10–14 дней.'
            ],
        ];
        foreach ($qaList as $qa) {
            QuestionAnswer::firstOrCreate(['question' => $qa['question']], ['answer' => $qa['answer']]);
        }

        // ==========================================
        // 8. ОТЗЫВЫ
        // ==========================================
        $reviews = [
            [
                'first_name' => 'Екатерина',
                'middle_name' => 'Владимировна',
                'last_name' => 'М.',
                'rating' => 5,
                'desc_story' => 'Долго не могла решиться на блефаропластику, сильно мешали нависшие веки и уставший вид по утрам. Знакомые порекомендовали Юрия Юрьевича Перевощикова как первоклассного специалиста.',
                'desc_like' => 'Операция прошла под местной анестезией абсолютно безболезненно и очень спокойно. Результат превзошел все ожидания — открытый, молодой и свежий взгляд! Огромное спасибо всему персоналу клиники «Арт-Медика».',
                'date' => '2026-10-18',
            ],
            [
                'first_name' => 'Ольга',
                'middle_name' => 'Николаевна',
                'last_name' => 'С.',
                'rating' => 5,
                'desc_story' => 'Обратилась в клинику по рекомендации подруги для коррекции возрастных изменений нижних век («мешки» под глазами).',
                'desc_like' => 'Очень заботливое отношение, стерильная чистота, современные палаты и золотые руки хирурга. Реабилитация заняла всего неделю, синяков практически не было. Рекомендую клинику от всей души!',
                'date' => '2026-10-04',
            ],
            [
                'first_name' => 'Наталья',
                'middle_name' => 'Александровна',
                'last_name' => 'В.',
                'rating' => 5,
                'desc_story' => 'Проходила комплекс омоложения в отделении косметологии и хирургии клиники «Арт-Медика».',
                'desc_like' => 'Честный и деликатный подход без навязывания лишних процедур. Доктор подробно расписал все этапы и ответил на каждый мой вопрос. Чувствую себя на 10 лет моложе!',
                'date' => '2026-09-21',
            ],
        ];
        foreach ($reviews as $rev) {
            Review::firstOrCreate(['first_name' => $rev['first_name'], 'date' => $rev['date']], $rev);
        }

        // ==========================================
        // 9. НОВОСТИ
        // ==========================================
        $uncos = [
            [
                'title' => 'Инновационные методики омоложения взгляда в клинике «Арт-Медика»',
                'data' => '2026-11-01',
                'image' => 'news/01M4AX42XVCQC63P89P1XB1GYR.jpg',
                'description' => '<p>Специалисты клиники «Арт-Медика» внедрили усовершенствованный протокол малоинвазивной блефаропластики, сокращающий время первичной реабилитации пациентов до рекордных 5–7 дней.</p><p>Применение микрохирургических инструментов и щадящей местной анестезии обеспечивает естественный эстетический результат без видимых следов вмешательства.</p>',
            ],
            [
                'title' => 'Наши хирурги на национальном конгрессе пластической хирургии',
                'data' => '2026-10-15',
                'image' => 'news/01M4E5SKCJ98TMXHM4N05D2FDV.jpg',
                'description' => '<p>Заведующий отделением пластической хирургии Юрий Юрьевич Перевощиков выступил с докладом на XIV Национальном конгрессе с международным участием, представив опыт клиники по комбинированным вмешательствам на лице.</p>',
            ],
            [
                'title' => 'Расширение стационара повышенной комфортности',
                'data' => '2026-09-28',
                'image' => 'news/01M4EA1ZTGEZM5KMGB31K94W1X.png',
                'description' => '<p>Мы открыли новые индивидуальные палаты дневного и круглосуточного стационара, оборудованные системами климат-контроля и круглосуточным сестринским наблюдением для максимального комфорта наших пациентов.</p>',
            ],
        ];
        foreach ($uncos as $unco) {
            Unco::firstOrCreate(['title' => $unco['title']], $unco);
        }

        // ==========================================
        // 10. ПРОЕКТЫ
        // ==========================================
        $project = Project::firstOrCreate(
            ['name' => 'Красота без возраста: Преображение'],
            [
                'short_desc' => 'Социально-просветительский проект о гармонии, здоровье и возможностях современной медицины.',
                'description' => "Проект объединил ведущих хирургов, косметологов и экспертов клиники «Арт-Медика», чтобы показать: сохранение естественной красоты и молодости доступно каждому.\n\nМы делимся открытыми историями преображения, разбираем актуальные мифы об эстетической хирургии и демонстрируем реальные результаты работы врачей высокой квалификации.",
                'date' => '2026-10-10',
                'count_season' => 3,
                'count_members' => 48,
                'count_expert' => 12,
                'count_parterns' => 8,
            ]
        );

        Image::firstOrCreate([
            'project_id' => $project->id,
            'image' => 'categories/sections/01M727XGT35WRY90385CS90RAA.jpg',
        ]);

        FormatWork::firstOrCreate(
            ['project_id' => $project->id, 'name' => 'Индивидуальные консультации'],
            [
                'description' => 'Персональный разбор клинических случаев с моделированием будущего результата.',
                'image' => 'categories/sections/01M727WVM6PHH0ZHFC2GPSJ92D.png',
            ]
        );

        FormatWork::firstOrCreate(
            ['project_id' => $project->id, 'name' => 'Комплексные программы реабилитации'],
            [
                'description' => 'Аппаратное и терапевтическое ведение пациентов после пластических операций.',
                'image' => 'categories/section-alls/01M727CK7YXJE4F3KTPYECCMES.png',
            ]
        );

        ProjectStages::firstOrCreate([
            'project_id' => $project->id,
            'name' => 'Диагностика и 3D-моделирование желаемого результата',
        ]);
        ProjectStages::firstOrCreate([
            'project_id' => $project->id,
            'name' => 'Предоперационная подготовка и чек-ап организма',
        ]);
        ProjectStages::firstOrCreate([
            'project_id' => $project->id,
            'name' => 'Хирургический этап с применением микрохирургии',
        ]);
        ProjectStages::firstOrCreate([
            'project_id' => $project->id,
            'name' => 'Бережная реабилитация и контрольные осмотры',
        ]);

        Parten::firstOrCreate(
            ['project_id' => $project->id, 'name' => 'Общество пластических хирургов России (ОПРЭХ)'],
            ['description' => 'Профессиональное партнерство']
        );
        Parten::firstOrCreate(
            ['project_id' => $project->id, 'name' => 'Инвитро Эксперт'],
            ['description' => 'Лабораторная диагностика']
        );

        // --- АКЦИИ (из макета) ---
        $promo1 = Promotion::firstOrCreate(
            ['name' => 'Нитевой лифтинг "Лепесток" скидка 50%'],
            [
                'description' => '<p>Освежить лицо, подчеркнуть красоту и вернуть коже упругость. Уникальная авторская методика "Лепесток" позволяет эффективно подтянуть среднюю и нижнюю треть лица без длительной реабилитации.</p>',
                'date' => '2025-04-07',
                'image' => 'promotions/promo1.jpg',
            ]
        );
        $blefaroService = Service::where('name', 'like', '%блефаропластика%')->first();
        if ($blefaroService) {
            $promo1->services()->syncWithoutDetaching([$blefaroService->id]);
        }

        $promo2 = Promotion::firstOrCreate(
            ['name' => 'PURE MOLECULE - инновационная технология омоложения'],
            [
                'description' => '<p>МОЛЕКУЛА - программа комплексного омоложения организма, уникальная разработка европейских врачей-косметологов. Стимулирует выработку собственного коллагена и естественную регенерацию.</p>',
                'date' => '2025-04-07',
                'image' => 'promotions/promo2.jpg',
            ]
        );
        $smasService = Service::where('name', 'like', '%SMAS%')->first();
        if ($smasService) {
            $promo2->services()->syncWithoutDetaching([$smasService->id]);
        }
    }
}
