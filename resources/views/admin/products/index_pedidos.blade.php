@extends('layouts.admin')
@include('admin.barra-navadmin')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Convertir a | Export html Table to CSV & EXCEL File</title>
    <link rel="stylesheet" type="text/css" href="/assets/css/style_admtab.css">
</head>

<body>
    <main class="table" id="customers_table">
        <section class="table__header">
            <h1>Ordenes</h1>
            <div class="input-group">
                <input type="search" placeholder="Search Data...">
                <img src="images/search.png" alt="">
            </div>
            <div class="export__file">
                <label for="export-file" class="export__file-btn" title="Export File"></label>
                <input type="checkbox" id="export-file">
                <div class="export__file-options">
                    <label>Export As &nbsp; &#10140;</label>
                    <label for="export-file" id="toPDF">PDF <img src="images/pdf.png" alt=""></label>
                    <label for="export-file" id="toJSON">JSON <img src="images/json.png" alt=""></label>
                    <label for="export-file" id="toCSV">CSV <img src="images/csv.png" alt=""></label>
                    <label for="export-file" id="toEXCEL">EXCEL <img src="images/excel.png" alt=""></label>
                </div>
            </div>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> Folio <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Cliente <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Ubicacion <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Fecha de Orden <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Estatus <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Cantidad Total <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Detalles del Producto<span class="icon-arrow"></span></th>

                    </tr>
                </thead>


                <tbody>
                    @foreach ($compras as $compra)
                        @php
                            $data = json_decode($compra->data, true);
                            $pedido = isset($data['pedido']) ? json_decode($data['pedido'], true) : null;
                            $attributes = isset($pedido['attributes']) ? $pedido['attributes'] : null;
                            $image = isset($attributes['image']) ? $attributes['image'] : null;
                        @endphp
                        <tr>
                            <td>{{ $compra->id }}</td>
                            <td>{{ $compra->user->name }}</td>
                            <td>
                                @if(empty($data['estado']))
                                    <p style="color: red;">Olvido poner la ubicación</p>
                                @else
                                    {{ $data['estado'] }}
                                @endif
                            </td>
                            <td>
                                @if(isset($data['txndatetime']))
                                    {{ \Carbon\Carbon::createFromFormat('Y:m:d-H:i:s', $data['txndatetime'])->locale('es')->isoFormat('HH:mm [del] D [de] MMMM [de] YYYY') }}
                                @else
                                    {{ '' }}
                                @endif
                            </td>

                            <td>
                                <div class="status">{{ $compra->estatus }}</div>
                            </td>
                            <td> <strong>${{ $data['chargetotal'] ?? '' }}</strong></td>
                            <td>
                                <a href="{{ route('admin.pedidos.show', ['id' => $compra->id]) }}"
                                    class="btn btn-primary">Detalles Pedido</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>
    <script src="/assets/js/script2.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var statusElements = document.querySelectorAll('.status');
            statusElements.forEach(function(statusElement) {
                var statusText = statusElement.innerText.trim().toLowerCase();
                switch (statusText) {
                    default:
                        // Si no se encuentra ninguna coincidencia, agregamos la clase "pendiente" por defecto
                        statusElement.classList.add('pendiente');
                        break;
                    case 'en camino':
                        statusElement.classList.add('camino');
                        break;
                    case 'cancelado':
                        statusElement.classList.add('cancelado');
                        break;
                    case 'entregado':
                        statusElement.classList.add('entregado');
                        break;
                }
            });
        });
    </script>
</body>

</html>