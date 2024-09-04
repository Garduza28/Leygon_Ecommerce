@extends('layouts.app')

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            max-width: 1000px;
            margin: auto;
        }

        .table {
            width: 100%;
            border: 1px solid #ccc;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            table-layout: fixed;
        }

        .table caption {
            font-size: 28px;
            text-transform: uppercase;
            font-weight: bold;
            margin: 8px 0px;
        }

        .table tr {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
        }

        .table th,
        .table td {
            font-size: 16px;
            padding: 8px;
            text-align: center;
        }

        .table thead th {
            text-transform: uppercase;
            background-color: #ddd;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.2);
        }

        .table tbody td:hover {
            background-color: rgba(0, 0, 0, 0.3);
        }

        @media screen and (max-width: 600px) {
            .table {
                border: 0px;
            }

            .table caption {
                font-size: 22px;
            }

            .table thead {
                display: none;
            }

            .table tr {
                margin-bottom: 8px;
                border-bottom: 4px solid #ddd;
                display: block;
            }

            .table th,
            .table td {
                font-size: 12px;
            }

            .table td {
                display: block;
                border-bottom: 1px solid #ddd;
                text-align: right;
            }

            .table td::before {
                content: attr(data-label);
                font-weight: bold;
                text-transform: uppercase;
                float: left;
            }

            .table td:last-child {
                border-bottom: 0px;
            }
        }
    </style>
    <div class="container">
        @if ($compras->isEmpty())
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-info" role="alert">
                        No has realizado ninguna compra aún.
                    </div>
                </div>
            </div>
        @else
            @foreach ($compras as $compra)
                @php
                    $data = json_decode($compra->data, true);
                    $pedido = isset($data['pedido']) ? json_decode($data['pedido'], true) : null;
                @endphp
                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title">Folio de Compra: {{ $compra->id }}</h4>
                            <h4 class="card-title">Fecha:
                                {{ $compra->created_at->locale('es')->isoFormat('D [de] MMMM [de] YYYY, h:mm A') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Estatus Pedido</th>
                                        <th>Codigo de Producto</th>
                                        <th>Producto</th>
                                        <th>Precio Unitario</th>
                                        <th>Cantidad</th>
                                        <th>Imagen</th>
                                        <th>Precio Total Producto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $precioTotalCompra = 0;
                                    @endphp
                                    @foreach ($pedido as $productoId => $producto)
                                        @php
                                            $precioTotalProducto = $producto['price'] * $producto['quantity'];
                                            $precioTotalCompra += $precioTotalProducto;
                                        @endphp
                                        <tr>
                                            <td data-label="Estatus Pedido">{{ $compra->estatus }}</td>
                                            <td data-label="Codigo de Producto">{{ $productoId }}</td>
                                            <td data-label="Producto">{{ $producto['name'] ?? '' }}</td>
                                            <td data-label="Precio Unitario">{{ number_format($producto['price'] ?? 0, 2, ',', '.') }}</td>
                                            <td data-label="Cantidad">{{ $producto['quantity'] ?? '' }}</td>
                                            <td data-label="Imagen">
                                                @if (isset($producto['attributes']['image']))
                                                    <img src="{{ $producto['attributes']['image'] }}" alt="Imagen"
                                                        class="img-fluid" style="max-width: 100px; max-height: 100px;">
                                                @else
                                                    Sin imagen
                                                @endif
                                            </td>
                                            <td data-label="Precio Total Producto">{{ number_format($precioTotalProducto, 2, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Dirección:</th>
                                    <td data-label="Dirección">{{ $data['direccion'] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Instrucciones:</th>
                                    <td data-label="Instrucciones">{{ $data['instrucciones'] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Código Postal:</th>
                                    <td data-label="Código Postal">{{ $data['codigo_postal'] ?? '' }}</td>
                                </tr>
                                <!-- Agregar más datos aquí si es necesario -->
                            </tbody>
                        </table>
                        @if ($compra->estatus === 'Entregado')
                        @if (!$compra->devolucion)
                        <a href="{{ route('devoluciones.create', $compra->id) }}" id="solicitarDevolucionBtn" class="btn btn-warning" @if ($compra->estatus !== 'Entregado') style="display: none;" @endif>Solicitar Devolución</a>
                        @else
                            <button type="button" class="btn btn-warning" disabled>Ya has solicitado una devolución</button>
                        @endif
                    @else
                        <button type="button" class="btn btn-warning" disabled>Estado del Pedido no permite Devolución</button>
                    @endif

                    </div>
                </div>
                <script>
                    // JavaScript para habilitar el botón y deshabilitarlo después de un minuto
                    document.addEventListener("DOMContentLoaded", function() {
                        var boton = document.getElementById("solicitarDevolucionBtn");

                        // Verificar si el estado del pedido es "Entregado"
                        if (boton.style.display !== "none") {
                            // Habilitar el botón
                            boton.disabled = false;

                            // Deshabilitar el botón después de un minuto
                            setTimeout(function() {
                                boton.disabled = true;
                            }, 60000); // 60000 milisegundos = 1 minuto
                        }
                    });
                </script>
            @endforeach
        @endif
    </div>
@endsection