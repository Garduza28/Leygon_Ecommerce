<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaccionController extends Controller


{



    public function create()
    {
        // Aquí puedes calcular el hashExtended con valores predeterminados
        $chargetotal = '13.00';
        $checkoutoption = 'combinedpage';
        $currency = '484';
        $hash_algorithm = 'HMACSHA256';
        $responseFailURL = 'https://localhost:8643/webshop/response_failure.jsp';
        $storename = '62666666';
        $timezone = 'America/Mexico_City';
        $txndatetime = date('Y:m:d-H:i:s');
        $txntype = 'sale';
        $sharedsecret = 'TopSecret';

        $stringToExtendedHash = "$chargetotal|$checkoutoption|$currency|$hash_algorithm|$responseFailURL|$storename|$timezone|$txndatetime|$txntype";
        $calculatedHash = hash_hmac('sha256', $stringToExtendedHash, $sharedsecret, true);
        $hashExtended = base64_encode($calculatedHash);

        // Luego pasas $hashExtended a la vista
        return view('checkout')->with(['hashExtended' => $hashExtended]);

    }



    public function procesarTransaccion(Request $request)
    {
           // Paso 1: Crear string para hash
           $stringToExtendedHash = implode('|', [
            $request->input('chargetotal'),
            $request->input('checkoutoption'),
            $request->input('currency'),
            $request->input('hash_algorithm'),
            $request->input('responseFailURL'),
            $request->input('responseSuccessURL'),
            $request->input('storename'),
            $request->input('timezone'),
            $request->input('txndatetime'),
            $request->input('txntype')
        ]);
      
        // Paso 2: Encriptar el string
        $sharedSecret = 'HqSx)45>np'; // Tu shared secret
        $hashedValue = hash_hmac("sha256", $stringToExtendedHash, $sharedSecret, true);
        
        // Paso 3: Codificar el valor en Base64
     
        $base64EncodedHash = base64_encode($hashedValue);

        // Retornar el hash generado
        return $base64EncodedHash;
    }

    public function validateHash(Request $request)
    {
        // Paso 1: Generar el string para validar
        $responseString = $request->input('approval_code') . '|' .
            $request->input('chargetotal') . '|' .
            $request->input('currency') . '|' .
            $request->input('txndatetime') . '|' .
            $request->input('storename');

        // Paso 2: Encriptar el string
        $sharedSecret = 'HqSx)45>np'; // Tu shared secret
        $responseHash = hash_hmac("sha256", $responseString, $sharedSecret, true);

        // Paso 3: Codificar el valor en Base64
        $responseHashBase64 = base64_encode($responseHash);

        // Comparar con el valor recibido
        $receivedResponseHash = $request->input('response_hash');
        if ($responseHashBase64 === $receivedResponseHash) {
            // La información proviene de Fiserv
            return 'La información proviene de Fiserv';
        } else {
            // La información podría ser maliciosa
            return 'La información podría ser maliciosa';
        }
    }
}
    

