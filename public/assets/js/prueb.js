document.addEventListener("DOMContentLoaded", function() {
    var toggleCurrency = document.getElementById("toggleCurrency");
    var dolarPrice = parseFloat(document.body.dataset.dolarPrice);

    function convertirMoneda() {
        var mostrarEnPesos = toggleCurrency.checked;
        var cartItems = document.querySelectorAll(".cart-item");

        cartItems.forEach(function(cartItem) {
            var precioOriginalUSD = parseFloat(cartItem.querySelector(".card-text").dataset.precioOriginal);
            var cantidadSeleccionada = parseInt(cartItem.querySelector(".quantity-select").value);
            var totalItem = precioOriginalUSD *cantidadSeleccionada;
            var precioConCambioMXN = precioOriginalUSD / dolarPrice;
            var totalItemMXN = precioConCambioMXN*cantidadSeleccionada;

            if (mostrarEnPesos) {
                cartItem.querySelector(".card-text").innerHTML = `Precio: $${precioConCambioMXN.toFixed(2)} USD`;
                cartItem.querySelector(".item-total").innerText = `Total: $${totalItemMXN.toFixed(2)} USD`;
            } else {
                cartItem.querySelector(".card-text").innerHTML = `Precio: $${precioOriginalUSD.toFixed(2)} MXN`;
                cartItem.querySelector(".item-total").innerText = `Total: $${totalItem.toFixed(2)} MXN`;
            }
        });

        // Actualiza el total general
        calcularTotalGeneral();
    }

    function calcularTotalGeneral() {
        var totalGeneral = 0;
        var mostrarEnPesos = toggleCurrency.checked;
        var cartItems = document.querySelectorAll(".cart-item");

        cartItems.forEach(function(cartItem) {
            var precioOriginalUSD = parseFloat(cartItem.querySelector(".card-text").dataset.precioOriginal);
            var cantidadSeleccionada = parseInt(cartItem.querySelector(".quantity-select").value);
            var totalItem = precioOriginalUSD * cantidadSeleccionada;

            if (mostrarEnPesos) {
                totalGeneral += totalItem / dolarPrice;
            } else {
                totalGeneral += totalItem;
            }
        });

        document.getElementById('totalAmount').innerText = mostrarEnPesos ? `$${totalGeneral.toFixed(2)} USD` : `$${totalGeneral.toFixed(2)} MXN`;
    }

    // Inicializa la conversión de moneda y el total
    convertirMoneda();

    toggleCurrency.addEventListener('change', function() {
        convertirMoneda();
    });

    document.querySelectorAll('.quantity-select').forEach(function(quantitySelect) {
        quantitySelect.addEventListener('change', function() {
            convertirMoneda();
        });
    });
});
