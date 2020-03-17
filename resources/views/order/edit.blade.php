@extends("layouts.app")
@section("content")
    <h3>Заказ №{{$order->id}}</h3>
    <div class="row">
        <div class="col-sm-6">
            <form action="{{route('order.update',$order->id)}}" method="post">
                {{csrf_field()}}
                {{method_field("PUT")}}
                <div class="form-group">
                    <label for="email">e-mail клиента</label>
                    <input id="email" class="form-control" type="email" name="client_email"
                           value="{{old("client_email")?:$order->client_email}}">
                </div>
                <div class="form-group">
                    <label for="partner">партнёр</label>
                    <select id="partner" class="form-control" name="partner_id">
                        @foreach($partners as $partner)
                            <option value="{{$partner->id}}"
                                    @if(old("partner_id")?(old("partner_id")==$partner->id):$partner->id == $order->partner->id) selected @endif>
                                {{$partner->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="partner">продукты</label>
                       <ol>
                            @foreach($order->products as $product)
                                <li>
                                    {{$product->name}}:
                                    {{$product->pivot->quantity}} x ₽{{$product->pivot->price}}
                                </li>
                            @endforeach
                        </ol>

                </div>
                <div class="form-group">
                    <label for="status">статус</label>
                    <select id="status" class="form-control" name="status">
                        @foreach($statuses as $code=>$status)
                            <option value="{{$code}}"
                                    @if($code==$order->status) selected @endif>
                                {{$status['name']}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <p>Price: ₽{{$order->sum}}</p>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

@endsection