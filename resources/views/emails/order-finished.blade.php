<h2>Здравствуйте!</h2>
<hr>
<h4>Сообщаем Вам о том, что заказ #{{ $order->id }} завершен!</h4>
<br>
Состав заказа:
<br>
<ul>
@foreach($order->products as $product)
    <li>{{ $product->name }}</li>
@endforeach
</ul>
<br>
Стоимость: {{ $order->cost }} руб.