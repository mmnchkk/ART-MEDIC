<p align="center">
  <img src="public/img/logo.svg" alt="ART-MEDIC Logo" width="300" style="filter: brightness(0) invert(1);">
</p>

<h1 align="center">Арт-Медика</h1>

## 🚀 Инструкция по первому запуску

Следуйте этим шагам, чтобы развернуть проект на локальной машине с нуля.

### 1. Установка зависимостей и настройка окружения
Откройте терминал в папке с проектом и выполните:
```bash
composer install
cp .env.example .env
```

### 2. Настройка базы данных
Откройте созданный файл `.env`, найдите секцию с настройками базы данных, раскомментируйте эти строчки (если нужно) и пропишите следующие данные:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=MEDICAL
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Генерация ключа и миграции
Возвращайтесь в терминал и выполните команды по очереди:
```bash
php artisan key:generate
php artisan migrate
```
*(Не забудьте также сделать `php artisan storage:link`, чтобы картинки корректно отображались на сайте).*

### 4. Создание администратора
Чтобы создать аккаунт администратора, зайдите в консоль Laravel (Tinker):
```bash
php artisan tinker
```
И вставьте туда этот код:
```php
$user = App\Models\User::create([ 'name' => 'Admin', 'email' => 'admin@test.ru', 'password' => bcrypt('password'), ]);
```
После создания напишите `exit`, чтобы выйти из Tinker.

### 5. Запуск серверов
В том же терминале запустите сервер Laravel:
```bash
php artisan serve
```

**ОТКРЫВАЕМ НОВЫЙ ТЕРМИНАЛ** (не закрывая первый!) и пишем туда:
```bash
npm i
npm run dev
```

🎉 **Готово!** Ваш сайт доступен по адресу: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 📁 Структура основных разделов

- `app/Http/Controllers/` — Контроллеры логики (например, `UncoController` для новостей).
- `resources/views/` — Файлы шаблонов Blade (`unco.blade.php`, `unco_show.blade.php` и др).
- `resources/css/` — Таблицы стилей проекта, подключаемые через Vite.
- `public/storage/` — Директория с пользовательскими изображениями и документами.

---

## 💡 Особенности разработки
- Проект использует **Mobile-First / Responsive** подход. Все стили прописаны с использованием медиа-запросов (media queries).
- Изображения, загружаемые через админку (или сиды), сохраняются в директорию `storage/app/public` и выводятся с использованием `asset('storage/...')`. Если картинка отсутствует, настроен автоматический `onerror` fallback.
