<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель поставщика
 * @package App общий код приложения
 *
 * @property int $id ID поставщика
 * @property string $email Email поставщика
 * @property string $name Название поставщика
 * @property string $created_at Дата создания элемента
 * @property string $updated_at Дата обновления элемента
 *
 * @property Product[] $products Связанные товары данного поставщика
 */
class Vendor extends Model
{
    /**
     * Связь с таблицей товаров.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
