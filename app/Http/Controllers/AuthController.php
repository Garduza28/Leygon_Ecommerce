<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Redirecciona al usuario a Google para autenticación
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }



    // Procesa la respuesta de Google y autentica al usuario
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
    
        // Comprueba si el usuario ya existe en la base de datos
        $existingUser = User::where('email', $user->email)->first();
    
        if ($existingUser) {
            // Si el usuario ya existe, actualiza el token existente
            $existingUser->token = Str::random(60);
            $existingUser->save();
    
            // Inicia sesión con el usuario existente
            Auth::login($existingUser, true);
        } else {
            // Si el usuario no existe, crea un nuevo usuario en la base de datos
            $newUser = new User();
            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->token = Str::random(60);
            $newUser->save();
    
 
            // Inicia sesión con el nuevo usuario
            Auth::login($newUser, true);
        }

        // Redirige al usuario a la vista home
        return redirect()->route('home');
    }


    // Método similar para Facebook
    // Redirecciona al usuario a Facebook para autenticación
    public function redirectToFacebook()
{
    return Socialite::driver('facebook')->redirect();
}

public function handleFacebookCallback()
{
    $socialiteUser = Socialite::driver('facebook')->user();

    // Verificar si el usuario ya existe en tu base de datos o crear uno nuevo si es necesario
    $user = User::where('email', $socialiteUser->email)->first();

    if (!$user) {
        // Si el usuario no existe, crea un nuevo usuario con los datos de Socialite
        $user = User::create([
            'name' => $socialiteUser->name,
            'email' => $socialiteUser->email,
            // Puedes agregar más campos aquí según sea necesario
        ]);
    }

    // Autenticar al usuario
    auth()->login($user);

    // Redirigir al usuario a una página después de iniciar sesión
    return redirect()->to('home');



        $userId = Auth::id();
        $userCartKey = 'user_' . $userId . '_cart';


        $userCart = Session::get($userCartKey, []);

        \Cart::add($userCart);

        // Redirige al usuario a la vista home
        return redirect()->route('home');
    }
    public function showLoginForm()
{
    return view('auth.login');
}
}