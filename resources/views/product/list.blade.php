@extends("layouts.app")
@section("content")
    <h3>Products</h3>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Vendor</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->vendor?$product->vendor->name:"-"}}</td>
                    <td>
                        <div class="edit-product-price" data-product-id="{{$product->id}}">
                            <button class="btn btn-link">₽{{$product->price}}</button>
                        </div>
                        <div class="input-group hidden" id="price-input-{{$product->id}}">
                            <span class="input-group-addon">₽</span>
                            <input id="price-{{$product->id}}" type="text" class="form-control text-right"
                                   value="{{$product->price}}">
                            <span class="input-group-addon">.00</span>
                            <span class="input-group-btn">
                                <button class="btn btn-default save-price" type="button" data-product-id="{{$product->id}}" data-update-uri="{{route('product.update',$product->id)}}">Обновить</button>
                            </span>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-center">
            {{$products->links()}}
        </div>
    </div>
    @push("scripts")
        <script>

            $('.save-price').click(function () {
                let price = $(this).parents(".input-group").find("input").val();
                let id = $(this).data("product-id");
                let uri = $(this).data("update-uri");
                $.ajax({
                    url: uri,
                    type: "PUT",
                    data: {price: price, _token: '{{csrf_token()}}'},
                    success: function (response) {
                        if ( response.status!==undefined && response.status == 'ok') {
                            let element = $("[data-product-id='" + id + "']");
                            element.find("button").text("₽" + price);
                            switchVisibility(element);
                        } else {

                        }
                    }
                });
            });
            
            function switchVisibility(element) {
                element.toggleClass("hidden");
                $("#price-input-" + element.data("product-id")).toggleClass("hidden");
            }

            $('.edit-product-price').click(function () {
                switchVisibility($(this));
            });
        </script>
    @endpush
@endsection