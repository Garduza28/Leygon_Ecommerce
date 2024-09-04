@extends('layouts.adm')

@section('content')

@if ($compra)
@php
    $data = json_decode($compra->data, true);
    $pedido = isset($data['pedido']) ? json_decode($data['pedido'], true) : null;
    $attributes = isset($pedido['attributes']) ? $pedido['attributes'] : null;
    $image = isset($attributes['image']) ? $attributes['image'] : null;
@endphp
<div class="card mb-4">
    <div class="card-header">
        <h4 class="mb-0">Folio #{{ $compra->id }}</h4>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th style=>Folio:</th>
                    <td>{{ $compra->id }}</td>
                    <th style="border-left: 3px solid #808285;">Nombre del Comprador:</th>
                    <td>{{ $compra->user->name }}</td>
                </tr>
                <tr>
                    <th style=>Correo Electrónico:</th>
                    <td>{{ $compra->user->email }}</td>
                    <th style="border-left: 3px solid #808285;">Dirección:</th>
                    <td>{{ $data['direccion'] ?? '' }}</td>
                </tr>
                <tr>
                    <th style=>Número de Teléfono:</th>
                    <td>{{ $data['numero_telefono'] ?? '' }}</td>
                    <th style="border-left: 3px solid #808285;">Calle:</th>
                    <td>{{ $data['calle'] ?? '' }}</td>
                </tr>
                <tr>
                    <th style=>Estado:</th>
                    <td>{{ $data['estado'] ?? '' }}</td>
                    <th style="border-left: 3px solid #808285;">Código Postal:</th>
                    <td>{{ $data['codigo_postal'] ?? '' }}</td>
                </tr>
                <tr>
                    <th style=>Número Exterior o Interior:</th>
                    <td>{{ $data['exterior_interior'] ?? '' }}</td>
                    <th style="border-left: 3px solid #808285;">Instrucciones:</th>
                    <td>{{ $data['instrucciones'] ?? '' }}</td>
                </tr>
                <tr>
                    <th style=>Fecha de Compra:</th>
                    <td>{{ $data['txndatetime'] ?? '' }}</td>
                    <th style="border-left: 3px solid #808285;">Pago Total:</th>
                    <td>{{ $data['chargetotal'] ?? '' }}</td>
                </tr>
                <tr>
                    <th style=>Número de Tarjeta:</th>
                    <td>{{ $data['cardnumber'] ?? '' }}</td>
                    <form id="status-form" action="{{ route('admin.pedidos.update', $compra->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Esto asume que estás usando el método PUT para la actualización -->
                        <!-- Tu código HTML actual para mostrar la compra -->
                        <!-- El campo de selección de estatus -->
                        <tr>
                            <th>Estatus de la Compra:</th>
                            <td>
                                <select id="estatus" name="estatus" class="form-control" onchange="updateStatus()">
                                    <option value="En camino" {{ $compra->estatus == 'En camino' ? 'selected' : '' }}>En camino</option>
                                    <!-- Establecer "Pendiente" como la opción predeterminada -->
                                    <option value="Pendiente" selected>Pendiente</option>
                                    <option value="Cancelado" {{ $compra->estatus == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                                    <option value="Entregado" {{ $compra->estatus == 'Entregado' ? 'selected' : '' }}>Entregado</option>
                                </select>

                            </td>
                        </tr>
                    </form>
                    <script>
                        function updateStatus() {
                            var formData = new FormData(document.getElementById("status-form"));

                            fetch('{{ route('admin.pedidos.update', $compra->id) }}', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-Token': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Hubo un problema al actualizar el estatus.');
                                }
                                return response.json();
                            })
                            .then(data => {
                                // Puedes agregar código adicional aquí para manejar la respuesta del servidor si es necesario
                                console.log('Estatus actualizado correctamente:', data);
                            })
                            .catch(error => {
                                console.error('Error al actualizar el estatus:', error);
                            });
                        }
                    </script>
                </tr>
            </tbody>
        </table>
        @if ($pedido)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Producto</th>
                        <th>Producto</th>
                        <th>Precio Unitario</th>
                        <th>Cantidad</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedido as $productoId => $producto)
                    <tr>
                        <td>{{ $productoId }}</td>
                        <td>{{ $producto['name'] ?? '' }}</td>
                        <td>{{ $producto['price'] ?? '' }}</td>
                        <td>{{ $producto['quantity'] ?? '' }}</td>
                        <td><img src="{{ $producto['attributes']['image'] ?? '' }}" alt="Imagen" class="img-fluid"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@else
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="alert alert-info">
            <p>No se encontró el pedido solicitado.</p>
        </div>
    </div>
</div>
@endif




@endsection