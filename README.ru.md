# Руководство по установке

**Языки:** [Русский](README.ru.md) | [English](README.md)

## Требования
- Установленный Docker и Docker Compose

## Описание

Это веб-приложение на базе Laravel 11, использующее PHP 8.3, PostgreSQL.  
Основной функционал:
- Просмотр текущего баланса пользователя и последних операций.
- История операций с возможностью сортировки по дате и поиска по описанию.
- Управление балансом через консольные команды Laravel:
  - Добавление пользователей.
  - Начисление и списание средств без ухода в минус.
- Очереди (Laravel Queues) для асинхронной обработки операций.
- Автоматическое обновление данных на главной странице через AJAX.

## Установка

1. Скопируйте файл `.env`:
    ```sh
    cp .env.example .env
    ```

2. Создайте Docker-сеть:
    ```sh
    docker network create lrvlconsole_network
    ```

3. Запустите Docker-контейнеры:
    ```sh
    docker compose up -d
    ```

4. Установите зависимости:
    ```sh
    docker compose run php composer install
    ```

5. Сгенерируйте ключ приложения:
    ```sh
    docker compose run php php artisan key:generate
    ```

6. Выполните миграции и заполните базу данных тестовыми данными:
    ```sh
    docker compose run php php artisan migrate --seed
    ```

*Убедитесь, что папка `storage` имеет права на запись:*

```sh
docker compose exec app chown -R www-data:www-data /var/www/html/storage
```

## Консольные Команды

В проекте есть консольные команды для управления пользователями и операциями:

- **Добавление пользователя:**
    ```sh
    docker compose run --rm php php artisan app:add-user "User Name" user@example.com password
    ```

- **Добавление операции через очередь:**
    ```sh
    docker compose run --rm php php artisan app:add-operation user@example.com deposit 1000 "Initial deposit"
    ```

  Это поставит операцию в очередь. Убедитесь, что очередь работает:
```sh
docker compose run --rm php php artisan queue:work
```
