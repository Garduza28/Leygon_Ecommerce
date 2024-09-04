
    document.addEventListener("DOMContentLoaded", function() {
        // Función para sumar el IVA al precio en pesos mexicanos
        function sumarIVA() {
            // Obtener todos los elementos con la clase "card-text"
            var cardTexts = document.querySelectorAll(".card-text");

            cardTexts.forEach(function(cardText) {
                var precioOriginal = parseFloat(cardText.dataset.precioOriginal);
                var precioConCambio = parseFloat(cardText.dataset.precioConCambio);
                var precioConIVA = precioConCambio * 1.16; // IVA del 16%

                // Mostrar el precio con IVA incluido
                cardText.textContent = 'Precio MXN (con IVA): $' + precioConIVA.toFixed(2);
            });
        }

        // Función para manejar el cambio de moneda y el IVA
        function manejarCambioMonedaYIVA() {
            var mostrarEnPesos = document.getElementById("toggleCurrency").checked;
            var sumarIVA = document.getElementById("addTaxBtn").classList.contains("checked");

            var cardTexts = document.querySelectorAll(".card-text");

            cardTexts.forEach(function(cardText) {
                var precioOriginal = parseFloat(cardText.dataset.precioOriginal);
                var precioConCambio = parseFloat(cardText.dataset.precioConCambio);
                var precioConIVA = precioConCambio * 1.16; // IVA del 16%

                if (mostrarEnPesos) {
                    if (sumarIVA) {
                        cardText.textContent = 'Precio MXN (con IVA): $' + precioConIVA.toFixed(2);
                    } else {
                        cardText.textContent = 'Precio MXN (sin IVA): $' + precioConCambio.toFixed(2);
                    }
                } else {
                    if (sumarIVA) {
                        cardText.textContent = 'Precio USD (con IVA): $' + (precioOriginal * 1.16).toFixed(2);
                    } else {
                        cardText.textContent = 'Precio USD (sin IVA): $' + precioOriginal.toFixed(2);
                    }
                }
            });
        }

        // Manejar el clic en el botón para sumar el IVA
        document.getElementById("addTaxBtn").addEventListener("click", function() {
            this.classList.toggle("checked");
            manejarCambioMonedaYIVA();
        });

        // Manejar el cambio de moneda y el IVA cuando se active el interruptor
        document.getElementById("toggleCurrency").addEventListener("change", function() {
            manejarCambioMonedaYIVA();
        });

        // Llamar a la función inicialmente para establecer los precios correctamente al cargar la página
        manejarCambioMonedaYIVA();
    });
