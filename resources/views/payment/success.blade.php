<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pago Exitoso</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f5f5f5;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 40px;
        text-align: center;
    }

    h1 {
        color: #4caf50;
    }

    p {
        margin-bottom: 20px;
    }

    .button {
        display: inline-block;
        background-color: #4caf50;
        color: #fff;
        padding: 10px 20px;
        border-radius: 4px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .button:hover {
        background-color: #66bb6a;
    }
</style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="container">
        <h1>Pago Exitoso</h1>
        <p>¡Felicidades! Tu pago se ha procesado correctamente.</p>
        <p>Recibirás una confirmación por correo electrónico en breve.</p>
        <a href="{{ route('home') }}"  class="button">{{ __('Ir a la tienda') }}</a>
        <pre>{{ print_r($responseData, true) }}</pre>
    </div>
</body>
</html>
