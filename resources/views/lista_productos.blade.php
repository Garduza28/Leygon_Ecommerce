@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Resultados de la Búsqueda</h1>
        @if ($listaProductos)
            <ul>
                @foreach ($listaProductos as $producto)
                    <li>
                        <strong>ID:</strong> {{ $producto['producto_id'] }}<br>
                        <strong>Modelo:</strong> {{ $producto['modelo'] }}<br>
                        <!-- Agrega más detalles según tus necesidades -->
                    </li>
                @endforeach
            </ul>
        @else
            <p>No se encontraron resultados.</p>
        @endif
    </div>






    


@endsection