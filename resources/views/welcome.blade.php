@extends("layouts.app")
@section("content")

    <h3>Menu</h3>
    <ul class="list-unstyled">
        <li>
            <a href="{{route('order.index')}}">Заказы</a>
        </li>
        <li>
            <a href="{{route('weather')}}">Погода</a>
        </li>
    </ul>
@endsection