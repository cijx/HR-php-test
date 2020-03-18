@extends("layouts.app")
@section("content")
   <div>
    <ul class="nav nav-tabs" id="myTabs" role="tablist">
        <li role="presentation" class="active"><a href="#past-due" aria-controls="past-due" data-toggle="tab">просроченные</a></li>
        <li role="presentation"><a href="#current" aria-controls="current" data-toggle="tab">текущие</a></li>
        <li role="presentation"><a href="#new" aria-controls="new" data-toggle="tab">новые</a></li>
        <li role="presentation"><a href="#completed" aria-controls="completed" data-toggle="tab">выполненные</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="past-due">

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
                    @foreach($orders['past-due'] as $order)

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

        </div>
        <div role="tabpanel" class="tab-pane fade" id="current">

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
                    @foreach($orders['current'] as $order)

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

        </div>
        <div role="tabpanel" class="tab-pane fade" id="new">

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
                    @foreach($orders['new'] as $order)

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

        </div>
        <div role="tabpanel" class="tab-pane fade" id="completed">

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
                    @foreach($orders['completed'] as $order)

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
        </div>
    </div>
   </div>

@endsection

