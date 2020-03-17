@extends("layouts.app")
@section("content")
    <table class="table table-sm">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">партнёр</th>
            <th scope="col">стоимость</th>
            <th scope="col">наименование и состав заказа</th>
            <th scope="col">статус заказа</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            @foreach($orders as $order)

                <th scope="row"><a href="{{route('order.edit',$order->id)}}">{{$order->id}}</a></th>

                <td>{{$order->partner?$order->partner->name:"-"}}</td>

                <td>₽{{$order->sum}}</td>

                <td>
                    <ol>
                        @foreach($order->products as $product)
                            <li>
                                <strong>{{$product->name}}</strong>:
                                {{$product->pivot->quantity}} x ₽{{$product->pivot->price}}
                            </li>
                        @endforeach
                    </ol>
                </td>

                <td>

                    @foreach(config('statuses') as $key=>$status)

                        @if($key == $order->status)

                            <span class="label {{$status['style']}}">{{$status['name']}}</span>

                        @endif

                    @endforeach

                </td>

        </tr>
            @endforeach



        </tbody>
    </table>
    {{$orders->links()}}
@endsection