@extends('layouts.app')

@section('title', 'Редактировать заказ #'.$order->id)

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form method="post">
                        {{ csrf_field() }}
                        <div class="form-group @if($errors->has('email')) has-error @endif">
                            <label for="email">Email: <span class="text-danger">*</span></label>
                            <input type="email"
                                   class="form-control"
                                   id="email"
                                   name="email"
                                   required
                                   placeholder="Email"
                                   aria-describedby="emailBlock"
                                   value="{{ $order->client_email }}">
                            @if($errors->has('email'))
                                <span id="emailBlock" class="help-block">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group @if($errors->has('partner_id')) has-error @endif">
                            <label for="partner_id">Партнер: <span class="text-danger">*</span></label>
                            <select name="partner_id" id="partner_id" class="form-control" required>
                                <option value="">- Выберите партнера -</option>
                                @foreach($partners as $partner)
                                    <option value="{{ $partner->id }}" @if($partner->id === $order->partner_id) selected @endif>
                                        {{ $partner->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if($errors->has('partner_id'))
                                <span id="emailBlock" class="help-block">
                                    {{ $errors->first('partner_id') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3">
                                <label>Товары:</label>
                                <table class="table table-bordered w-">
                                    <tr>
                                        <th>Наименование</th>
                                        <th>Количество</th>
                                    </tr>
                                    @foreach($order->orderProducts as $orderProduct)
                                        <tr>
                                            <td>{{ $orderProduct->product->name }}</td>
                                            <td>{{ $orderProduct->quantity }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="form-group @if($errors->has('status')) has-error @endif">
                            <label for="status">Статус: <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">- Выберите статус -</option>
                                @foreach($statuses as $key => $status)
                                    <option value="{{ $key }}" @if($key === $order->status) selected @endif>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <span id="emailBlock" class="help-block">
                                    {{ $errors->first('status') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group" style="font-size: large;">
                            <strong>Стоимость:</strong>
                            <span class="label label-success">
                                {{ $order->cost }} <i class="glyphicon glyphicon-rub"></i>
                            </span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Сохранить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
