<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель товара
 * @package App общий код приложения
 *
 * @property int $id ID товара
 * @property string $name Название товара
 * @property int $price Цена товара
 * @property int $vendor_id ID поставщика товара
 * @property string $created_at Дата создания элемента
 * @property string $updated_at Дата обновления элемента
 *
 * @property Vendor $vendor Связанный объект поставщика
 * @property Order[] $orders Связанные заказы с данным товаром
 */
class Product extends Model
{
    /**
     * Связь с таблицей поставщиков.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }

    /**
     * Связь с таблицей заказов.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function orders()
    {
        return $this->hasManyThrough(
            'App\Order',
            'App\OrderProduct',
            'product_id',
            'id',
            'id',
            'order_id'
        );
    }
}
