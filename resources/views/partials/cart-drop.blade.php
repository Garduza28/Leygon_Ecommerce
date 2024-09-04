@if(count(\Cart::getContent()) > 0)
    @foreach(\Cart::getContent() as $item)
        <li class="list-group-item position-relative">
            <form action="{{ route('cart.remove') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $item->id }}">
                <div class="row">
                    <div class="col-lg-3">
                    <img src="{{ $item->attributes->image }}" class="img-cart" alt="Product Image">
                    </div>
                    <div class="col-lg-6">
                        <b>{{$item->name}}</b>
                        <p>Precio: ${{ number_format(\Cart::get($item->id)->getPriceSum() , 2)}}</p>
                    </div>
                </div>
            </form>
            <hr>
        </li>
    @endforeach
    <br>
    <li class="list-group-item">
        <div class="row">
            <div class="col-lg-10">
                <b>Total: </b> ${{ number_format(\Cart::getTotal() , 2)}}
            </div>
        </div>
    </li>
    <br>
    <div class="row" style="margin: 0px;">
        <a class="btn btn-dark btn-sm btn-block" href="{{ route('cart.index') }}">
            CARRITO <i class="fa fa-arrow-right"></i>
        </a>
        <a class="btn btn-dark btn-sm btn-block" href="{{ route('checkout') }}">
            CHECKOUT <i class="fa fa-arrow-right"></i>
        </a>
    </div>
@else
    <li class="list-group-item">Tu carrito está vacío</li>
@endif
