<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatableUsers;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    use AuthenticatableUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

public function __construct()
{
    $this->middleware('guest')->except('logout');
}
    public function redirectPath(){
        if (Auth::user()->tipo_usuario){
            return '/admin/products';
        }
        return '/home';
    }
}
