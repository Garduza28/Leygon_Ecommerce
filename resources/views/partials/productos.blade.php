@foreach ($resultados as $product)
<div class="col-xl-8">
    <div class="card border shadow-none">
        <div class="card-body">
            <div class="d-flex align-items-start border-bottom pb-3">
                <div class="me-4">
                    @if (filter_var($product->img_portada, FILTER_VALIDATE_URL))
                    <img src="{{ $product->img_portada }}" class="avatar-lg rounded" alt="{{ $product->img_portada }}">
                    @else
                    <img src="{{ asset('storage/images/' . $product->img_portada) }}" class="avatar-lg rounded" alt="{{ $product->img_portada }}">
                    @endif
                </div>
                <div class="flex-grow-1 align-self-center overflow-hidden">
                    <div>
                        <h5 class="text-truncate font-size-18"><a href="{{ route('cart.show', ['id' => $product->id]) }}" class="text-dark">{{ $product->titulo }}</a></h5>
                        <p class="text-muted mb-0">
                            <i class="mdi mdi-star text-warning"></i>
                            <i class="mdi mdi-star text-warning"></i>
                            <i class="mdi mdi-star text-warning"></i>
                        </p>
                        <p class="mb-0 mt-1">Marca: <span class="fw-medium">{{ $product->brand_id }}</span></p>
                        <p class="mb-0 mt-1"><a href="{{ route('cart.show', ['id' => $product->id]) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Ver detalles</a> <span class="fw-medium">
                        <form action="{{ route('cart.store') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $product->id }}" id="id" name="id">
                            <input type="hidden" value="{{ $product->titulo }}" id="titulo" name="name">
                            @if ($product->descuento > 0)
                            <input type="hidden" value="{{ $product->precio_con_descuento }}" id="price" name="price">
                            @else
                            <input type="hidden" value="{{ $product->precio }}" id="price" name="price">
                            @endif
                            <input type="hidden" value="{{ $product->img_portada }}" id="img" name="img">
                            <input type="hidden" value="1" id="quantity" name="quantity">
                            <button type="submit" class="btn btn-sm text-dark p-0" title="add to cart">
                                <i class="fas fa-shopping-cart text-primary mr-1"></i> Agregar al carrito
                            </button>
                        </form>
                        </span></p>
                        <p class="card-text" data-precio-original="{{ $product->precio }}" data-precio-con-cambio="{{ $product->precio * $dolarPrice }}">
                            @if(session('show_prices_with_change'))
                                @if(session('show_prices_with_tax'))
                                    Precio : ${{ number_format($product->precio * $dolarPrice * 1.16, 2) }}
                                @else
                                    Precio: ${{ number_format($product->precio * $dolarPrice, 2) }}
                                @endif
                            @else
                                Precio: ${{ $product->precio }}
                            @endif
                        </p>
                        <p class="mb-0 mt-1">Marca: <span class="fw-medium">{{ $product->brand_id }}</span></p>
                    </div>
                </div>
                <div class="flex-shrink-0 ms-2">
                    <ul class="list-inline mb-0 font-size-16">
                        <li class="list-inline-item">
                            <a href="#" class="text-muted px-1">
                                <i class="mdi mdi-heart-outline"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
