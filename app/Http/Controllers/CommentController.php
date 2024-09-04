<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Product;
use AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class CommentController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $comments = Auth::user()->comments;

            return view('comments', compact('comments'));
        }

        return redirect()->route('login')->with('error', 'Debe iniciar sesión para ver sus comentarios');
    }
    public function __construct()
{
    $this->middleware('auth')->only('store');
}


    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'comment' => 'required|string',
        ]);

        if (auth()->check()) {
            auth()->user()->comments()->create([
                'comment' => $request->input('comment'),
            ]);

            return redirect()->route('comments.index')->with('success', 'Comentario agregado correctamente');
        }
        return redirect()->route('comments.index')->with('error', 'Debe iniciar sesión para comentar');
    }
}
