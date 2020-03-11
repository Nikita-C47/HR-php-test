<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

/**
 * Класс, представляющий контроллер главной страницы приложения.
 * @package App\Http\Controllers Контроллеры приложения.
 */
class SiteController extends Controller
{
    /** @var string $weatherApiUrl URL для запроса погоды в брянске */
    private $weatherApiUrl = "https://api.openweathermap.org/data/2.5/weather";

    /**
     * Отображает текущую погоду в городе Брянск.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showWeather()
    {
        // Задаем город
        $city = "Bryansk";
        // Регистрируем клиент
        $client = new Client();
        // Делаем GET-запрос
        $response = $client->get($this->weatherApiUrl, [
            'query' => [
                'q' => $city,
                'units' => 'metric',
                'appid' => config('app.weather_app_id')
            ]
        ]);
        // Декодируем результат
        $result = json_decode($response->getBody(), true);
        // Вытаскиваем температуру
        $temperature = $result['main']['temp'];
        // Возвращаем представление
        return view('site.weather', ['temperature' => $temperature]);
    }
}
