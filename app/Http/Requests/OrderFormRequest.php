<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Класс, представляюший запрос на обновление заказа.
 * @package App\Http\Requests Запросы приложения.
 */
class OrderFormRequest extends FormRequest
{
    /**
     * Определяет, может ли пользователь выполнять данный запрос.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Возвращает правила валидации для полей запроса.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // Email
            'email' => 'required|email',
            // ID партнера
            'partner_id' => 'required|exists:partners,id',
            // Статус заказа
            'status' => 'required|in:0,10,20'
        ];
    }
}
