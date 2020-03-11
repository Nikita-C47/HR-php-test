@extends('layouts.app')

@section('title', 'Заказы (по типам)')

@section('content')
    <div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#overdue" aria-controls="overdue" role="tab" data-toggle="tab">Просроченные</a>
            </li>
            <li role="presentation">
                <a href="#current" aria-controls="current" role="tab" data-toggle="tab">Текущие</a>
            </li>
            <li role="presentation">
                <a href="#new" aria-controls="new" role="tab" data-toggle="tab">Новые</a>
            </li>
            <li role="presentation">
                <a href="#finished" aria-controls="finished" role="tab" data-toggle="tab">Выполненные</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="overdue">
                @include('widgets.orders-list', ['orders' => $overdueOrders])
            </div>
            <div role="tabpanel" class="tab-pane" id="current">
                @include('widgets.orders-list', ['orders' => $currentOrders])
            </div>
            <div role="tabpanel" class="tab-pane" id="new">
                @include('widgets.orders-list', ['orders' => $newOrders])
            </div>
            <div role="tabpanel" class="tab-pane" id="finished">
                @include('widgets.orders-list', ['orders' => $finishedOrders])
            </div>
        </div>
    </div>
@endsection