<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Str;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectPath()
    {
        if (Auth::user()->tipo_usuario) {
            return '/admin/products';
        }
        return '/home';
    }

    public function authenticated(Request $request, $user)
    {
        $user->token = Str::random(60); // Generar un token de acceso único
        $user->save();
        
        // Almacena el token en la sesión
        $request->session()->put('user_token', $user->token);
        
        return redirect()->intended($this->redirectPath());
    }

    public function logout(Request $request)
    {
        $request->user()->update(['token' => null]); // Eliminar el token de acceso al cerrar sesión

        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('home');
    }
    
}
