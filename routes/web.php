<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\PedidosController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\BanxicoController;
use App\Http\Controllers\TopbarController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\DevolucionController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SyscomController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClasificacionController;
use App\Http\Controllers\SubcategoriaController;
use App\Http\Controllers\TransaccionController;
use App\Http\Controllers\MonedaController;
use App\Http\Controllers\ProductoController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.applyCoupon');

Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.applyCoupon');

Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::get('/auth/facebook', [AuthController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/auth/facebook/callback', [AuthController::class, 'handleFacebookCallback']);
Route::get('/brands/{brandId}', [TopbarController::class, 'showBrands'])->name('brands.show');
Route::get('/brands/{brand}', [TopbarController::class, 'showBrandsByBrand']);
Route::get('/cateproducts/{categoria}', [TopbarController:: class, 'index'])->name('productos.index');
Route::any('payment/success', [PaymentController::class, 'success'])->name('payment.success');

Route::post('payment/failure', [PaymentController::class,'failure'])->name('payment.failure');


Route::prefix('admin')->group(function () {
    Route::get('/products', [ProductAdminController::class, 'index'])->name('admin.products.index');
    // Otras rutas para el controlador ProductAdminController
});
Route::get('/auth/redirect/{provider}', [AuthController::class, 'redirectToProvider'])
->name('auth.redirect');

Route::get('/auth/callback/{provider}', [AuthController::class, 'handleProviderCallback'])
->name('auth.callback');


Route::get('/products/category/{category}/search', [CartController::class, 'searchInCategory'])->name('products.category.search');

Route::get('/products/category/{category}/{orderBy?}', [CartController::class, 'showProductsOrden'])
    ->name('products.category.show');

Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [PerfilController::class, 'mostrarFormulario'])->name('perfil.formulario');
    Route::put('/perfil', [PerfilController::class, 'actualizarDatos'])->name('perfil.actualizar');
    Route::post('/perfil/subir-o-actualizar-imagen', [PerfilController::class, 'subirOActualizarImagen'])->name('perfil.subirOActualizarImagen');

});
Route::get('/', [CartController::class, 'navcategory'])->name('navcategory');
Route::get('/', [CartController::class, 'shop'])->name('shop');
Route::get('/cart', [CartController::class, 'cart'])->name('cart.index');
Route::post('/add', [CartController::class, 'add'])->name('cart.store');
Route::post('/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/producto/{id}', [CartController::class, 'show'])->name('cart.show');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/process-checkout', [CartController::class, 'processCheckout'])->name('process.checkout');
Route::get('/search', [CartController::class, 'search'])->name('search.products');
Route::get('/categories', [CartController::class, 'index'])->name('categories.index');
Route::get('/products/category/{category}', [CartController::class, 'showProducts'])
    ->name('products.category');
    Route::get('/redirect-to-success', [LoginController::class, 'redirectToSuccess'])->name('redirect.to.success');

    Route::get('/clasifications', [CartController::class, 'indexclasi'])->name('clasifications.indexclasi');



    Route::post('/save-cookie', [LoginController::class, 'guardarValorCookie'])->name('save.cookie');

    Route::middleware(['auth'])->group(function () {
        Route::get('/home', [HistorialController::class, 'history'])->name('home');
        Route::get('compras/{compra}/devoluciones/create', [DevolucionController::class, 'create'])->name('devoluciones.create');
        Route::post('compras/{compra}/devoluciones', [DevolucionController::class, 'store'])->name('devoluciones.store');
    });



    Route::get('/products/clasification/{clasification}', [CartController::class, 'showProductsClasi'])   ->name('products.clasification');



        Route::get('/detalles_productos/{id}', [CartController::class, 'show'])->name('detalles_productos');

        Route::get('/productos/{id}/revisiones', [ReviewController::class, 'index'])->name('productos.revisiones');
        Route::post('/productos/{id}/revisiones', [ReviewController::class, 'store'])->name('reviews.store');


        // $user->token
// Rutas Login Facebook y Google
Auth::routes();

Route::get('/home', [App\Http\Controllers\CartController::class, 'index'])->name('home');




Route::prefix('admin')->group(function () {
    Route::resource('products', ProductAdminController::class);
});

Route::prefix('admin')->middleware(['check.tipo_usuario'])->group(function () {
    Route::get('/products', [ProductAdminController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductAdminController::class, 'create'])->name('admin.products.create');
    Route::get('/ver-tabla', [ProductAdminController::class, 'verTabla'])->name('admin.ver-tabla');
    Route::post('/products/store', [ProductAdminController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{product}/edit', [ProductAdminController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}/update', [ProductAdminController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}/destroy', [ProductAdminController::class, 'destroy'])->name('admin.products.destroy');


    Route::get('createCategory', [ProductAdminController::class,'createCategory'])->name('admin.createCategory');
    Route::post('storeCategory', [ProductAdminController::class, 'storeCategory'])->name('admin.storeCategory');

    Route::get('createBrand', [ProductAdminController::class,'createBrand'])->name('admin.createBrand');
    Route::post('storebrand', [ProductAdminController::class, 'storeBrand'])->name('admin.storebrand');

    Route::get('createClasification', [ProductAdminController::class,'createClasification'])->name('admin.createClasification');
    Route::post('storeclasification', [ProductAdminController::class, 'storeclasification'])->name('admin.storeclasification');
    Route::get('coupons', [CouponController::class, 'index'])->name('coupons.index');
    Route::get('coupons/create', [CouponController::class, 'create'])->name('coupons.create');
    Route::post('coupons/store', [CouponController::class, 'store'])->name('coupons.store');
    Route::get('coupons/{coupon}/edit', [CouponController::class, 'edit'])->name('coupons.edit');
    Route::put('coupons/{coupon}/update', [CouponController::class, 'update'])->name('coupons.update');
    Route::delete('coupons/{coupon}/destroy', [CouponController::class, 'destroy'])->name('coupons.destroy');

    Route::get('devoluciones', [DevolucionController::class, 'index'])->name('admin.devoluciones');


    Route::put('/admin/pedidos/{id}', [PedidosController::class, 'update'])->name('admin.pedidos.update');

    Route::get('index_pedidos', [PedidosController::class, 'index'])->name('admin.index_pedidos.index');
    Route::get('pedidos/{id}', [PedidosController::class, 'show'])->name('admin.pedidos.show');


});
Route::get('informacion', function(){
    return view('information.information');



});




Route::get('/banxico-data', [BanxicoController::class, 'getBanxicoData']);

Route::get('/brands/{brand}', [TopbarController::class, 'showBrands'])->name('show.brands');


Route::get('/obtener-categorias', [SyscomController::class, 'obtenerCategorias'])->name('obtener.categorias');
Route::get('/obtener-detalles-producto/{productoId}', [CartController::class, 'obtenerDetallesProducto'])
    ->name('obtener.detalles.producto');

    Route::get('/categoria/{id}', [SyscomController::class, 'obtenerCategoria']);
    Route::get('/buscar-productos', [SyscomController::class, 'buscarProductos']);

    Route::get('/obtener-marcas', [SyscomController::class, 'obtenerMarcas'])->name('obtener.categorias');

    Route::get('get-classifications-by-category', [CartController::class, 'getClassificationsByCategory'])->name('get.classifications.by.category');

    Route::get('/vista_clasi/{categoryId}/classifications', [CartController::class, 'showClassifications'])
        ->name('vista_clasi');

        Route::get('/subcategorias/{clasificacionId}',[CartController::class, 'getSubcategorias'])->name('subcategorias');
        Route::get('/productos/subcategoria/{subcategoriaId}', [CartController::class, 'getProductosPorSubcategoria']);

       Route::get('/clasifications/{categoryId}', [CartController::class, 'getClasifications'])->name('clasifications');


       Route::get('/navindexclasi', [CartController::class, 'navindexclasi']);

       Route::get('/informacion', [CartController::class, 'vistaInformation'])->name('categories');


       Route::get('/productos/subcategoria/{subcategoriaId}', [CartController::class, 'getCategories'])->name('categories');

       Route::get('/subcategorias/{clasificacionId}',[CartController::class, 'getSubcategorias'])->name('subcategorias');


       Route::post('/actualizar-datos', [PerfilController::class, 'actualizarDatos2'])->name('actualizar.datos');
Route::get('/obtener-clasificaciones/{category}',[ClasificacionController:: class, 'obtenerClasificaciones']);
Route::get('/obtener-subcategorias/{clasifications}',[SubcategoriaController:: class,'obtenerSubcategorias']);

Route::post('/procesar-transaccion', [TransaccionController::class, 'procesarTransaccion'])
    ->name('procesar.transaccion');


    Route::get('/buscar-productos', [ProductoController::class, 'buscar']    )->name('buscar.productos');



Route::get('/products', [ProductoController::class, 'index'])->name('products.index');
Route::get('/products/filter/{category}', [ProductoController::class, 'filterByCategory'])->name('products.filter');



Route::get('/productos/{subcategoria?}', [ProductoController::class, 'showProducts'])->name('products');
// En tu archivo de rutas (web.php o routes.php)


Route::get('/productos-clasi/{subcategoria?}', [ProductoController::class, 'showProducts2']    )->name('productos.clasi');


Route::get('/productos-brand/{clasification?}', [ProductoController::class, 'showProductsBrand']    )->name('productos.brand');
Route::get('/cambiar-moneda', [MonedaController::class, 'cambiarMoneda'])->name('cambiar.moneda');
Route::get('/historial_compras', [HistorialController::class, 'history']);
Route::get('/buscar', [ProductoController::class, 'buscar'])->name('buscar');








