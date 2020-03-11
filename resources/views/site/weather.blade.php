@extends('layouts.app')

@section('title', 'Погода')

@section('content')
    <div style="font-size: xx-large;">
        Текущая погода в Брянске: <span class="label label-primary">{{ $temperature }}&deg;C</span>
    </div>
@endsection