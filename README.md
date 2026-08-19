## Запуск

Локальний PHP не потрібен `composer install` виконується разово через докер-образ, далі все йде через Sail.

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs

cp .env.example .env
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate --seed
```

Сідер створює 5 менеджерів, 30 лідів і 0-5 звонків на кожного статуси лідів після сідингу вже виставлені бізнес-логікою (не хардкодом), оскільки events під час сідингу не глушаться.

## API

- `POST /api/leads` — створити ліда (`name`, `phone`)
- `POST /api/leads/{lead}/calls` — додати дзвінок (`duration`, `result`, `manager_id`)
- `GET /api/managers/{manager}/leads` — ліди менеджера з `calls_count`/`total_call_duration`

## Де реалізована бізнес-логіка

Переходи статусу ліда (`new → in_progress`, авто-призначення менеджера, `success → won`, 3 звонки підряд `no_answer → lost`) винесені в `App\Listeners\RecalculateLeadStatus`, а не в контролер чи репозиторій. Модель `Call` після `create()` диспатчить подію `CallCreated` (`$dispatchesEvents`), яку слухає цей листенер — виконується синхронно, в тому ж запиті. Такий поділ тримає `CallRepository` "тупим" (тільки персистенція), а бізнес-правила — в одному ізольованому місці, яке легко тестувати окремо від HTTP-шару. Валідація вхідних даних винесена в DTO (`App\Data\LeadData`/`CallData`, spatie/laravel-data) замість FormRequest, а форма відповіді — в API Resources.

## Що можна було б покращити

Додати Tests, Policies
