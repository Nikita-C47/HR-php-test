<?php

namespace App\Events;

use App\Order;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

/**
 * Класс, представляющий событие об установке статуса заказа "Завершен".
 * @package App\Events События приложения.
 */
class OrderFinished
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var Order $order Завершенный заказ */
    public $order;

    /**
     * Создает новый объект события
     *
     * @param Order $order завершенный заказ
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
