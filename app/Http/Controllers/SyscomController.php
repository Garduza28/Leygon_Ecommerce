<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Category;
use App\Models\clasifications;
use App\Models\Subcategoria;
use App\Models\brands;
use App\Models\Product;

class SyscomController extends Controller
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

    public function obtenerCategorias()
    {
      
        $accessToken = $this->obtenerToken();

      
        $client = new Client();
        $response = $client->get('https://developers.syscom.mx/api/v1/categorias', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);

        // Decodifica el JSON de la respuesta
        $categorias = json_decode($response->getBody(), true);

        // Almacena la información en la base de datos utilizando el modelo Categoria
        foreach ($categorias as $categoria) {
            // Verifica si la categoría ya existe en la base de datos antes de intentar guardarla
            $categoriaModel = Category::firstOrNew(['nombre' => $categoria['nombre']], [
                'id' => $categoria['id'],
                'nivel' => $categoria['nivel'],
            ]);

            // Si la categoría no existe, la guardamos
            if (!$categoriaModel->exists) {
                $categoriaModel->save();
            }
        }

        // Obtén todas las categorías almacenadas en la base de datos
        $categoriasDesdeBD = Category::all();
      
        // Muestra la vista con las categorías
        return view('categorias', ['categorias' => $categoriasDesdeBD]);
    }






    public function obtenerCategoria($id)
    {
        $accessToken = $this->obtenerToken();

        $client = new Client();
        $response = $client->get("https://developers.syscom.mx/api/v1/categorias/{$id}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);
        
        
        $categoriaApi = json_decode($response->getBody(), true);
        // Almacena la información de la categoría principal utilizando el modelo Category
        foreach ($categoriaApi['origen'] as $origenApi) {
            
            // Busca la categoría de origen en la base de datos utilizando su ID
            $cateModel = Category::firstOrCreate(['nombre' => $origenApi['nombre']], [
                'id' => $origenApi['id'],
                'nivel' => $origenApi['nivel'],
               ]);

            // Si la categoría no existe, la crea
            if (!$cateModel->exists) {
                $cateModel->save();

            }


            // Guarda el ID de la categoría principal en una variable
            $categoriaId = $cateModel->id;


            // Almacena la información de la clasificación utilizando el modelo Clasifications
            $categoriaModel = Clasifications::firstOrCreate(['nombre' => $categoriaApi['nombre']], [
                'id' => $categoriaApi['id'],
                'nivel' => $categoriaApi['nivel'],
                'category_id' => $categoriaId, // Asigna el ID del origen
            ]);

            // Guarda la clasificación
            $categoriaModel->save();
        }


        // Obtén el ID de la categoría recién creada
        $categoriaId = $categoriaModel->id;

        // Almacena las subcategorías utilizando el modelo Subcategoria
        foreach ($categoriaApi['subcategorias'] as $subcategoriaApi) {
            // Verifica si 'nombre' existe en la estructura del JSON de subcategoría antes de intentar acceder a él
            if (isset($subcategoriaApi['id'])) {
                $subcategoriaModel = Subcategoria::firstOrNew(['nombre' => $subcategoriaApi['nombre']], [
                    'id' => $subcategoriaApi['id'],
                    'nivel' => $subcategoriaApi['nivel'],
                    'clasification_id' => $categoriaId, // Asocia la subcategoría con la categoría recién creada

                ]);
if (!$cateModel->exists) {
 $subcategoriaModel->save();

            } }


        }













        // Muestra la vista con los detalles de la categoría
        return view('categoria', ['categorias' => $categoriaApi]);
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

      
        return view('detalles_productosapi', ['detallesProducto' => $detallesProducto]);
    }









    public function buscarProductos2(Request $request)
    {
        // Obtén el token de acceso
        $accessToken = $this->obtenerToken();

        // Obtén el valor del parámetro de búsqueda del formulario web
        $busqueda = $request->input('busqueda', 'accesorios}}');  // Si no hay valor, usa una cadena vacía

        // Solicitud para obtener la lista de productos con el parámetro de búsqueda
        $client = new \GuzzleHttp\Client();
        $response = $client->get("https://developers.syscom.mx/api/v1/productos?busqueda=$busqueda&stock=1", [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);

        // Procesa la respuesta de la API y muestra la vista
        $productos = json_decode($response->getBody(), true);


        return view('vista_productos', ['productos' => $productos]);
    }















    public function buscarProductos(Request $request)
    {
        // Obtén el token de acceso


        $accessToken = $this->obtenerToken();

        // Obtén el valor del parámetro de búsqueda del formulario web
        $busqueda = $request->input('189989', '189989'); // Corregí el valor predeterminado

        // Solicitud para obtener la lista de productos con el parámetro de búsqueda
        $client = new \GuzzleHttp\Client();
        $response = $client->get("https://developers.syscom.mx/api/v1/productos?busqueda=$busqueda&stock=1", [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);

        // Procesa la respuesta de la API
        $productos = json_decode($response->getBody(), true);

        // Verifica si se devolvieron productos
        if (isset($productos['productos'])) {
            foreach ($productos['productos'] as $productoData) {
                // Verifica si el producto ya está guardado por el producto_id
                $productoExistente = Product::where('producto_id', $productoData['producto_id'])->first();
                if ($productoExistente) {
                    continue; // Si el producto ya está guardado, pasa al siguiente
                }

                // Crea un nuevo producto
                $producto = new Product();
                $producto->titulo = $productoData['titulo'];
                $producto->producto_id = $productoData['producto_id'];
                $producto->modelo = $productoData['modelo'];
                $producto->total_existencia = $productoData['total_existencia'];
                $producto->marca = $productoData['marca'];
                $producto->sat_key = $productoData['sat_key'];
                $producto->img_portada = $productoData['img_portada'];
                $producto->precio = isset($productoData['precios']['precio_1']) ? $productoData['precios']['precio_1'] : null;
                $producto->descripcion = $productoData['descripcion'] ?? null;
                $producto->marca_logo = $productoData['marca_logo'];
                $producto->existencia_nuevo = $productoData['existencia']['nuevo'];
                $producto->categoria_nivel3 = null; // inicializamos en null
                $producto->categoria_nivel2 = null; // inicializamos en null
                $producto->categoria_nivel1 = null; // inicializamos en null

                // Busca y guarda solo el nombre de la categoría de nivel 3 si existe
                if (isset($productoData['categorias'])) {
                    foreach ($productoData['categorias'] as $categoria) {
                        if ($categoria['nivel'] == 3) {
                            $producto->categoria_nivel3 = $categoria['id']; // Guardamos el nombre en la nueva columna
                            break; // Termina el bucle después de encontrar la primera categoría de nivel 3
                        }
                    }
                }

                if (isset($productoData['categorias'])) {
                    foreach ($productoData['categorias'] as $categoria) {
                        if ($categoria['nivel'] == 2) {
                            $producto->categoria_nivel2 = $categoria['nombre']; // Guardamos el nombre en la nueva columna
                            break; // Termina el bucle después de encontrar la primera categoría de nivel 3
                        }
                    }
                    if (isset($productoData['categorias'])) {
                        foreach ($productoData['categorias'] as $categoria) {
                            if ($categoria['nivel'] == 1) {
                                $producto->categoria_nivel1 = $categoria['nombre']; // Guardamos el nombre en la nueva columna
                                break; // Termina el bucle después de encontrar la primera categoría de nivel 3
                            }
                        }
                    }
                }

                $producto->save(); // Guarda el producto
            }
        }


        // Devuelve la vista con los productos
        return view('vista_productos', ['productos' => $productos]);
    }




    public function obtenerMarcas()
    {
        // Obtener el token de acceso
        $accessToken = $this->obtenerToken();

        // Solicitud para obtener las categorías
        $client = new Client();
        $response = $client->get('https://developers.syscom.mx/api/v1/marcas', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);

        // Decodifica el JSON de la respuesta
        $marcas = json_decode($response->getBody(), true);

        // Almacena la información en la base de datos utilizando el modelo Categoria
        foreach ($marcas as $marca) {
            // Verifica si la categoría ya existe en la base de datos antes de intentar guardarla
            $marcaModel = brands::firstOrNew(['nombre' => $marca['nombre']], [
                'id' => $marca['id'],
            ]);

            // Si la categoría no existe, la guardamos
            if (!$marcaModel->exists) {
                $marcaModel->save();
            }
        }

        // Obtén todas las categorías almacenadas en la base de datos
        $marcasDesdeBD = brands::all();

        // Muestra la vista con las categorías
        return view('marcas', ['marcas' => $marcasDesdeBD]);
    }




}