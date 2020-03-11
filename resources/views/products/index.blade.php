@extends('layouts.app')

@section('title', 'Товары')

@section('content')
<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Наименование</th>
        <th>Поставщик</th>
        <th>Цена</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
    <tr>
        <td>
            {{ $product->id }}
        </td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->vendor->name }}</td>
        <td>
            <div class="form-group">
                <input type="text"
                       class="form-control input-sm"
                       id="price-{{ $product->id }}"
                       name="price-{{ $product->id }}"
                       value="{{ $product->price }}"
                       placeholder="Цена">
                <span class="help-block"></span>
                <button class="btn btn-sm btn-primary btn-block"
                        type="button"
                        data-type="price_changer"
                        data-action="{{ route('update-price', ['id' => $product->id]) }}">
                    <i class="glyphicon glyphicon-floppy-disk"></i>
                </button>
            </div>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
{{ $products->links() }}
@endsection
