<?php
namespace App\Http\Controllers;

use App\Models\Clasifications;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Envio;
use App\Models\Review;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Subcategoria;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Models\Coupon;
use Illuminate\Support\Facades\Cache;

class CartController extends Controller
{






    public function obtenerToken()
    {
        $client = new Client();


        $response = $client->post('https://developers.syscom.mx/oauth/token', [
            'form_params' => [
                'client_id' => 'fOuxd92E8cAJr1lbnrzJ49VQiksd2O2v',
                'client_secret' => 'ONp5XC5iM4hztuGejBP6sLn6RKkkvhtPSfOLEIjh',
                'grant_type' => 'client_credentials',
            ],
        ]);



        $tokenData = json_decode($response->getBody(), true);



        $accessToken = $tokenData['access_token'];

        return $accessToken;
    }

    public function removee(Request $request): View
    {
        // Remove item from cart
        \Cart::removee($request->id);

        // Retrieve updated cart content and total
        $cartContent = \Cart::getContent();
        $total = \Cart::getTotal();

        // Render cart drop view
        $html = view('cart-drop')->with(['cartContent' => $cartContent, 'total' => $total])->render();

        return Response::json(['html' => $html], 200);
    }

    // Rest of your controller methods...

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

    public function productsclasi()
    {
        // Llama a getBanxicoData() para obtener el precio del dólar
        $dolarPrice = $this->getBanxicoData();

        // Pasa el precio del dólar a la vista productsclasi
        return view('productsclasi', ['dolarPrice' => $dolarPrice]);
    }



    public function shop()
{
    $cartContent = \Cart::getContent();

    // Obtener todas las categorías
    $categories = Category::all();

    // Obtener los productos más recientes
    $products = Product::orderBy('created_at', 'desc')->take(5)->get();

    // Obtener todos los productos con descuento
    $productos = Product::where('descuento', '>', 0)->take(5)->get();

    // Obtener la subcategoría de Drones
    // Obtener la subcategoría de Drones si existe
$subcategoriaDrones = Subcategoria::where('nombre', 'Drones')->first();
if ($subcategoriaDrones) {
    // Obtener los productos de la subcategoría de Drones
    $productosDrones = $subcategoriaDrones->products()->orderBy('created_at', 'desc')->take(6)->get();
} else {
    // En caso de que no exista la subcategoría de Drones, asignar una colección vacía
    $productosDrones = collect();
}


    // Obtener todas las subcategorías
    $subcategorias = Category::with('clasificaciones')->get();

    // Obtener el tipo de cambio del dólar
    $dolarPrice = $this->getBanxicoData();

    // Retornar la vista con las variables necesarias
    return view('categories', compact('categories', 'products', 'productos', 'productosDrones', 'subcategorias', 'cartContent', 'dolarPrice'));
}

    public function cart()
    {
        $cartCollection = \Cart::getContent();
        $categories = Category::all();
        $subcategorias = Category::with('clasificaciones')->get();
        $dolarPrice = $this->getBanxicoData();

        $totalPrice = \Cart::getTotal();

        if (\Cart::isEmpty()) {
            session()->forget(['coupon_discount_applied', 'coupon_code', 'coupon_discount_amount']);
        }

        $discountAmount = $this->calculateCouponDiscount();
        $totalPriceWithDiscount = $totalPrice - $discountAmount;

        return view('cart')->withTitle('E-COMMERCE STORE | CART')->with([
            'cartCollection' => $cartCollection,
            'categories' => $categories,
            'subcategorias' => $subcategorias,
            'totalPrice' => $totalPrice,
            'totalPriceWithDiscount' => $totalPriceWithDiscount,
            'discountAmount' => $discountAmount,
            'couponDiscountApplied' => $this->isCouponDiscountApplied(),
            'dolarPrice' => $dolarPrice,
        ]);
    }






    private function calculateCouponDiscount()
    {
        // Inicializar el descuento en 0 por defecto
        $discountAmount = 0;

        // Verificar si hay un cupón aplicado
        if ($this->isCouponDiscountApplied() && session()->has('coupon_discounts')) {
            $cartContent = \Cart::getContent();
            $discounts = session('coupon_discounts');

            // Sumar los descuentos individuales de cada producto
            foreach ($cartContent as $item) {
                if (isset($discounts[$item->id])) {
                    $discountAmount += $discounts[$item->id];
                }
            }
        }

        return $discountAmount;
    }


    private function isCouponDiscountApplied()
    {
        return session()->has('coupon_discount_applied') && session('coupon_discount_applied') === true;
    }

    public function checkout(Request $request)
    {
        $cartContent = \Cart::getContent();
        $categories = Category::all();
        $user = auth()->user();
        $totalPrice = \Cart::getTotal();

        session(['total_price' => $totalPrice]);

        $discountAmount = $this->calculateCouponDiscount();
        $totalPriceWithDiscount = $totalPrice - $discountAmount;

        return view('checkout', compact('cartContent', 'categories', 'user', 'totalPriceWithDiscount'));
    }

    public function applyCoupon(Request $request)
{
    // Verificar si el carrito está vacío
    if (\Cart::isEmpty()) {
        return redirect()->back()->with('error', 'No se puede aplicar un cupón en un carrito vacío.');
    }

    // Verificar si el descuento ya ha sido aplicado
    if (session()->has('coupon_discount_applied') && session('coupon_discount_applied') === true) {
        return redirect()->back()->with('error', 'El descuento ya ha sido aplicado.');
    }

    $couponCode = $request->input('coupon_code');
    $coupon = Coupon::where('codigo', $couponCode)->first();

    if (!$coupon) {
        return redirect()->back()->with('error', 'Cupón no válido.');
    }

    if ($coupon->cantidad_disponible <= 0) {
        return redirect()->back()->with('error', 'Cupón no disponible.');
    }

    // Obtener el usuario actual
    $user = auth()->user();

    // Verificar si el usuario ya ha utilizado este cupón
    if ($user->coupons->contains($coupon)) {
        return redirect()->back()->with('error', 'Este cupón ya ha sido utilizado por este usuario.');
    }

    // Calcular el descuento para cada producto en el carrito
    $cartContent = \Cart::getContent();
    $discounts = [];
    foreach ($cartContent as $item) {
        $discounts[$item->id] = $item->price * ($coupon->descuento / 100);
    }

    // Almacenar los descuentos aplicados a cada producto en la sesión
    session(['coupon_discounts' => $discounts]);
    session(['coupon_discount_applied' => true]);
    session(['coupon_code' => $couponCode]);

    return redirect()->back()->with('success', 'Cupón aplicado correctamente.');
}






public function removeFromCart(Request $request)
{
    $productId = $request->input('product_id');
    \Cart::remove($productId);

    // Eliminar el descuento aplicado al producto eliminado
    if (session()->has('coupon_discounts')) {
        $discounts = session('coupon_discounts');
        unset($discounts[$productId]);
        session(['coupon_discounts' => $discounts]);

        // Si no hay más productos en el carrito, reiniciar el estado del cupón
        if (empty($discounts)) {
            session()->forget(['coupon_discount_applied', 'coupon_code']);
        }
    }

    return redirect()->back()->with('success', 'Producto eliminado del carrito correctamente.');
}









    public function remove(Request $request){
        \Cart::remove($request->id);
        return redirect()->route('cart.index')->with('success_msg', 'Item is removed!');
    }
    public function add(Request $request)
    {
        // Obtener el valor del dólar
        $dolarPrice = $this->getBanxicoData();

        // Verificar si el precio proporcionado es válido y no es cero
        if (!isset($request->price) || $request->price == 0) {
            return redirect()->back()->with('error', 'El precio no se ha proporcionado correctamente.');
        }

        // Calcular el precio proporcionado en pesos mexicanos
        $precioProporcionadoEnPesos = $request->price * $dolarPrice;

        // Obtener el producto de la base de datos
        $productoBD = Product::find($request->id);

        if ($productoBD) {
            // Calcular el precio base en pesos mexicanos
            $precioBaseEnPesos = $productoBD->precio * $dolarPrice;

            // Calcular el precio con descuento en pesos mexicanos (si aplica)
            $precioConDescuentoEnPesos = $precioBaseEnPesos;
            if ($productoBD->descuento) {
                $descuento = $productoBD->descuento;
                $precioConDescuentoEnPesos = $precioBaseEnPesos * (1 - ($descuento / 100));
            }

            // Verificar si el precio proporcionado es igual al precio base o al precio con descuento
            if (round($precioProporcionadoEnPesos, 2) == round($precioBaseEnPesos, 2) || round($precioProporcionadoEnPesos, 2) == round($precioConDescuentoEnPesos, 2)) {
                // Agregar el producto al carrito
                if (Auth::check()) {
                    $cartItem = [
                        'id' => $request->id,
                        'name' => $request->name,
                        'price' => $precioProporcionadoEnPesos, // Usamos el precio proporcionado, ya validado y convertido a pesos
                        'quantity' => $request->quantity,
                        'attributes' => [
                            'image' => $request->img,
                            'slug' => $request->slug
                        ]
                    ];

                    \Cart::add($cartItem);

                    $userId = Auth::id();
                    $userCartKey = 'user_' . $userId . '_cart';

                    $userCart = Session::get($userCartKey, []);
                    $userCart[] = $cartItem;
                    Session::put($userCartKey, $userCart);

                    return redirect()->route('cart.index')->with('listo', 'Producto agregado correctamente');
                } else {
                    return redirect()->route('login')->with('error', 'Debe iniciar sesión para agregar productos al carrito');
                }
            } else {
                return redirect()->back()->with('error', 'El precio proporcionado no coincide con el precio del producto.');
            }
        } else {
            return redirect()->back()->with('error', 'El producto no fue encontrado en la base de datos.');
        }
    }
    public function update(Request $request){
        \Cart::update($request->id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
        ));
        return redirect()->route('cart.index')->with('success_msg', 'Cart is Updated!');
    }

    public function clear(){
        \Cart::clear();
        return redirect()->route('cart.index')->with('success_msg', 'Car is cleared!');
    }


    public function show($id)
    {
        $categories = Category::all();
        $product= Product::find($id);
        $dolarPrice = $this->getBanxicoData();
        if (!$product) {
            return redirect()->route('cart.shop')->with('error_msg', 'Producto no encontrado');
        }

        $productosMismaMarca = Product::where('brand_id', $product->brand_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        // Obtener productos relacionados basados en la misma categoría del producto actual
        $productosRelacionados = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder() // Orden aleatorio
            ->limit(4)
            ->get();

        // Obtener las revisiones del producto actual
        $reviews = $product->reviews()->with('user')->get();

        // Obtener el usuario (asumiendo que estás usando el usuario autenticado)
        $user = auth()->user();

        $subcategorias = Category::with('clasificaciones')->get();
        $totalReviews = $reviews->count();
        $starCounts = $reviews->groupBy('rating')->map->count();
        $starPercentages = [];

        for ($i = 1; $i <= 5; $i++) {
            $starPercentages[$i] = $totalReviews > 0 ? ($starCounts[$i] ?? 0) / $totalReviews * 100 : 0;
        }

        $totalStars = $reviews->sum('rating');
        // Calcular el porcentaje total de estrellas
        $totalStarPercentage = ($totalReviews > 0) ? ($totalStars / ($totalReviews * 5)) * 100 : 0;

        // Pasar $totalReviews a la vista
        return view('detalles_productos', compact('product', 'productosRelacionados', 'categories', 'productosMismaMarca', 'subcategorias', 'reviews', 'user', 'totalStarPercentage', 'totalReviews','dolarPrice'));
    }



    public function obtenerDetallesProducto($productoId)
    {

        $accessToken = $this->obtenerToken();




        $client = new Client();
        $response = $client->get("https://developers.syscom.mx/api/v1/productos/{$productoId}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);


        $detallesProducto = json_decode($response->getBody(), true);


        $response2 = $client->get("https://developers.syscom.mx/api/v1/productos/{$productoId}/relacionados", [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);

        $detallesProducto2 = json_decode($response2->getBody(), true);










       $categories = Category::all();
       $product = Product::where('producto_id', $productoId)->first();

       // Obtener las categorías y el precio en dólares
       $categories = Category::all();
       $dolarPrice = $this->getBanxicoData();

       // Verificar si el producto fue encontrado
       if (!$product) {
           return redirect()->route('cart.shop')->with('error_msg', 'Producto no encontrado');
       }

        $productosMismaMarca = Product::where('brand_id', $product->brand_id)
            ->where('id', '!=', $product->productoId)
            ->limit(4)
            ->get();

        // Obtener productos relacionados basados en la misma categoría del producto actual
        $productosRelacionados = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->productoId)
            ->inRandomOrder() // Orden aleatorio
            ->limit(4)
            ->get();

        // Obtener las revisiones del producto actual
        $reviews = $product->reviews()->with('user')->get();

        // Obtener el usuario (asumiendo que estás usando el usuario autenticado)
        $user = auth()->user();

        $subcategorias = Category::with('clasificaciones')->get();
        $totalReviews = $reviews->count();
        $starCounts = $reviews->groupBy('rating')->map->count();
        $starPercentages = [];

        for ($i = 1; $i <= 5; $i++) {
            $starPercentages[$i] = $totalReviews > 0 ? ($starCounts[$i] ?? 0) / $totalReviews * 100 : 0;
        }

        $totalStars = $reviews->sum('rating');
        // Calcular el porcentaje total de estrellas
        $totalStarPercentage = ($totalReviews > 0) ? ($totalStars / ($totalReviews * 5)) * 100 : 0;


        // Pasar $totalReviews a la vista
        return view('detalles_productos', compact('product', 'productosRelacionados', 'categories', 'productosMismaMarca', 'subcategorias', 'reviews', 'user', 'totalStarPercentage', 'totalReviews','dolarPrice','detallesProducto','detallesProducto2'));
    }







    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('name', 'LIKE', "%$query%")->get();

        return view('shop')->with(['products' => $products, 'query' => $query]);
    }
    public function index()
    {
        $categories = Category::all();
        $products = Product::Orderby('created_at', 'desc')->take(5)->get();
        $productos = Product::where('descuento', '>', 0)->get();
        $subcategorias = Category::with('clasificaciones')->get();
        $dolarPrice = $this->getBanxicoData();

        $subcategoriaDrones = Subcategoria::where('nombre', 'Drones')->first();
if ($subcategoriaDrones) {
    // Obtener los productos de la subcategoría de Drones
    $productosDrones = $subcategoriaDrones->products()->orderBy('created_at', 'desc')->take(6)->get();
} else {
    // En caso de que no exista la subcategoría de Drones, asignar una colección vacía
    $productosDrones = collect();

}

        foreach ($productos as $product) {
            // Calcula el precio con descuento
            $product->precio_con_descuento = $product->precio - ($product->precio * ($product->descuento / 100));
        }

        return view('categories', with(['productosDrones' => $productosDrones, 'categories' => $categories,'products' => $products, 'productos' => $productos, 'subcategorias' => $subcategorias,  'dolarPrice' => $dolarPrice]));
    }









    public function showProducts(Category $category)
    {

        $products = $category->products;

        return view('show_products', compact('products', 'category'));

    }
    public function searchInCategory(Category $category, Request $request)
{
    $query = $request->input('query');

    $products = $category->products()->where('name', 'LIKE', "%$query%")->get();

    return view('show_products', compact('products', 'category', 'query'));
}



public function indexclasi()
{
    $clasification = Clasifications::all();
    return view('categories', compact('clasification'));
}

public function navindexclasi()
{
    $categories = Category::all();
    dd($categories);
    return view('partials.navbar', compact('categories'));
}













public function getClassificationsByCategory(Request $request) {
    $categoryId = $request->input('category_id');
    $classifications = Clasifications::where('category_id', $categoryId)->get();

    // Renderiza la vista parcial de las clasificaciones y devuelve el HTML
    return view('partials.clasifications')->with('clasifications', $classifications);


}



public function showClassifications($categoryId)
{
    $category = Category::findOrFail($categoryId);
    $classifications = Clasifications::where('category_id', $categoryId)->get();


    return view('vista_clasi', compact('category', 'classifications'));


}
















public function showProductsOrden(Category $category, $orderBy = 'default')
{
    $products = $category->products();

    switch ($orderBy) {
        case 'price_asc':
            $products->orderBy('price', 'asc');
            break;
        case 'price_desc':
            $products->orderBy('price', 'desc');
            break;
        case 'discount':
            $products->where('discount', '>', 0)->orderBy('discount', 'desc');
            break;
        // Agrega más casos según sea necesario
        default:
            // Orden predeterminado o ninguna ordenación específica
            break;
    }

    $products = $products->get();

    return view('show_products', compact('products', 'category', 'orderBy'));
}

public function getSubcategorias($clasificacionId)
{
    $subcategorias = Subcategoria::where('clasification_id', $clasificacionId)->get();
    return response()->json($subcategorias);
}






public function getClasifications($categoryId)
{
    $clasifications = clasifications::where('category_id', $categoryId)->get();

    return response()->json($clasifications);
}







public function getProductosPorSubcategoria($subcategoriaId)
{
    $productos = Product::where('categoria_nivel3', $subcategoriaId)->get();

    return view('productsclasi', compact('productos'));
}






public function showProductsClasi(Clasifications $clasification)
{
    $products = Product::where('clasification_id', $clasification->id)->get();

    return view('productsclasi', compact('products', 'clasification'));
}
    // Aqui emepiecen a mandar los datos a todas las vistas
public function getCategories($subcategoriaId)
{
    $categories = category::all();
    $productos = Product::where('subcategoria_id', $subcategoriaId)->get();


    return view('productsclasi', compact('categories','productos'));
}

public function vistaInformation()
{
    $subcategorias = Category::with('clasificaciones')->get();

    return view('information.information', with([ 'subcategorias' => $subcategorias]));
}


}
