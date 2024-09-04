@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Solicitud de Devolución') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('devoluciones.store', $compra) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="motivo" class="col-md-4 col-form-label text-md-right">{{ __('Motivo de la devolución') }}</label>

                            <div class="col-md-4"> <!-- Cambiado de col-md-6 a col-md-4 -->
                                <textarea id="motivo" class="form-control @error('motivo') is-invalid @enderror" name="motivo" required autofocus>{{ old('motivo') }}</textarea>

                                @error('motivo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="reason" class="col-md-4 col-form-label text-md-right">{{ __('Razon de la devolución') }}</label>

                            <div class="col-md-6">
                                <textarea id="reason" class="form-control @error('reason') is-invalid @enderror" name="reason" required autofocus>{{ old('reason') }}</textarea>

                                @error('reason')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                @if($compra->devolucion)
                                    <button type="button" class="btn btn-primary" disabled>{{ __('Solicitar Devolución') }}</button>
                                @else
                                    <button type="submit" class="btn btn-primary">{{ __('Solicitar Devolución') }}</button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
