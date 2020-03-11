<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель партнера
 * @package App общий код приложения
 *
 * @property int $id ID партнера
 * @property string $email Email партнера
 * @property string $name Название партнера
 * @property string $created_at Дата создания элемента
 * @property string $updated_at Дата обновления элемента
 *
 * @property Order[] $orders Связанные заказы данного партнера
 */
class Partner extends Model
{
    /**
     * Связь с таблицей заказов.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
