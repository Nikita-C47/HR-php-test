<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Класс, представляющий запрос на обновление цены.
 * @package App\Http\Requests Запросы приложения.
 */
class ProductPriceFormRequest extends FormRequest
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
            // Цена
            'price' => 'required|integer'
        ];
    }
}
