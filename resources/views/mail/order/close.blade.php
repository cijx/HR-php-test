<div>
    <p>
        <strong>Заказ №{{$order->id}} закрыт.</strong>
    </p>
    <ol>
@foreach($order->products as $product)
            <li>
                {{$product->name}}: {{$product->pivot->quantity}} x ${{$product->pivot->sum}}
            </li>
@endforeach
    </ol>
    <h4>Цена: ${{$order->sum}}</h4>
</div>