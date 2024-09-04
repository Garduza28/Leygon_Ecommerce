@extends('layouts.admin')
@include('admin.barra-navadmin')
@section('content')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devoluciones</title>
    <!-- Enlace a los estilos CSS de Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Lista de Devoluciones</h1>
        @if ($devoluciones->isEmpty())
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-info" role="alert">
                        No hay devoluciones registradas.
                    </div>
                </div>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Compra ID</th>
                            <th>Usuario ID</th>
                            <th>Motivo</th>
                            <th>Razón</th>
                            <th>Fecha de Solicitud</th>
                            <!-- Agrega más columnas si es necesario -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($devoluciones as $devolucion)
                            <tr>
                                <td data-label="ID">{{ $devolucion->id }}</td>
                                <td data-label="Compra ID">{{ $devolucion->compra_id }}</td>
                                <td data-label="Usuario ID">{{ $devolucion->user_id }}</td>
                                <td data-label="Motivo">{{ $devolucion->motivo }}</td>
                                <td data-label="Razón">{{ $devolucion->reason }}</td>
                                <td data-label="Fecha de Solicitud">{{ $devolucion->created_at }}</td>
                                <!-- Agrega más celdas si es necesario -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Enlace a los scripts de JavaScript de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


@endsection
