<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class MonedaController extends Controller
{
    public function cambiarMoneda(Request $request)
    {
        // Obtenemos los datos de Banxico
        $banxicoData = $this->getBanxicoData();

        // Verificamos si se obtuvieron los datos exitosamente
        if ($banxicoData['status'] === 'success') {
            // Extraemos el tipo de cambio
            $tipoCambio = $banxicoData['banxico_data'][0]['datos'][0]['dato'];

            // Guardamos el tipo de cambio en la sesión para recordarlo
            $request->session()->put('tipoCambio', $tipoCambio);
            
            // Imprimir el tipo de cambio en el registro
            info('Tipo de cambio actual:', ['tipoCambio' => $tipoCambio]);
            
            // Devolver el tipo de cambio como respuesta JSON
            return response()->json(['status' => 'success', 'tipoCambio' => $tipoCambio]);
}  }

    private function getBanxicoData()
    {
        $token = 'e889e709468a6aaa424c5df9d670b587cfa37c2ba3a11d38274eac55076e1cd8';

        $response = Http::withHeaders([
            'Bmx-Token' => $token,
        ])->get('https://www.banxico.org.mx/SieAPIRest/service/v1/series/SF43718/datos/oportuno');

        $data = $response->json();

        return $data;
    }
}
