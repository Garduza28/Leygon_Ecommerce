@extends('layouts.app')

@section('content')
@include('partials.topbar')
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Productos</span></h2>
        </div>
                @if(count($products) > 0)

                        @foreach($products as $pro)
                        <div class="row px-xl-5 pb-3">
                            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="img-fluid w-100" src="/images/{{ $pro->image_path }}"
                                         alt="{{ $pro->image_path }}"
                                    >
                                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                        <a href="{{ route('cart.show', ['id' => $pro->id]) }}">
                                            <h6 class="text-truncate mb-3">{{ $pro->name }}</h6>
                                        </a>
                                        <p>${{ $pro->price }}</p>
                                        <form action="{{ route('cart.store') }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{ $pro->id }}" id="id" name="id">
                                            <input type="hidden" value="{{ $pro->name }}" id="name" name="name">
                                            <input type="hidden" value="{{ $pro->price }}" id="price" name="price">
                                            <input type="hidden" value="{{ $pro->image_path }}" id="img" name="img">
                                            <input type="hidden" value="{{ $pro->slug }}" id="slug" name="slug">
                                            <input type="hidden" value="1" id="quantity" name="quantity">
                                            <div class="card-footer d-flex justify-content-between bg-light border">
                                                <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Ver detalles</a>
                                            <button type="submit" class="btn btn-sm text-dark p-0" title="add to cart">
                                                <i class="fas fa-shopping-cart text-primary mr-1"></i> Agregar al carrito
                                            </button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                @else
                    <p>No se encontraron productos.</p>
                @endif
        </div>
        @include('partials.offer')
@include('partials.productstart')
@include('partials.suscribe')
@include('partials.productsoffer')
@include('partials.vendor')
@include('partials.footer')
@endsection

