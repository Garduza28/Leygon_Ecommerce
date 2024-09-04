<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index($productId)
    {
        $product = Product::findOrFail($productId);
        $reviews = $product->reviews()->with('user')->get();

        $totalReviews = $reviews->count();
        $totalStars = $reviews->sum('rating');

        $starPercentages = ($totalReviews > 0) ? ($totalStars / ($totalReviews * 5)) * 100 : null;

        // Opcional: redondear al entero más cercano
        if ($starPercentages !== null) {
            $starPercentages = round($starPercentages);
        }

        return view('detalles_productos', compact('product', 'reviews', 'totalReviews', 'starPercentages'));
    }




    public function create($productId)
    {
        $product = Product::findOrFail($productId);
        return view('reviews.create', compact('product'));
    }
    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        // Asumiendo que estás autenticado y puedes obtener el ID del usuario
        $userId = auth()->id();

        Review::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Review added successfully!');
    }
    public function show($id)
{
    $review = Review::findOrFail($id);
    // Aquí puedes agregar cualquier lógica adicional que necesites para mostrar los detalles de la revisión
    return view('reviews.show', compact('review'));
}

}
