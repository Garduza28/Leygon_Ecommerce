@extends('layouts.app')

@section('content')

<head>
<meta charset="utf-8">
<title>Shopping Cart</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
    body {
        margin-top: 20px;
        background-color: #f1f3f7;
    }
    .avatar-lg {
        height: 5rem;
        width: 5rem;
    }
    .font-size-18 {
        font-size: 18px!important;
    }
    .text-truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    a {
        text-decoration: none!important;
    }
    .w-xl {
        min-width: 160px;
    }
    .card {
        margin-bottom: 24px;
        box-shadow: 0 2px 3px #e4e8f0;
    }
    .card {
        display: flex;
        flex-direction: column;
        background-color: #fff;
        border: 1px solid #eff0f2;
        border-radius: 1rem;
    }
</style>
</head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

<body data-dolar-price="{{ $dolarPrice }}">

@if (session()->has('success_msg'))
    <div class="alert alert-success">
        {{ session('success_msg') }}
    </div>
@endif

@if (session()->has('alert_msg'))
    <div class="alert alert-warning">
        {{ session('alert_msg') }}
    </div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row justify-content-center">
    <div class="col-lg-7">
        <br>
        @if (\Cart::getTotalQuantity() > 0)
            <h4>{{ \Cart::getTotalQuantity() }} Producto(s) en el carrito</h4><br>
        @else
            <h4>No hay productos en tu carrito</h4><br>
            <a href="/" class="btn btn-dark">Continuar en la tienda</a>
        @endif
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-xl-8">
        @foreach ($cartCollection as $item)
    @php
        $product = \App\Models\Product::find($item->id);
        $newId = $product ? $product->producto_id : $item->id;
    @endphp
    <div class="card border shadow-none cart-item">
        <div class="card-body">
            <div class="d-flex align-items-start border-bottom pb-3">
                <div class="me-4">
                    <img src="{{ $item->attributes->image }}" alt="" class="avatar-lg rounded">
                </div>
                <div class="flex-grow-1 align-self-center overflow-hidden">
                    <div>
                        <h5 class="text-truncate font-size-18">
                            <a href="{{ route('obtener.detalles.producto', ['productoId' => $newId]) }}" class="text-dark">{{ $item->name }}</a>
                        </h5>
                        <p class="text-muted mb-0">
                            <i class="mdi mdi-star text-warning"></i>
                            <i class="mdi mdi-star text-warning"></i>
                            <i class="mdi mdi-star text-warning"></i>
                        </p>
                        <p class="mb-0 mt-1">Color: <span class="fw-medium">Blue</span></p>
                    </div>
                </div>
                <div class="flex-shrink-0 ms-2">
                    <ul class="list-inline mb-0 font-size-16">
                        <li class="list-inline-item">
                            <form action="{{ route('cart.remove') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <button type="submit" class="btn btn-danger btn-sm px-1">
                                    <i class="mdi mdi-trash-can-outline"></i>
                                </button>
                            </form>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-muted px-1">
                                <i class="mdi mdi-heart-outline"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="mt-3">
                        <p class="card-text" data-precio-original="{{ $item->price }}">
                            Precio: $<span class="precio">{{ $item->price }}</span> USD
                        </p>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="mt-3">
                        <form action="{{ route('cart.update') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <label for="quantity" class="text-muted mb-2">Cantidad</label>
                            <div class="d-inline-flex">
                                <select name="quantity" class="form-select form-select-sm w-xl quantity-select">
                                    @for ($i = 1; $i <= 100; $i++)
                                        <option value="{{ $i }}" {{ $i == $item->quantity ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm ms-2">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mt-3">
                        <p class="text-muted mb-2">Total</p>
                        <h5 class="item-total" data-total-original="{{ $item->price * $item->quantity }}">
                            $ {{ number_format($item->price * $item->quantity, 2, '.', '') }} USD
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

            <div class="row my-4">
                <div class="col-sm-6">
                    <a href="/" class="btn btn-link text-muted">
                        <i class="mdi mdi-arrow-left me-1"></i> Continuar Comprando
                    </a>
                    @if (count($cartCollection) > 0)
                    <form action="{{ route('cart.clear') }}" class="btn btn-link text-muted" method="POST">
                        {{ csrf_field() }}
                        <button class="btn btn-secondary btn-md">Borrar Carrito</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="mt-5 mt-lg-0">
                <div class="card border shadow-none">
                    <div class="card-header bg-transparent border-bottom py-3 px-4">
                        <h5 class="font-size-16 mb-0">Order Summary <span class="float-end">#MN0124</span></h5>
                    </div>
                    <div class="card-body p-4 pt-2">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td>Sub Total :</td>
                                        <td class="text-end" id="subTotalAmount">$ {{ number_format(\Cart::getTotal(), 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Descuento : </td>
                                        <td class="text-end">- $ 78</td>
                                    </tr>
                                    <tr>
                                        <td>Cargo de Envío :</td>
                                        <td class="text-end">$ 25</td>
                                    </tr>
                                    <tr>
                                        <td>Impuesto Estimado : </td>
                                        <td class="text-end">$ 18.20</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <th>Total :</th>
                                        <td class="text-end">
                                            <span class="fw-bold" id="totalAmount">$ {{ number_format(\Cart::getTotal(), 2) }} USD</span>
                                        </td>
                                    </tr>
                                </tbody>
                                <table class="table">
                                    <tr class="bg-light">
                                        <th>Total sin descuento:</th>
                                        <td class="text-end">
                                            <span class="fw-bold" id="totalWithoutDiscount">
                                                ${{ number_format($totalPrice, 2) }} MXN
                                            </span>
                                        </td>
                                    </tr>
                                    @if ($couponDiscountApplied)
                                    <tr class="bg-light">
                                        <th>Descuento:</th>
                                        <td class="text-end">
                                            <span class="fw-bold" id="discountAmount">
                                                -${{ number_format($discountAmount, 2) }} MXN
                                            </span>
                                        </td>
                                    </tr>
                                    @endif
                                    <tr class="bg-light">
                                        <th>Total con descuento:</th>
                                        <td class="text-end">
                                            <span class="fw-bold" id="totalWithDiscount">
                                                ${{ number_format($totalPriceWithDiscount, 2) }} MXN
                                            </span>
                                        </td>
                                    </tr>
                                </table>


                            </table>
                        </div>
                    </div>
                    <center>
                        <div class="col-sm-6">
                            <div class="text-sm-end mt-2 mt-sm-0">
                                <a href="{{ route('checkout') }}" class="btn btn-success">
                                    <i class="mdi mdi-cart-outline me-1"></i> Checkout
                                </a>
                            </div>
                        </div>
                    </center>
                </div>
                <form class="mb-5" action="{{ route('cart.applyCoupon') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input type="text" class="form-control p-4" placeholder="Código de cupón" name="coupon_code">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary" name="apply_coupon">Aplicar cupón</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@include('partials.footer')

<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/mxntousd.js"></script>

@endsection
