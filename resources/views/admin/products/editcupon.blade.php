<form action="{{ route('coupons.update', $coupon->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="codigo">Código:</label>
    <input type="text" name="codigo" id="codigo" value="{{ $coupon->codigo }}" required>
    <label for="descuento">Descuento:</label>
    <input type="number" name="descuento" id="descuento" value="{{ $coupon->descuento }}" required>
    <label for="cantidad_disponible">Cantidad Disponible:</label>
    <input type="number" name="cantidad_disponible" id="cantidad_disponible" value="{{ $coupon->cantidad_disponible }}" required>
    <!-- Puedes agregar más campos según tus necesidades -->
    <button type="submit">Actualizar Cupón</button>
</form>
