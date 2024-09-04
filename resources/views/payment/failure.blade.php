<!DOCTYPE html>

<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pago Fallido</title>
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
        color: #ff5733;
    }

    p {
        margin-bottom: 20px;
    }

    .button {
        display: inline-block;
        background-color: #ff5733;
        color: #fff;
        padding: 10px 20px;
        border-radius: 4px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .button:hover {
        background-color: #ff6b4a;
    }
</style>
</head>
<body>
    <div class="container">
        <h1>Pago Fallido</h1>
        <p>Lo sentimos, tu pago no se pudo procesar correctamente.</p>
        <p>Por favor, inténtalo de nuevo más tarde.</p>

        <a href="{{ route('home') }}"  class="button">{{ __('Ir a la tienda') }}</a>

        <pre>{{ print_r($responseData, true) }}</pre>
    </div>

</body>

</html>
