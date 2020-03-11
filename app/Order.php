<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Модель заказа
 * @package App общий код приложения
 *
 * @property int $id ID заказа
 * @property int $status Статус заказа
 * @property string $status_text Текст статуса заказа
 * @property string $status_badge Класс бейджа для статуса
 * @property string $client_email Email клиента
 * @property int $partner_id ID партнера
 * @property string $delivery_dt Дата и время доставки
 * @property int $cost Стоимость заказа
 * @property string $created_at Дата создания элемента
 * @property string $updated_at Дата обновления элемента
 *
 * @property Partner $partner Связанная модель партнера по заказу
 * @property OrderProduct[] $orderProducts Список записей товаров в заказе
 * @property Product[] $products Список товаров в заказе
 *
 * @method static Builder overdue() Возвращает просроченные заказы
 * @method static Builder current() Возвращает просроченные заказы
 * @method static Builder new() Возвращает просроченные заказы
 * @method static Builder finished() Возвращает просроченные заказы
 */
class Order extends Model
{
    // Статусы заказа
    const STATUSES = [
        0 => 'Новый',
        10 => 'Подтвержден',
        20 => 'Завершен'
    ];

    /** @var array $casts массив с сопоставлением полей и типов. */
    protected $casts = [
        'delivery_dt' => 'datetime'
    ];

    /**
     * Связь с таблицей партнеров.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner()
    {
        return $this->belongsTo('App\Partner');
    }

    /**
     * Связь с таблицей заказов.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct');
    }

    /**
     * Связь с самими товарами в заказе.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function products()
    {
        return $this->hasManyThrough(
            'App\Product',
            'App\OrderProduct',
            'order_id',
            'id',
            'id',
            'product_id'
        );
    }

    /**
     * Возвращает атрибут стоимости заказа.
     *
     * @return float|int
     */
    public function getCostAttribute()
    {
        // Сумма заказа
        $sum = 0;
        // Перебираем товары в заказе
        foreach ($this->orderProducts as $orderProduct) {
            // И добавляем стоимость
            $sum += $orderProduct->price * $orderProduct->quantity;
        }
        // Возвращаем общую сумму
        return $sum;
    }

    /**
     * Возвращает атрибут текста статуса заказа.
     *
     * @return mixed|string
     */
    public function getStatusTextAttribute()
    {
        return array_key_exists($this->status, self::STATUSES) ? self::STATUSES[$this->status] : "";
    }

    /**
     * Возвращает атрибут класса бейджа для статуса заказа.
     *
     * @return string
     */
    public function getStatusBadgeAttribute()
    {
        switch ($this->status) {
            case 0: {
                return "info";
                break;
            }
            case 10: {
                return "primary";
                break;
            }
            case 20: {
                return "success";
                break;
            }
            default: {
                return 'default';
                break;
            }
        }
    }

    /**
     * Возвращает просроченные заказы.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOverdue($query)
    {
        return $query->where([
            ['delivery_dt', '<', Carbon::now()],
            ['status', 10]
        ])->orderBy('delivery_dt', 'desc');
    }

    /**
     * Возвращает текущие заказы.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCurrent($query)
    {
        $dateTime = Carbon::now();
        $now = $dateTime->toDateTimeString();
        $yesterday = $dateTime->subHours(24)->toDateTimeString();

        return $query->where('status', 10)
            ->whereBetween('delivery_dt', [$yesterday, $now])
            ->orderBy('delivery_dt', 'asc');
    }

    /**
     * Возвращает новые заказы.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNew($query)
    {
        return $query->where([
            ['delivery_dt', '>', Carbon::now()],
            ['status', 0]
        ])->orderBy('delivery_dt', 'asc');
    }

    /**
     * Возвоащает завершенные заказы.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFinished($query)
    {
        return $query->whereDate('delivery_dt', Carbon::now()->toDateString())
            ->where('status', 20)
            ->orderBy('delivery_dt', 'desc');
    }
}
