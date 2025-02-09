@extends('layouts.admin')
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">{{ __('Registrarse') }}</h1>
                        </div>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                        placeholder="Nombre">
                                        @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('apellido') }}" required autocomplete="apellido" autofocus
                                        placeholder="Apellido">
                                        @error('apellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"
                                    placeholder="Correo electrónico">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"
                                    placeholder="Contraseña">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="col-sm-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Confirmar contraseña">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">{{ __('Crear cuenta') }}</button>
                            <a href="{{ route('login.google') }}" class="btn btn-google btn-user btn-block">
                                <i class="fab fa-google fa-fw"></i> Iniciar sesión con Google
                            </a>
                            <a href="{{ route('login.facebook') }}" class="btn btn-facebook btn-user btn-block">
                                <i class="fab fa-facebook-f fa-fw"></i> Iniciar sesión con Facebook
                            </a>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="forgot-password.html">¿Olvidaste tu contraseña?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="{{ route('login') }}">¿Ya tienes una cuenta?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="{{ url('/') }}">Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
