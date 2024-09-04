<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class BanxicoController extends Controller
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

    public function productsclasi()
    {
        // Llama a getBanxicoData() para obtener el precio del dólar
        $dolarPrice = $this->getBanxicoData();

        // Pasa el precio del dólar a la vista productsclasi
        return view('productsclasi', ['dolarPrice' => $dolarPrice]);
    }
}



