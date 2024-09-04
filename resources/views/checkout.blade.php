@extends('layouts.adm')

@section('content')
    <style>
        #cartItemsContainer {
            max-height: 400px;
            /* Altura máxima del contenedor */
            overflow-y: auto;
            /* Hacer que el contenedor sea desplazable */
        }

        .cart-item {
            margin-bottom: 20px;
            /* Espacio entre elementos del carrito */
        }

        #paginationButton {
            display: none;
            /* Ocultar el botón de paginación inicialmente */
        }
        main article {
    background: #fff;
    margin: 20px 0;
    padding: 20px;

}
    </style>
<main>
    <article>
    <div class="container-fluid pt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mb-2">

                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Actualizar Datos</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('actualizar.datos') }}">
                            @csrf
                            <div class="form-group">
                                <label for="direccion"required minlength="5">{{ __('Dirección') }}</label>
                                <input id="direccion" type="text" class="form-control" name="direccion"
                                    value="{{ old('direccion', $user->direccion) }}" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="numero_telefono"required minlength="5">{{ __('Número de Teléfono') }}</label>
                                <input id="numero_telefono" type="text" class="form-control" name="numero_telefono"
                                    value="{{ old('numero_telefono', $user->numero_telefono) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="calle"required minlength="5">{{ __('Calle') }}</label>
                                <input id="calle" type="text" class="form-control" name="calle"
                                    value="{{ old('calle', $user->calle) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="estado"required minlength="5">{{ __('Estado') }}</label>
                                <input id="estado" type="text" class="form-control" name="estado"
                                    value="{{ old('estado', $user->estado) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="codigo_postal"required minlength="5">{{ __('Codigo Postal') }}</label>
                                <input id="codigo_postal" type="text" class="form-control" name="codigo_postal"
                                    value="{{ old('codigo_postal', $user->codigo_postal) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="pais"required minlength="5">{{ __('Pais') }}</label>
                                <input id="pais" type="text" class="form-control" name="pais"
                                    value="{{ old('pais', $user->pais) }}"required>
                            </div>

                            <div class="form-group">
                                <label for="instrucciones">{{ __('Numero interior o exterior') }}</label>
                                <input id="exterior_interior" type="text" class="form-control" name="exterior_interior"
                                    value="{{ old('exterior_interior', $user->exterior_interior) }}">
                            </div>

                            <div class="form-group">
                                <label for="instrucciones"required minlength="5">{{ __('Instrucciones') }}</label>
                                <input id="instrucciones" type="text" class="form-control" name="instrucciones"
                                    value="{{ old('instrucciones', $user->instrucciones) }}"required>
                            </div>

                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Actualizar Datos') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Resumen del carrito</h4>
                    </div>

                    <div class="card-body" id="cartItemsContainer">
                        @foreach ($cartContent as $item)
                            <div class="cart-item">
                                <div class="row align-items-center" style="margin-bottom: 10px;">
                                    <div class="col-lg-4">
                                        <img src="{{ $item->attributes->image }}" class="img-thumbnail" width="200"
                                            height="200" alt="Product Image">
                                    </div>
                                    <div class="col-lg-8">
                                        <p>
                                            <b>{{ $item->name }}</b><br>
                                            Precio: ${{ number_format($item->price, 2) }}<br>
                                            Cantidad: {{ $item->quantity }}<br>
                                            Subtotal: ${{ number_format(\Cart::get($item->id)->getPriceSum(), 2) }}
                                        </p>
                                    </div>
                                </div>
                                <span class="subtotal" data-subtotal="{{ \Cart::get($item->id)->getPriceSum() }}"></span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Botón de paginación -->
                    <div id="paginationButton" class="text-center">
                        <button id="loadMoreButton" class="btn btn-link">Ver más productos</button>
                    </div>
                </div>
                <div class="container">
        <!-- Otros contenidos de la página -->
        <div class="card-footer border-secondary bg-transparent">
            <div class="d-flex justify-content-between mt-2">
                <h5 class="font-weight-bold">Total con IVA incluido:</h5>
                <h5 class="font-weight-bold">${{ number_format($totalPriceWithDiscount, 2, '.', ',') }}</h5>
            </div>
        </div>
    </div>


                <!-- Checkbox para selección de método de pago -->
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Metodo de pago</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="directSale" name="paymentMethod"
                                    value="directSale">
                                <label class="custom-control-label" for="directSale">Tárjeta de Débito</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="installments"
                                    name="paymentMethod" value="installments">
                                <label class="custom-control-label" for="installments">Tárjeta de Crédito</label>
                            </div>
                        </div>
                    </div>

                    <!-- formulario de venta directa -->
                    <form id="paymentForm" method="POST" action="https://test.ipg-online.com/connect/gateway/processing"
                        style="display: none;">
                        @csrf
                        <input type="hidden" name="chargetotal"
                            value="{{ number_format($totalPriceWithDiscount, 2, '.', '') }}">
                        <input type="hidden" name="checkoutoption" value="combinedpage">
                        <input type="hidden" name="token" value="{{ session('user_token') }}">
                        <input type="hidden" name="pedido" value="{{ $cartContent }}">
                        <input type="hidden" name="currency" value="484">
                        <input type="hidden" name="hash_algorithm" value="HMACSHA256">
                        <input type="hidden" name="responseFailURL" value="http://127.0.0.1:8000/payment/failure">
                        <input type="hidden" name="responseSuccessURL" value="http://127.0.0.1:8000/payment/success">
                        <input type="hidden" name="storename" value="6299009">
                        <input type="hidden" name="timezone" value="America/Mexico_City">
                        <input type="hidden" name="txndatetime" id="txndatetime" value="">
                        <input type="hidden" name="txntype" value="sale">
                        <input type="hidden" name="hashExtended" id="hashExtended" value="">
                        <input id="submitPayment" type="submit" value="Procesar Pago"
                            class="btn btn-primary btn-block mt-3">


                        <!-- Campos de dirección del usuario autenticado (ocultos) -->
                        <input type="hidden" name="direccion" value="{{ auth()->user()->direccion }}">
                        <input type="hidden" name="numero_telefono" value="{{ auth()->user()->numero_telefono }}">
                        <input type="hidden" name="calle" value="{{ auth()->user()->calle }}">
                        <input type="hidden" name="estado" value="{{ auth()->user()->estado }}">
                        <input type="hidden" name="codigo_postal" value="{{ auth()->user()->codigo_postal }}">
                        <input type="hidden" name="pais" value="{{ auth()->user()->pais }}">
                        <input type="hidden" name="exterior_interior" value="{{ auth()->user()->exterior_interior }}">
                        <input type="hidden" name="instrucciones" value="{{ auth()->user()->instrucciones }}">
                        <input type="hidden" name="coupon_code" value="{{ session('coupon_code') }}">



                    </form>

                    <!-- formulario de meses sin intereses -->
                    <form id="installmentsForm" method="POST"
                        action="https://test.ipg-online.com/connect/gateway/processing" style="display: none;">
                        <input type="hidden" name="chargetotal"
                            value="{{ number_format($totalPriceWithDiscount, 2, '.', '') }}">
                        <input type="hidden" name="checkoutoption" value="combinedpage">
                        <input type="hidden" name="token" value="{{ session('user_token') }}">
                        <input type="hidden" name="pedido" value="{{ $cartContent }}">
                        <input type="hidden" name="currency" value="484">
                        <input type="hidden" name="hash_algorithm" value="HMACSHA256">
                        <input type="hidden" name="installmentsInterest" id="installmentsInterest" value="false">
                        <label for="numberOfInstallmentsInput">Número de cuotas:</label>

                        <select id="numberOfInstallmentsInput" name="numberOfInstallments" required
                            onchange="calculateMonthlyPayments()">
                            <option value="" disabled selected>Seleccione una opción</option>
                            <!-- Opción predeterminada deshabilitada -->
                            <option value="3">3 meses</option>
                            <option value="6">6 meses</option>
                            <option value="9">9 meses</option>
                            <option value="12">12 meses</option>
                        </select>

                        <div id="monthlyPaymentsContainer" style="display:none;">
                            <p>Los pagos mensuales serán:</p>
                            <ul id="monthlyPaymentsList"></ul>
                        </div>
                        <input type="hidden" name="responseFailURL" value="http://127.0.0.1:8000/payment/failure">
                        <input type="hidden" name="responseSuccessURL" value="http://127.0.0.1:8000/payment/success">
                        <input type="hidden" name="storename" value="6299009">
                        <input type="hidden" name="timezone" value="America/Mexico_City">
                        <input type="hidden" name="txndatetime" id="txndatetime2" value="">
                        <input type="hidden" name="txntype" value="sale">
                        <input type="hidden" name="hashExtended" id="hashExtended2" value="">
                        <!-- Campos de dirección del usuario autenticado (ocultos) -->
                        <input type="hidden" name="direccion" value="{{ auth()->user()->direccion }}">
                        <input type="hidden" name="numero_telefono" value="{{ auth()->user()->numero_telefono }}">
                        <input type="hidden" name="calle" value="{{ auth()->user()->calle }}">
                        <input type="hidden" name="estado" value="{{ auth()->user()->estado }}">
                        <input type="hidden" name="codigo_postal" value="{{ auth()->user()->codigo_postal }}">
                        <input type="hidden" name="pais" value="{{ auth()->user()->pais }}">
                        <input type="hidden" name="exterior_interior" value="{{ auth()->user()->exterior_interior }}">
                        <input type="hidden" name="instrucciones" value="{{ auth()->user()->instrucciones }}">
                        <input type="hidden" name="coupon_code" value="{{ session('coupon_code') }}">
                        <input id="submitDirectSale" type="submit" value="Procesar Pago (Meses sin Intereses)"
                            class="btn btn-primary btn-block mt-3">
                    </form>
                </div>
                </article>
                </main>
                @include('partials.footer')
                <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>



                <script>
                    // Función para calcular los pagos mensuales y mostrar el contenedor
                    function calculateMonthlyPayments() {
                        var totalAmount = parseFloat({{ number_format($totalPriceWithDiscount, 2, '.', '') }});
                        var numberOfInstallments = document.getElementById('numberOfInstallmentsInput').value;
                        var monthlyPayment = totalAmount / numberOfInstallments;
                        var lastPayment = totalAmount - (monthlyPayment * (numberOfInstallments - 1));

                        var monthlyPayments = [];
                        for (var i = 1; i <= numberOfInstallments - 1; i++) {
                            monthlyPayments.push('Pago del ' + toOrdinal(i) + ' mes: $' + monthlyPayment.toFixed(2));
                        }
                        monthlyPayments.push('Pago del último mes: $' + lastPayment.toFixed(2));

                        var monthlyPaymentsList = document.getElementById('monthlyPaymentsList');
                        monthlyPaymentsList.innerHTML = '';
                        monthlyPayments.forEach(function(payment) {
                            var listItem = document.createElement('li');
                            listItem.textContent = payment;
                            monthlyPaymentsList.appendChild(listItem);
                        });

                        document.getElementById('monthlyPaymentsContainer').style.display = 'block';
                    }

                    // Función para convertir números en su forma ordinal en español (primero, segundo, etc.)
                    function toOrdinal(number) {
                        if (number === 1) return number + "er";
                        if (number === 3) return number + "er";
                        if (number === 2) return number + "do";
                        return number + "to";
                    }
                </script>


<script src="/assets/js/fiserv.js"></script>
                <div id="mensajeError" style="color: red; display: none;">Por favor, rellene los datos del formulario y de
                    en actualizar datos
                    antes de
                    proceder al pago.</div>


                <script>
                    // Función para verificar si los campos del formulario de actualización están llenos
                    function verificarCampos() {
                        var direccion = document.getElementById('direccion').value;
                        var numeroTelefono = document.getElementById('numero_telefono').value;
                        var calle = document.getElementById('calle').value;
                        var estado = document.getElementById('estado').value;
                        var codigoPostal = document.getElementById('codigo_postal').value;
                        var pais = document.getElementById('pais').value;
                        var instrucciones = document.getElementById('instrucciones').value;

                        // Verificar si todos los campos están llenos
                        if (direccion && numeroTelefono && calle && estado && codigoPostal && pais && instrucciones) {
                            // Habilitar los botones de método de pago y los botones de envío
                            document.getElementById('directSale').disabled = false;
                            document.getElementById('installments').disabled = false;
                            document.getElementById('submitDirectSale').disabled = false;
                            document.getElementById('submitPayment').disabled = false;
                            // Ocultar el mensaje de error
                            document.getElementById('mensajeError').style.display = 'none';
                        } else {
                            // Deshabilitar los botones de método de pago y los botones de envío si hay campos vacíos
                            document.getElementById('directSale').disabled = true;
                            document.getElementById('installments').disabled = true;
                            document.getElementById('submitDirectSale').disabled = true;
                            document.getElementById('submitPayment').disabled = true;
                            // Mostrar el mensaje de error
                            document.getElementById('mensajeError').style.display = 'block';
                        }
                    }

                    // Llamar a la función de verificación cuando se cambie el contenido de algún campo del formulario
                    document.querySelectorAll('input[type="text"]').forEach(function(input) {
                        input.addEventListener('input', verificarCampos);
                    });

                    // Llamar a la función de verificación al cargar la página
                    window.onload = verificarCampos;
                </script>

            @endsection
