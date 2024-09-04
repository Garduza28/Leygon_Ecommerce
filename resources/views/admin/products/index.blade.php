@extends('layouts.admin')
@include('admin.barra-navadmin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Listado de Cupones</h2>
                <a href="{{ route('coupons.create') }}" class="btn btn-primary mb-3">Crear Cupón</a>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Descuento</th>
                                <th>Cantidad Disponible</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupons as $coupon)
                                <tr>
                                    <td>{{ $coupon->codigo }}</td>
                                    <td>{{ $coupon->descuento }}%</td>
                                    <td>{{ $coupon->cantidad_disponible }}</td>
                                    <td>
                                        <a href="{{ route('coupons.edit', $coupon->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                        <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST" class="mt-3" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este cupón?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar Cupón</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
