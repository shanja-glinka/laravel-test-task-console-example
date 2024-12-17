# Setup Guide

**Languages:** [Русский](README.ru.md) | [English](README.md)

## Requirements
- Docker and Docker Compose installed

## Description

This is a Laravel 11-based web application using PHP 8.3, PostgreSQL.
Main functionality:
- View the user's current balance and recent transactions.
- Transaction history with the ability to sort by date and search by description.
- Balance management via Laravel console commands:
    - Add users.
    - Accrual and write-off of funds without going into the red.
- Laravel Queues for asynchronous processing of operations.
- Automatically update data on the home page via AJAX.

## Installation

1. Copy the `.env` file:
    ```sh
    cp .env.example .env
    ```

2. Create a Docker network:
    ```sh
    docker network create lrvlconsole_network
    ```

3. Start the Docker containers:
    ```sh
    docker compose up -d
    ```

4. Install dependencies:
    ```sh
    docker compose run php composer install
    ```

5. Generate the application key:
    ```sh
    docker compose run php php artisan key:generate
    ```

6. Run database migrations and seeders:
    ```sh
    docker compose run php php artisan migrate --seed
    ```

*Make sure to give write permissions to the `storage` directory:*

```sh
docker compose exec app chown -R www-data:www-data /var/www/html/storage
```

## Console Commands

The project has console commands for managing users and operations:

- **Add user:**
    ```sh
    docker compose run --rm php php artisan app:add-user "User Name" user@example.com password
    ```

- **Add operation via queue:**
    ```sh
    docker compose run --rm php php artisan app:add-operation user@example.com deposit 1000 "Initial deposit"
    ```

This will queue the operation. Verify that the queue is running:
```sh
docker compose run --rm php php artisan queue:work
```