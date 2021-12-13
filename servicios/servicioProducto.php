<?php

// include("../Controllers/nuevoControlador.php");

class ServicioProducto
{
  public function PostProducto($moneda, $destinolimpioId, $date)
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.sandbox.viator.com/partner/products/search',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => '
            {
              "filtering": {
                "destination": "' . $destinolimpioId . '",
                "startDate": "' . $date . '"
              },
              "pagination": {
                "start": 10,
                "count": 50
                },
              "currency": "' . $moneda . '"
            }',
      CURLOPT_HTTPHEADER => array(
        'exp-api-key: 1944b0f7-5b90-46a4-afae-cb1fcaa98604',
        'Accept: application/json;version=2.0',

        'Accept-Language: es-ES',
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
  }
}
