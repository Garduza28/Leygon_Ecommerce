<?php

namespace App\Http\Controllers;
use App\Models\Product;

use App\Models\Category;
use App\Models\clasifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\brands;
use App\Models\Subcategoria;


class ProductoController extends Controller
{

    public function buscar(Request $request)
    {
        $dolarPrice = $this->getBanxicoData();
        $query = $request->input('query');
        $subcategoriaSeleccionada = $request->input('subcategoria'); // Obtener la subcategoría seleccionada
        $marcaSeleccionada = $request->input('marca'); // Obtener la marca seleccionada
        $orderBy = $request->input('orden'); // Obtener el método de ordenamiento seleccionado
    
        // Realizar la búsqueda en la base de datos
        $resultados = Product::where(function ($queryBuilder) use ($subcategoriaSeleccionada, $marcaSeleccionada) {
            if (!empty($subcategoriaSeleccionada)) {
                $queryBuilder->where('subcategoria_id', $subcategoriaSeleccionada);
            }
            if (!empty($marcaSeleccionada)) {
                $queryBuilder->where('brand_id', $marcaSeleccionada);
            }
        })
    
        ->where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('titulo', 'like', "%$query%")
                ->orWhere('brand_id', 'like', "%$query%")
                ->orWhere('clasification_id', $query)
                ->orWhere('category_id', $query);
        });
    
        // Aplicar ordenamiento según la opción seleccionada
        switch ($orderBy) {
            case 'ascendente':
                $resultados->orderBy('precio', 'asc');
                break;
            case 'descendente':
                $resultados->orderBy('precio', 'desc');
                break;
            // Agrega más casos según sea necesario
            default:
                // Orden predeterminado o ninguna ordenación específica
                break;
        }
    
        $resultados = $resultados->get();
    
        // Obtener las subcategorías de los productos encontrados
        $productSubcategories = $resultados->pluck('subcategoria_id')->unique()->values()->all();
    
        // Obtener las marcas de los productos encontrados
        $productBrands = $resultados->pluck('brand_id')->unique()->values()->all();
    
        foreach ($resultados as $producto) {
            if ($producto->descuento > 0) {
                $producto->precio_con_descuento = $producto->precio - ($producto->precio * ($producto->descuento / 100));
            } else {
                $producto->precio_con_descuento = $producto->precio;
            }
        }

        $numProductosMostrados = count($resultados);
$totalProductos = Product::count(); // O puedes obtener el total de otra manera, según sea necesario
    
        $categories = Category::all();
        $subcategorias = Category::with('clasificaciones')->get();
        return view('resultados_busqueda', compact('resultados', 'categories', 'subcategorias', 'productSubcategories', 'productBrands', 'dolarPrice', 'subcategoriaSeleccionada', 'marcaSeleccionada', 'query', 'orderBy', 'numProductosMostrados', 'totalProductos'));

    }
    





public function index()
{
    $products = Product::all();
    return view('categories', compact('products'));
}

public function filterByCategory($category)
{
    $products = Product::where('category_id', 'like', '%' . $category . '%')->get();

    return view('categories', compact('products'));
}





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








public function showProducts(Request $request, $subcategoria)
{
    $categories = Category::all();
    $dolarPrice = $this->getBanxicoData();
    $order = $request->input('orden', 'descendente'); // Obtener el valor del parámetro de ordenamiento, por defecto 'descendente'
    $clasification=$subcategoria;
    // Obtener todos los productos de la clasificación inicial (sin filtrar por subcategoría)
    $productsQuery = Product::where('clasification_id', $subcategoria);


    
    // Aplicar el ordenamiento a la consulta
    if ($order === 'ascendente') {
        $productsQuery->orderBy('precio', 'asc');
    } else {
        $productsQuery->orderBy('precio', 'desc');
    }

    // Obtener los productos con las condiciones aplicadas
    $products = $productsQuery->get();

    // Obtener las subcategorías de los productos actuales
    $subcategoriaseleccionada = $products->pluck('subcategoria_id')->unique()->values()->all();
    $productBrands = $products->pluck('brand_id')->unique()->values()->all();
   


    
    $marcaseleccionada = $productsQuery->pluck('brand_id')->unique()->values()->all();

    
    // Obtener todas las subcategorías disponibles (si es necesario)
    $subcategorias = Category::with('clasificaciones')->get();
    


    // Pasar datos a la vista
    return view('productsclasi', [
        'products' => $products,
        'categories' => $categories,
        'dolarPrice' => $dolarPrice,
        'order' => $order,
        'subcategoria' => $subcategoria, // Pasar la subcategoría seleccionada a la vista
        'subcategoriaseleccionada' => $subcategoriaseleccionada,
        'subcategorias' => $subcategorias,
        'marcaseleccionada' => $marcaseleccionada, // Pasar todas las subcategorías a la vista
        'clasification'=>$clasification,
    ]);
}



public function showProducts2(Request $request, $subcategoria = null)
{
    $categories = Category::all();
    $dolarPrice = $this->getBanxicoData();
    $order = $request->input('orden', 'descendente'); // Obtener el valor del parámetro de ordenamiento, por defecto 'descendente'
    $selectedBrands = $request->input('marca', []); // Obtener las marcas seleccionadas

    
    // Obtener todos los productos de la clasificación inicial si no se selecciona una subcategoría específica
    $productsQuery = Product::query();
    if (!$subcategoria) {
        $productsQuery->whereNotNull('clasification_id'); // Filtrar por clasificación inicial
    } else {
        // Aplicar filtro por subcategoría si se selecciona una
        $productsQuery->where('subcategoria_id', $subcategoria);
    }

    // Aplicar el ordenamiento a la consulta
    if ($order === 'ascendente') {
        $productsQuery->orderBy('precio', 'asc');
    } else {
        $productsQuery->orderBy('precio', 'desc');
    }

   
    // Obtener los productos con las condiciones aplicadas
    $products = $productsQuery->get();
 // Aplicar filtro por marcas seleccionadas, si hay alguna

 if (!empty($selectedBrands)) {
    $products = $products->whereIn('brand_id', $selectedBrands);
}
    // Obtener las subcategorías de los productos actuales
    $productSubcategories = $products->pluck('subcategoria_id')->unique()->values()->all();

    // Obtener las subcategorías que corresponden a los productos actuales
    $subcategoriaseleccionada = Subcategoria::whereIn('id', $productSubcategories)->get();


    $marcaseleccionada = $products->pluck('brand_id')->unique()->values()->all();
    // Obtener todas las subcategorías disponibles (si es necesario)
    $subcategorias = Category::with('clasificaciones')->get();

    // Pasar datos a la vista
    return view('productsclasi2', [
        'products' => $products,
        'categories' => $categories,
        'dolarPrice' => $dolarPrice,
        'order' => $order,
        'subcategoria' => $subcategoria, // Pasar la subcategoría seleccionada a la vista
        'subcategoriaseleccionada' => $subcategoriaseleccionada,
        'subcategorias' => $subcategorias,
        'marcaseleccionada' => $marcaseleccionada, // Pasar todas las subcategorías a la vista
    ]);
}







public function showProductsBrand(Request $request, $clasification = null)
{
    $categories = Category::all();
    $dolarPrice = $this->getBanxicoData();
    $order = $request->input('orden', 'descendente'); // Obtener el valor del parámetro de ordenamiento, por defecto 'descendente'
    $selectedBrands = $request->input('marca', []); // Obtener las marcas seleccionadas
    $subcategoriaseleccionada = $request->input('subcategoria', []);


    
     // Obtener todos los productos de la clasificación inicial si no se selecciona una subcategoría específica

    // Obtener todos los productos de la clasificación inicial (sin filtrar por subcategoría)
    $productsQuery = Product::where('clasification_id', $clasification);

    

    if (!$subcategoriaseleccionada) {
        $productsQuery->whereNotNull('clasification_id'); // Filtrar por clasificación inicial
    } else {
        // Aplicar filtro por subcategoría si se selecciona una
        $productsQuery->where('subcategoria_id', $subcategoriaseleccionada);
    }
    
    // Aplicar el ordenamiento a la consulta
    if ($order === 'ascendente') {
        $productsQuery->orderBy('precio', 'asc');
    } else {
        $productsQuery->orderBy('precio', 'desc');
    }

    // Obtener los productos con las condiciones aplicadas
    $products = $productsQuery->get();

    // Aplicar filtro por marcas seleccionadas, si hay alguna
    if (!empty($selectedBrands)) {
        $products = $products->whereIn('brand_id', $selectedBrands);
    }

   
    
    // Filtrar las marcas seleccionadas para mostrar solo las que están presentes en los productos actuales
    $marcaseleccionada = $products->pluck('brand_id')->unique()->values()->all();

    // Obtener las subcategorías de los productos actuales
    $productSubcategories = $products->pluck('subcategoria_id')->unique()->values()->all();

    // Obtener las subcategorías que corresponden a los productos actuales
    $subcategoriaseleccionada = Subcategoria::whereIn('id', $productSubcategories)->get();

    // Obtener todas las subcategorías disponibles (si es necesario)
    $subcategorias = Category::with('clasificaciones')->get();

    // Pasar datos a la vista


    
    return view('productsclasi3', [
        'products' => $products,
        'categories' => $categories,
        'dolarPrice' => $dolarPrice,
        'order' => $order,
        'clasification' => $clasification,
        'marcaseleccionada' => $marcaseleccionada,
        'subcategoriaseleccionada' => $subcategoriaseleccionada,
        'subcategorias' => $subcategorias,
    ]);
}























}
