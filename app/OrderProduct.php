<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель товара в заказе
 * @package App общий код приложения
 *
 * @property int $id ID записи
 * @property int $order_id ID заказа
 * @property int $product_id ID товара в заказе
 * @property int $quantity Количество товара в заказе
 * @property int $price Цена товара
 * @property string $created_at Дата создания элемента
 * @property string $updated_at Дата обновления элемента
 *
 * @property Order $order Связанный объект заказа
 */
class OrderProduct extends Model
{
    /**
     * Связь с таблицей заказов.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    /**
     * Связь с таблицей товаров.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
