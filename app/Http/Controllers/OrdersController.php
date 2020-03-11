<?php

namespace App\Http\Controllers;

use App\Events\OrderFinished;
use App\Http\Requests\OrderFormRequest;
use App\Order;
use App\Partner;

/**
 * Класс, представляющий контроллер для работы с заказами.
 * @package App\Http\Controllers Контроллеры приложения.
 */
class OrdersController extends Controller
{
    /**
     * Отображает список заказов.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Загружаем список заказов с нужными связями
        $orders = Order::with([
            'partner',
            'orderProducts.product'
        ])->orderBy('id', 'desc')->paginate(10);
        // Возвращаем представление
        return view('orders.index', [
            'orders' => $orders
        ]);
    }

    /**
     * Отображает список заказов с разбивкой по вкладкам.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexTabbed()
    {
        // Отношения, которые нужно загрузить
        $relations = [
            'partner',
            'orderProducts.product'
        ];
        // Просроченные заказы
        $overdueOrders = Order::with($relations)->overdue()->take(50)->get();
        // Текущие заказы
        $currentOrders = Order::with($relations)->current()->get();
        // Новые заказы
        $newOrders = Order::with($relations)->new()->take(50)->get();
        // Завершенные заказы
        $finishedOrders = Order::with($relations)->finished()->take(50)->get();
        // Возвращаем представление
        return view('orders.index-tabbed', [
            'overdueOrders' => $overdueOrders,
            'currentOrders' => $currentOrders,
            'newOrders' => $newOrders,
            'finishedOrders' => $finishedOrders
        ]);
    }

    /**
     * Возвращает форму для редактирования заказа.
     *
     * @param int $id ID заказа в БД.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        // Получаем заказ
        $order = Order::findOrFail($id);
        // Получаем полный список партнеров
        $partners = Partner::all();
        // Возвращаем представление
        return view('orders.edit', [
            'order' => $order,
            'partners' => $partners,
            'statuses' => Order::STATUSES
        ]);
    }

    /**
     * Обновляет информацию о заказе в БД.
     *
     * @param OrderFormRequest $request запрос на обновление информации.
     * @param int $id ID заказа в БД.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(OrderFormRequest $request, $id)
    {
        // Ищем заказ
        /** @var Order $order */
        $order = Order::findOrFail($id);
        // Обновляем данные
        $order->client_email = $request->get('email');
        $order->partner_id = $request->get('partner_id');
        $order->status = $request->get('status');
        $order->save();
        // Если статус был изменен и он равен 20 (завершен)
        if($order->wasChanged('status') && $order->status == 20) {
            // Генерируем событие завершения заказа
            event(new OrderFinished($order));
        }
        // Возвращаем редирект на страницу заказов с уведомлением
        return redirect()->route('orders')->with('alert', ['type' => 'success', 'text' => 'Заказ успешно изменён']);
    }
}
