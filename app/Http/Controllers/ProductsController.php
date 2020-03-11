<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductPriceFormRequest;
use App\Product;

/**
 * Класс, представляющий контроллер для работы с товарами.
 * @package App\Http\Controllers Контроллеры приложения.
 */
class ProductsController extends Controller
{
    /**
     * Отображает список товаров.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Получаем список товаров разбитый по страницам
        $products = Product::orderBy('name', 'asc')->paginate(25);
        // Возвращаем представление
        return view('products.index', [
            'products' => $products
        ]);
    }

    /**
     * Обновляет цену для товара.
     *
     * @param ProductPriceFormRequest $request запрос на обновление цены.
     * @param int $productId ID товара.
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePrice(ProductPriceFormRequest $request, $productId)
    {
        // Ищем товар и обновляем цену
        /** @var Product $product */
        $product = Product::findOrFail($productId);
        $product->price = $request->get('price');
        $product->save();
        // Возвращаем успешный ответ
        return response()->json([
            'status' => 'ok'
        ]);
    }
}
