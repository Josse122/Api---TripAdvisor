<?php

include("../servicios/servicioDestinos.php");

$servicioDestinos = new ServicioDestino();
$getCountry = $servicioDestinos->GetCountry();
$getCountryJson = json_decode($getCountry, true);


$destinationName = $_POST["destinationName"];
// $holanda="holanda";    

//------------------------------------------LIMPIEZA ENTRADA USUARIOS---------------------------------------------------

// Quita los espacios
$destinolimpio2 = str_replace(" ", "", $destinationName);
// Remplaza la ñ por n
$destinolimpio3 = str_replace("ñ", "n", $destinolimpio2);
//Remplaza los caracteres especiales
$destinolimpio4 = str_replace(
    array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
    array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
    $destinolimpio3
);
$destinolimpio5 = str_replace(
    array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
    array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
    $destinolimpio4
);
$destinolimpio6 = str_replace(
    array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
    array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
    $destinolimpio5
);
$destinolimpio7 = str_replace(
    array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
    array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
    $destinolimpio6
);
$destinolimpio8 = str_replace(
    array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
    array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
    $destinolimpio7
);
//Transforma las mayusculas a minuscula
$destinolimpio9 = strtolower($destinolimpio8);


//-----------------------------------------------LIMPIEZA DATA----------------------------------------------------------

$destinolimpio = "";
$VarDestinos = array();
for ($i = 0; $i < count($getCountryJson["data"]); $i++) {





    $datoslimpios2 = str_replace("ñ", "n", $getCountryJson["data"][$i]["destinationName"]);
    $datoslimpios4 = str_replace(" ", "", $datoslimpios2);
    $datoslimpios5 = str_replace(
        array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
        array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
        $datoslimpios4
    );
    $datoslimpios6 = str_replace(
        array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
        array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
        $datoslimpios5
    );
    $datoslimpios7 = str_replace(
        array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
        array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
        $datoslimpios6
    );
    $datoslimpios8 = str_replace(
        array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
        array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
        $datoslimpios7
    );
    $datoslimpios9 = str_replace(
        array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
        array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
        $datoslimpios8
    );
    $datoslimpios10 = strtolower($datoslimpios9);
    $getCountryJson["data"][$i]["destinationName"] = $datoslimpios10;


    if (str_contains($getCountryJson["data"][$i]["destinationName"], "holanda")) {
        $VarDestinos = $getCountryJson["data"][$i];

        // print_r($VarDestinos);
    }

    if ($destinolimpio9  ==  $getCountryJson["data"][$i]["destinationName"]) {
        $destino = $getCountryJson["data"][$i]["destinationName"];
        $id_destino = $getCountryJson["data"][$i]["destinationId"];
        $destinolimpioId = $id_destino;
    }
}
return $destinolimpioId;
