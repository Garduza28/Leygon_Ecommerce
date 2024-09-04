<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Marca;
use App\Models\brands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Http\Kernel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class TopbarController extends Controller
{

    public function getBanxicoData()
    {
        $token = 'e889e709468a6aaa424c5df9d670b587cfa37c2ba3a11d38274eac55076e1cd8';

        $response = Http::withHeaders([
            'Bmx-Token' => $token,
        ])->get('https://www.banxico.org.mx/SieAPIRest/service/v1/series/SF43718/datos/oportuno');

        $data = $response->json();

        if (isset($data['bmx']['series'][0]['datos'][0]['dato'])) {
            $dolarPrice = floatval($data['bmx']['series'][0]['datos'][0]['dato']);
            return $dolarPrice;
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al obtener datos de Banxico.',
            ], 500);
        }
    }

        public function index($categoria)
        {
            $dolarPrice = $this->getBanxicoData();
            // Filtra los productos por la categoría seleccionada
            $products = Product::where('category_id', $categoria)->get();
            $subcategorias = Category::with('clasificaciones')->get();
            // Luego, pasa los productos y la categoría a la vista correspondiente
            return view('cateproducts', ['products' => $products, 'categoria' => $categoria,'dolarPrice' => $dolarPrice,'subcategorias'=> $subcategorias]);
        }
        public function showBrands($brandId, $categoryId = null)
{
    $dolarPrice = $this->getBanxicoData();

    // Filtrar los productos por brand_id y category_id (si se proporciona), y ordenarlos alfabéticamente por título
    $query = Product::where('brand_id', $brandId);

    if ($categoryId) {
        $query->where('category_id', $categoryId);
    }

    $products = $query->orderBy('titulo', 'asc')->get();

    // Agrupar los productos por categoría y ordenar las categorías alfabéticamente
    $productsByCategory = $products->groupBy('category_id')->sortKeys();

    // Obtener las subcategorias
    $subcategorias = Category::with('clasificaciones')->get();

    // Obtener el dominio base
    $baseUrl = 'https://leygon.com.mx/';
    foreach ($products as $product) {
        // Obtener el ID del producto
        $productId = $product->id;

        // Construir la URL completa del código QR con el ID del producto
        $qrUrl = $baseUrl . 'producto/' . $productId;

        // Generar el código QR
        $qrCode = new QrCode($qrUrl);
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        // Convertir la imagen del código QR a base64 y asignarla al producto
        $product->qrCodeBase64 = base64_encode($result->getString());
    }

    // Obtener las categorías correspondientes a los productos y ordenarlas alfabéticamente
    $categories = Category::whereIn('id', $products->pluck('category_id'))
                          ->get()
                          ->keyBy('id')
                          ->sortBy('name');  // Asumiendo que 'name' es el campo de nombre de la categoría

    return view('brands', [
        'productsByCategory' => $productsByCategory,
        'categories' => $categories,
        'dolarPrice' => $dolarPrice,
        'subcategorias' => $subcategorias,
    ]);
}

    }
