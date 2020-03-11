<?php

namespace App\Listeners;

use App\Events\OrderFinished;
use App\Notifications\OrderFinishedEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

/**
 * Класс, представляющий слушатель события завершения заказа.
 * @package App\Listeners Классы-слушатели приложения.
 */
class SendFinishedOrderEmails
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Обрабатывает событие.
     *
     * @param OrderFinished $event событие завершения заказа.
     * @return void
     */
    public function handle(OrderFinished $event)
    {
        // Тут будут email
        $emails = [];
        // Добавляем email партнера
        $emails[] = $event->order->partner->email;
        // И Email поставщиков товаров
        foreach ($event->order->products as $product) {
            $emails[] = $product->vendor->email;
        }
        // Отправляем уведомления
        foreach ($emails as $email) {
            Notification::route('mail', $email)->notify(new OrderFinishedEmail($event->order));
        }
    }
}
