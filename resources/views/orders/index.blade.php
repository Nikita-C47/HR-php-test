@extends('layouts.app')

@section('title', 'Заказы')

@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Партнер</th>
                <th>Стоимость</th>
                <th>Состав заказа</th>
                <th>Статус</th>
            </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>
                    <a href="{{ route('edit-order', ['id' => $order->id]) }}" target="_blank">
                        {{ $order->id }}
                    </a>
                </td>
                <td>{{ $order->partner->name }}</td>
                <td>{{ $order->cost }} <i class="glyphicon glyphicon-rub"></i></td>
                <td>
                    <ul>
                        @foreach($order->orderProducts as $orderProduct)
                            <li>{{ $orderProduct->product->name }} ({{ $orderProduct->price }} <i class="glyphicon glyphicon-rub"></i>, {{ $orderProduct->quantity }} шт.)</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    @include('widgets.order-status', ['order' => $order])
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $orders->links() }}
@endsection
