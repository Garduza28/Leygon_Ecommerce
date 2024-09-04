@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Búsqueda de Productos</h1>
        <form action="{{ route('productos.buscar') }}" method="GET">
            @csrf
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="categoria">Categoría:</label>
                        <input type="text" class="form-control" name="categoria" id="categoria">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="marca">Marca:</label>
                        <input type="text" class="form-control" name="marca" id="marca">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="busqueda">Búsqueda:</label>
                        <input type="text" class="form-control" name="busqueda" id="busqueda">
                    </div>
                </div>
            </div>
            <!-- Puedes agregar más campos según tus necesidades -->

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </form>
    </div>
@endsection