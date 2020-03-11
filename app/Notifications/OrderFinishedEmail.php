<?php

namespace App\Notifications;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Класс, представляющий уведомление о завершении заказа.
 * @package App\Notifications Уведомления приложения.
 */
class OrderFinishedEmail extends Notification
{
    use Queueable;
    /** @var Order $order заказ, у которого изменился статус. */
    private $order;

    /**
     * Создает новый экземпляр уведомления.
     *
     * @param Order $order заказ.
     */
    public function __construct(Order $order)
    {
        // Инициализируем поле
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Возвращает представление уведомления в виде email.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // Генерируем сообщение
        return (new MailMessage)->subject("Заказ #".$this->order->id." завершен")
            ->view('emails.order-finished', ['order' => $this->order]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
