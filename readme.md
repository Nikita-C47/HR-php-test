## Настройка проекта
Стандартная для Laravel:
* `composer install`
* настроить `.env` файл:
    * `WEATHER_APP_ID` - указать [ключ для API погоды](https://openweathermap.org/api), чтобы работала погода в Брянске (в файле .env.example есть мой ключ).
* `php artisan key:generate`
* `php artisan migrate`
* `php artisan db:seed`
