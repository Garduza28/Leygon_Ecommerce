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
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Dompdf\Dompdf;
use Dompdf\Options;

class ProductAdminController extends Controller
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
    public function index()
    {
        if (Auth::check()) {
            $tipo_usuario = Auth::user()->tipo_usuario;

            if ($tipo_usuario == 0) {
                return redirect()->route('home')->with('error', 'Acceso no autorizado');
            } elseif ($tipo_usuario == 1) {
                $categories = Category::all();
                $products = Product::all();
                $clasifications = Clasifications::all();
                $subcategorias = Subcategoria::all();
                return view('/admin/products/create', compact('products', 'categories', 'clasifications','subcategorias'));
            }
        }
    }
    public function create()
    {
        $products = Product::with('category')->get();


        $categories = Category::all();
        $dummyCategory = new Category(['id' => null, 'name' => 'Seleccionar categoría']);
        $categories->prepend($dummyCategory);
        $selectedCategoryId = old('category_id');

        $clasifications = Clasifications::all(); // Asegúrate de que la clase se llame correctamente
        $dummyClasi = new Clasifications(['nombre' => null, 'name' => 'Seleccionar clasificacion']);
        $clasifications->prepend($dummyClasi);
        $selectedClasiId = old('clasification_id');

        $subcategorias = Subcategoria::all(); // Asegúrate de que la clase se llame correctamente
        $dummyClasi = new Subcategoria(['nombre' => null, 'name' => 'Seleccionar subcategoria']);
        $subcategorias->prepend($dummyClasi);
        $selectedSubId = old('subcategoria_id');


        $brands = brands::all(); // Asegúrate de que la clase se llame correctamente
        $dummyBrand = new brands(['id' => null, 'name' => 'Seleccionar marca']);
        $brands->prepend($dummyBrand);
        $selectedBrandId = old('brand_id');



        return view('admin.products.create', compact('products', 'categories','brands','subcategorias','clasifications','selectedCategoryId', 'selectedClasiId','selectedBrandId','selectedSubId'));
    }

    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'producto_id' => 'required|numeric',
            'modelo' => 'required|string',
            'total_existencia' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'sat_key' => 'required|string|max:255',
            'img_portada' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'precio' => 'required|numeric',
            'descripcion' => 'required|string|max:255',
            'marca_logo' => 'required|string|max:255',
            'existencia_nuevo' => 'required|numeric',
            'category_id' => 'required|string|max:255',
            'clasification_id' => 'required|string|max:255',
            'subcategoria_id' => 'required|numeric',

        ]);


        $productData = $request->except('image_path');

        if ($request->hasFile('img_portada')) {
            $originalName = $request->file('img_portada')->getClientOriginalName();
            $uniqueName = $this->generateUniqueName($originalName);
            $imagePath = $request->file('img_portada')->storeAs('images', $uniqueName, 'public');
            $productData['img_portada'] = basename($imagePath);
        }





        $product = Product::create($productData);


        return redirect()->route('admin.products.create')->with('success', 'Producto creado correctamente');
    }

    protected function generateUniqueName($originalName)
{
    $fileName = pathinfo($originalName, PATHINFO_FILENAME);
    $extension = pathinfo($originalName, PATHINFO_EXTENSION);

    // Agrega un sufijo único (usando un timestamp y un hash aleatorio para mayor unicidad).
    $uniqueName = $fileName . '_' . time() . '' . Str::random(3) . '.' . $extension;

    return $uniqueName;
}



public function edit($id)
{
    $producto = Product::find($id);
    $categories = Category::all();
    $brands= brands::all();

    return view('admin.products.edit', compact('producto', 'brands','categories'));
}


    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'producto_id' => 'required|numeric',
            'modelo' => 'required|string',
            'total_existencia' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'sat_key' => 'required|string|max:255',
            'img_portada' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'precio' => 'required|numeric',
            'descripcion' => 'required|string|max:255',
            'marca_logo' => 'required|string|max:255',
            'existencia_nuevo' => 'required|numeric',
            'category_id' => 'required|string|max:255',
            'clasification_id' => 'required|string|max:255',
            'subcategoria_id' => 'required|numeric',

        ]);


        $productData = $request->except('image_path');

        if ($request->hasFile('img_portada')) {
            $originalName = $request->file('img_portada')->getClientOriginalName();
            $uniqueName = $this->generateUniqueName($originalName);
            $imagePath = $request->file('img_portada')->storeAs('images', $uniqueName, 'public');
            $productData['img_portada'] = basename($imagePath);
        }

        $product->save();
        $product->update($validatedData);


        return redirect()->route('admin.products.create')->with('success', 'Producto actualizado correctamente');
    }

    public function destroy(Product $product)
    {

        $product->delete();


        return redirect()->route('admin.products.create')->with('success', 'Producto eliminado correctamente');
    }






    public function createCategory()
    {
        $categories = Category::all();
        return view('admin.products.createcategory', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:categories,slug',
            'description' => 'required|string',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $categoryData = $request->except('image_path');

        if ($request->hasFile('image_path')) {
            $originalName = $request->file('image_path')->getClientOriginalName();
            $uniqueName = $this->generateUniqueName($originalName);
            $imagePath = $request->file('image_path')->storeAs('images', $uniqueName, 'public');
            $categoryData['image_path'] = basename($imagePath);
        }

        $category = Category::create($categoryData);

        return redirect()->route('admin.createCategory')->with('success', 'Categoría creada correctamente');
    }


    public function createBrand()
{
    return view('admin.products.createmarcas');
}

    public function storebrand (Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $brandData = $request->except('image_path');

    if ($request->hasFile('image_path')) {
        $originalName = $request->file('image_path')->getClientOriginalName();
        $uniqueName = $this->generateUniqueName($originalName);
        $imagePath = $request->file('image_path')->storeAs('images', $uniqueName, 'public');
        $brandData['image_path'] = basename($imagePath);
    }



    $category = brands::create($brandData);

    return redirect()->route('admin.createBrand')->with('success', 'Marca creada exitosamente.');
}

public function createClasification()
{
    return view('admin.products.createclasificacion');
}

    public function storeclasification (Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $clasificationData = $request->except('image_path');

    if ($request->hasFile('image_path')) {
        $originalName = $request->file('image_path')->getClientOriginalName();
        $uniqueName = $this->generateUniqueName($originalName);
        $imagePath = $request->file('image_path')->storeAs('images', $uniqueName, 'public');
        $clasificationData['image_path'] = basename($imagePath);
    }



    $category = clasifications::create($clasificationData);

    return redirect()->route('admin.createClasification')->with('success', 'Marca creada exitosamente.');
}

public function verTabla(Request $request)
{
    $perPage = $request->input('perPage', 10);
    $products = Product::paginate($perPage);

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

    return view('admin.products.ver-tabla', compact('products'));
}


public function generarCatalogoPdf(Request $request)
{
    // Obtener los productos con brand_id igual a "SYSCOM"
    $products = Product::where('brand_id', 'SYSCOM')->get();

    // Crear una instancia de Dompdf
    $dompdf = new Dompdf();

    // Contenido HTML del catálogo
    $html = '<html><body>';

    foreach ($products as $product) {
        // Construir el contenido para cada producto
        $html .= '<div style="display: flex; margin-bottom: 20px;">';
        $html .= '<div><img src="' . $product['img_portada'] . '" alt="' . $product['titulo'] . '" id="img_portada" name="img_portada"></div>';
        $html .= '<div style="flex: 2; padding-left: 20px;">';
        $html .= '<p><strong>Nombre:</strong> ' . $product->titulo . '</p>';
        $html .= '<p><strong>Precio:</strong> ' . $product->precio . '</p>';
        $html .= '<p><strong>Descripción:</strong> ' . $product->descripcion . '</p>';
        // Aquí puedes agregar más información del producto según sea necesario

        // Añadir el código QR (asumiendo que tienes el campo qr en tu modelo de Product)
        $html .= '<img src="' . $product->qr . '" width="100">';
        $html .= '</div>';
        $html .= '</div>';
    }

    $html .= '</body></html>';

    // Establecer el contenido HTML en Dompdf
    $dompdf->loadHtml($html);

    // Opcional: establecer opciones de Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $dompdf->setOptions($options);

    // Renderizar el PDF
    $dompdf->render();

    // Descargar el PDF
    return $dompdf->stream('catalogo.pdf');
}




}
