<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Compra;
use Illuminate\Http\Request;
use App\Models\Coupon;

class PaymentController extends Controller
{public function success(Request $request)
    {

        $responseData = $request->all();

        // Verificar si el token está presente y no está vacío
        if (isset($responseData['token']) && !empty($responseData['token'])) {
            // Obtener el token del JSON de respuesta
            $token = $responseData['token'];

            // Buscar al usuario por el token
            $user = User::where('token', $token)->first();

            if ($user) {
                // Validar si el usuario ya ha utilizado el cupón
                $couponCode = $responseData['coupon_code']; // Suponiendo que el código del cupón está presente en la respuesta
                $coupon = Coupon::where('codigo', $couponCode)->first();

                if ($coupon && $user->coupons->contains($coupon)) {
                    return redirect()->route('login')->with('error', 'Este cupón ya ha sido utilizado por este usuario.');
                }

                // Guardar la relación entre el usuario y el cupón
                $user->coupons()->attach($coupon);

                // Iniciar sesión manualmente
                Auth::login($user);

                // Crear una nueva compra asociada al usuario
                $compra = new Compra();
                $compra->data = json_encode($responseData);
                $user->compras()->save($compra);

                // Almacenar el token en la sesión del usuario
                session(['user_token' => $token]);

                // Redirigir al usuario a la página de éxito de pago
                return view('payment.success',['responseData' => $responseData]);
            } else {
                // El usuario no fue encontrado, manejar el caso según tu lógica
                return redirect()->route('login')->with('error', 'El token no es válido.');
            }
        } else {
            // El token no está presente en la respuesta, manejar el caso según tu lógica
            return redirect()->route('login')->with('error', 'No se encontró el token en la respuesta.');
        }












        }







    public function failure(Request $request){

    $responseData = $request->all();

    // Verificar si el token está presente y no está vacío
    if (isset($responseData['token']) && !empty($responseData['token'])) {
        // Obtener el token del JSON de respuesta
        $token = $responseData['token'];

        // Buscar al usuario por el token
        $user = User::where('token', $token)->first();

        if ($user) {
            // Validar si el usuario ya ha utilizado el cupón
            $couponCode = $responseData['coupon_code']; // Suponiendo que el código del cupón está presente en la respuesta
            $coupon = Coupon::where('codigo', $couponCode)->first();

            if ($coupon && $user->coupons->contains($coupon)) {
                return redirect()->route('login')->with('error', 'Este cupón ya ha sido utilizado por este usuario.');
            }

            // Guardar la relación entre el usuario y el cupón
            $user->coupons()->attach($coupon);

            // Iniciar sesión manualmente
            Auth::login($user);

            // Crear una nueva compra asociada al usuario
            $compra = new Compra();
            $compra->data = json_encode($responseData);
            $user->compras()->save($compra);

            // Almacenar el token en la sesión del usuario
            session(['user_token' => $token]);

            // Redirigir al usuario a la página de éxito de pago
            return view('payment.success',['responseData' => $responseData]);
        } else {
            // El usuario no fue encontrado, manejar el caso según tu lógica
            return redirect()->route('login')->with('error', 'El token no es válido.');
        }
    } else {
        // El token no está presente en la respuesta, manejar el caso según tu lógica
        return redirect()->route('login')->with('error', 'No se encontró el token en la respuesta.');
    }












    }
 }
