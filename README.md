## Оглавление

1. [Обзор](#обзор)
2. [Архитектура](#архитектура)
   - [Основные модули](#основные-модули)
   - [Docker-контейнеры](#docker-контейнеры)
3. [Требования](#требования)
4. [Быстрый старт](#быстрый-старт)
   - [Подготовка окружения](#подготовка-окружения-для-локальной-разработки)
   - [Сборка фронтенда](#сборка-фронтенда)
5. [Разработка и поддержка](#разработка-и-поддержка)
   - [API и документация Swagger](#api-и-документация-swagger)
   - [Генерация фейковых данных](#генерация-фейковых-данных)
   - [Создание администратора](#создание-администратора)
   - [Очистка кеша роутинга](#очистка-кэша-роутинга)
6. [Отладка и администрирование](#отладка-и-администрирование)
   - [Работа с правами администратора](#работа-с-правами-администратора)
   - [Конфигурация Xdebug](#конфигурация-xdebug-для-локальной-разработки)
7. [Качество кода](#качество-кода)
8. [Обновление справочников](#ручное-обновление-справочников)

---

## Обзор

Vika — модульная экосистема на Laravel 12 и Vue 3, где каждый государственный сервис изолирован в собственный
виджет-модуль (`Modules/*`). Такой подход позволяет независимым командам развивать SPA и API параллельно, а конечному
пользователю собирать нужные сценарии в одном интерфейсе.

- Web: https://vi.admhmao.ru/
- MAX-бот: https://max.ru/ugra_vika_bot
- OpenAPI: https://vi.admhmao.ru/api/documentation/

---

## Архитектура

### Основные модули

#### Чат-бот `Modules/Chat`

- Хранит историю диалогов пользователей
- Принимает новые сообщения и передаёт их в обработку
- Поддерживает Web, Telegram и MAX
- Распознавание интентов и формирование текстов выполняются через интеграцию с Tolya/Gigachat: модуль отправляет
  обезличенные обращения, получает ответы нейросети и подставляет релевантные кнопки и фильтры, сохраняя историю
  распознанных намерений

#### Админ-панель `Modules/Admin`

- SPA
- Аутентификация пользователей
- Управление пользователями, ролями в системе
- Управление виджетами
- Управление LLM, дообучение модели, тестирование
- Статистика использования виджетов, интентов
- Просмотр истории диалогов
- Управление актировками

#### Vika `Modules/Vika`

- Основной SPA проекта
- Роутер делит приложение на два режима: web-чат и виджет-приложение.
- Панель виджетов формируется динамически
- Позволяет по ссылке открыть нужный виджет, предзаполнив данные пользователя
- Содержит front-end всех виджетов
- Определяет нужный тип VIки и, при необходимости, прокидывает настройки чата/виджетов, благодаря чему мини-приложение
  само адаптируется к сайту-носителю

#### Vika Launcher `Modules/VikaLauncher`

- JS-загрузчик для встраивания на сторонние сайты
- Рисует мини-кнопку с циклической анимацией иконок виджетов
- При клике на кнопку разворачивается в окно с чатом Vika

#### Виджеты `Modules/*Widget`

- В каталоге Modules/ каждый виджет оформлен как отдельный пакет, чьё имя заканчивается на Widget
- Повторяет базовую структуру Laravel проекта

### Docker-контейнеры

- `nginx` — отдача статики и общий веб-прокси.
- `php-fpm` — основной бэкенд.
- `reverb` — websocket-сервер.
- `horizon` — управление очередями.
- `schedule` — задания по расписанию.
- `vikasearch` — интеграция с LLM.
- `vikasearch-db` — база данных интентов (pgvector).

---

## Требования

- [Node.js & npm](https://nodejs.org/en/download)
- [Docker & Docker Compose](https://docs.docker.com/compose/install/)
- Консольная утилита `make` (для локальной разработки)

---

## Быстрый старт

> Все `php artisan` и `vendor/bin/*` команды выполняйте через контейнер, например:
> `docker compose exec php-fpm php artisan migrate`.

### Подготовка окружения для локальной разработки

В корне проекта выполните:

```bash
make install
```

Команда подтянет зависимости Composer, подготовит `.env` и соберёт контейнеры.
Необходимо задать env переменные, в соответствии с их описанием.
> Внимание! Команду выполнять один раз, т.к. она сбрасывает конфигурацию до первоначальной

### Создание администратора

Запустите Tinker:

```bash
docker compose exec php-fpm php artisan tinker
```

Затем выполните:

```php
$user = \Modules\Admin\Models\User::create([
    'name'     => 'name',
    'email'    => 'email@example.ru',
    'password' => \Illuminate\Support\Facades\Hash::make('password'),
]);

$user->assignRole('superuser');

$user->person()->create([
    'last_name'   => 'Админов',
    'first_name'  => 'Админ',
    'middle_name' => 'Админович',
]);
```

### Сборка фронтенда

1. Основные модули (Vika, Admin):

   ```bash
   npm i
   # Для production сборки
   npm run build
   # Для разработки
   npm run dev
   ```

2. Модуль VikaLauncher:

   ```bash
   cd Modules/VikaLauncher
   npm i
   npm run build
   ```

---

## Разработка и поддержка

### API и документация Swagger

Используется Code-First подход для генерации API на основе PHP аннотаций. Сгенерируйте спецификацию и откройте Swagger
UI:

```bash
make swagger
```

Интерфейс будет доступен по адресу http://vi.local/api/documentation.

### Генерация фейковых данных

#### Актировки
```bash
docker compose exec php-fpm php artisan generate:fake-actirovki
```

Команда создаст тестовый набор актировок для локальной отладки.

### Очистка кэша роутинга

Если маршруты не обновляются, последовательно выполните:

```bash
make php-fpm
rm ./bootstrap/cache/*.php
docker compose exec php-fpm php artisan module:composer-update -a
docker compose exec php-fpm php artisan route:list
```

---

## Отладка и администрирование

### Работа с правами администратора

> Новые permissions добавляются **только** через сидер.

1. Отредактируйте `Modules/Admin/database/seeders/PermissionsAndAdminRoleTableSeeder.php`.
2. Добавьте нужные права в массив сидера.
3. Примените изменения:

   ```bash
   docker compose exec php-fpm php artisan db:seed --class=\Modules\Admin\Database\Seeders\PermissionsAndAdminRoleTableSeeder
   ```

### Конфигурация Xdebug для локальной разработки

1. Соберите контейнеры с поддержкой IDE:

   ```bash
   make build-compose-ide
   ```

2. **PhpStorm → CLI Interpreter**
   - Settings → PHP → CLI Interpreter → `+` → From Docker, Vagrant.
   - Docker Compose-файл: `./docker-compose-ide.yml`.
   - Переменные: `COMPOSE_PROJECT_NAME=vi-local`.
   - Lifecycle: *connect to existing container*.

3. **PhpStorm → Servers**
   - Settings → PHP → Servers → `+`.
   - Name: `Docker`.
   - Host: `vi.local`.
   - Port: `80`.
   - Path mappings:
      - `\wsl.localhost\...` → `/var/www`.
      - `public` → `/var/www/public`.

---

## Качество кода

### Статический анализатор PHP

```bash
make phpstan
```

### Фронтенд

###

```bash
npm run lint # базовый линтер - только ругается
npm run lint:fix # базовый линтер - исправление
npm run lint:css # линтер css - только ругается
npm run lint:css:fix # линтер css - только исправление
```

---

## Ручное обновление справочников

Все команды выполняются внутри контейнера `php-fpm`:

```bash
docker compose exec php-fpm php artisan districts-search:update-open-data
docker compose exec php-fpm php artisan social-support:update-open-data
docker compose exec php-fpm php artisan business-support:update-open-data
docker compose exec php-fpm php artisan it-support:update-open-data
docker compose exec php-fpm php artisan kmns-support:update-open-data
docker compose exec php-fpm php artisan culture-ugra:update-events
docker compose exec php-fpm php artisan humanitarian-points:update-data
docker compose exec php-fpm php artisan weather:get
```
