<?php

namespace App\Http\Controllers\Admin;
use App\Models\clasifications;
use AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\brands;
use App\Models\Subcategoria;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

use App\Models\Coupon;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::paginate(10); // Cambia el número según tus necesidades
        return view('admin.products.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.products.createcupon');
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.products.editcupon', compact('coupon'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:coupons,codigo',
            'descuento' => 'required|numeric|min:0|max:100',
            'cantidad_disponible' => 'required|integer|min:0',
        ]);

        $coupon = Coupon::create($request->except('_token'));

        return redirect()->route('coupons.index')->with('success', 'Cupón creado correctamente.');
    }

    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'descuento' => 'required|numeric|min:0|max:100',
            'cantidad_disponible' => 'required|integer|min:0',
        ]);

        $coupon->update($request->except('_token'));

        return redirect()->route('coupons.index')->with('success', 'Cupón actualizado correctamente.');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()->route('coupons.index')->with('success', 'Cupón eliminado correctamente.');
    }
}
