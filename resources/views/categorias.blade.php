<!-- resources/views/categorias.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías Syscom</title>
</head>
<body>
    <h1>Categorías obtenidas desde Syscom API</h1>
    
    <ul>
        @foreach($categorias as $categoria)
        <li>{{ $categoria['id'] }}
            {{ $categoria['nombre'] }}
            {{ $categoria['nivel'] }}</li>
        @endforeach


        </ul>

   
</body>
</html>