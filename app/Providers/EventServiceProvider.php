<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Сопоставление слушателей событий для приложения.
     *
     * @var array
     */
    protected $listen = [
        // Слушатель для события завершения заказа
        'App\Events\OrderFinished' => [
            'App\Listeners\SendFinishedOrderEmails',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
