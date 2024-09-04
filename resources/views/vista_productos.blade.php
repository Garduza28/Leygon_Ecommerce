@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        @php $contador = 0; @endphp
        @foreach ($productos['productos'] as $producto)
            @if($contador % 6 == 0)
                @if($contador > 0)
                    </div> <!-- Cierra la fila anterior si no es la primera iteración -->
                @endif
                <div class="row">
            @endif
            <div class="col-md-2" style="padding: 5px;">
                <div class="container mt-3" style="background-color: #f8f9fa; padding: 10px; border: 1px solid #dee2e6; margin-bottom: 10px;">
                    <h5>{{ $producto['titulo'] }}</h5>
                    <p>Producto ID: {{ $producto['producto_id'] }}</p>
                    <p>Modelo: {{ $producto['modelo'] }}</p>
                    <p style="margin-bottom: 5px;">Categorías:</p>
                    <ul style="list-style-type: none; padding: 0;">
                        @if(isset($producto['categorias']))
                            @foreach ($producto['categorias'] as $categoria)
                                <li>{{ $categoria['id'] }}</li>
                                <li>{{ $categoria['nombre'] }}</li>
                                <li>{{ $categoria['nivel'] }}</li>
                            @endforeach
                        @else
                            <li>No hay categorías disponibles</li>
                        @endif
                    </ul>
                    <p>Total existencia: {{ $producto['total_existencia'] }}</p>
                    <p>Marca: {{ $producto['marca'] }}</p>
                    <p>SAT Key: {{ $producto['sat_key'] }}</p>
                    <p>Imagen de portada: <img src="{{ $producto['img_portada'] }}" alt="{{ $producto['titulo'] }}"></p>
                    <p>Precio: {{ isset($producto['precios']['precio_1']) ? $producto['precios']['precio_1'] : 'N/A' }}</p>
                  
                    @if(isset($producto['descripcion']))
                        <p>Descripción: {{ $producto['descripcion'] }}</p>
                    @endif
                    <p>Marca logo: <img src="{{ $producto['marca_logo'] }}" alt="{{ $producto['titulo'] }} - Marca Logo"></p>
                    <p>Existencia: {{ $producto['existencia']['nuevo'] }} disponibles</p>
                </div>
            </div>
            @php $contador++; @endphp
        @endforeach
        </div> <!-- Cierra la última fila -->
    </div>
@endsection