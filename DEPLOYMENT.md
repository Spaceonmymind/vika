# Развертывание в продакшене (без CI/CD)

Инструкция покрывает минимальный набор шагов для поднятия проекта в продакшен-окружении.

## 1. Подготовить `.env`

Если файла `.env` еще нет, скопируйте продакшен-шаблон:

```bash
cp .env.production.example .env
```

Заполните обязательные переменные:

- `APP_KEY` — ключ приложения (генерируется командой на шаге установки, но можно задать заранее);
- `PROJECT_HOST` и `APP_URL` — домен и полный URL проекта;
- `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` — параметры MySQL;
- `REDIS_HOST`, `REDIS_PORT`, `REDIS_PASSWORD` — доступ к Redis, если используется пароль;
- `REVERB_APP_ID`, `REVERB_APP_KEY`, `REVERB_APP_SECRET` — ключи для веб-сокетов;
- `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_FROM_ADDRESS` — SMTP;
- `POSTGRES_HOST`, `POSTGRES_DB`, `POSTGRES_USER`, `POSTGRES_PASSWORD` — векторное хранилище;
- сервисные URL/токены (ESIA/FER/VILAR и т.д.) — заполните при подключении внешних интеграций.

## 1. Установка зависимостей

Выполнить

```bash
make production-install
```

Команда копирует .env.production.example в .env, поставит сomposer-зависимости без dev, сгенерирует `APP_KEY` (если
пустой) и выставит права на кэш/сторедж.

## 2. Подготовка `.env`

Заполните обязательные переменные:

- `PROJECT_HOST` — домен проекта;
- `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` — параметры MySQL;
- `REDIS_HOST`, `REDIS_PORT`, `REDIS_PASSWORD` — доступ к Redis;
- `REVERB_APP_ID`, `REVERB_APP_KEY`, `REVERB_APP_SECRET` — ключи для веб-сокетов;
- `POSTGRES_HOST`, `POSTGRES_DB`, `POSTGRES_USER`, `POSTGRES_PASSWORD` — векторное хранилище для LLM;
- сервисные URL/токены (ESIA/FER/VILAR и т.д.) — заполните при подключении внешних интеграций.

## 3. Сборка фронтенда и кэшей

```bash
make production-build
```

Собирает frontend (основной и `Modules/VikaLauncher`), кэширует маршруты/ивенты/представления.

## 4. Запуск стека

```bash
make up
```

Запускает все сервисы в фоне. После запуска убедитесь, что домен (`PROJECT_HOST`) резолвится на хост с контейнерами.
