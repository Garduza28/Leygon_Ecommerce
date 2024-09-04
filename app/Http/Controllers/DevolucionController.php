<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Devolucion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DevolucionController extends Controller
{
    public function create(Compra $compra)
    {
        $this->authorize('view', $compra);
        $compraData = $compra->data;
        return view('devolucion_create', compact('compra', 'compraData'));
    }
    public function index()
    {
        // Obtener todas las devoluciones
        $devoluciones = Devolucion::all();

        // Pasar las devoluciones a la vista
        return view('admin.devoluciones', compact('devoluciones'));

    }
    public function store(Request $request, Compra $compra)
    {
        $this->authorize('update', $compra);

        $request->validate([
            'motivo' => 'required|string|max:255',
            'reason' => 'required|string|max:255',
        ]);

        // Verificar si la compra ya tiene una devolución
        if ($compra->devolucion) {
            // Si ya existe una devolución, redirige con un mensaje de error
            return redirect()->route('home')->with('error', 'Ya hay una devolución asociada a esta compra.');
        }

        // Si no hay una devolución asociada, crea una nueva
        Devolucion::create([
            'compra_id' => $compra->id,
            'user_id' => Auth::id(),
            'motivo' => $request->motivo,
            'reason' => $request->reason,
        ]);

        return redirect()->route('home')->with('success', 'Devolución solicitada con éxito.');
    }

    public function show($id)
    {
        $compra = Compra::with('devoluciones')->find($id);
        return view('compra.show', compact('compra'));
    }

}
