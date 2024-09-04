<!-- resources/views/exchange-rate.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasa de Cambio</title>
</head>
<body>
    <h1>Tasa de Cambio</h1>
    
    <p>Fecha de actualización: {{ $exchangeRate['updated'] }}</p>
    <p>Moneda fuente: {{ $exchangeRate['source'] }}</p>
    <p>Moneda objetivo: {{ $exchangeRate['target'] }}</p>
    <p>Valor: {{ $exchangeRate['value'] }}</p>
    <p>Cantidad: {{ $exchangeRate['quantity'] }}</p>
    <p>Importe: {{ $exchangeRate['amount'] }}</p>
</body>
</html>