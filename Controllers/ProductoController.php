<?php

include("../servicios/ServicioProducto.php");
include("../Controllers/DestinoControlador.php");

session_start();

$servicioProducto = new ServicioProducto();



$moneda = $_POST["moneda"];
$date = $_POST["startDate"];
$postProducto = $servicioProducto->PostProducto($moneda, $destinolimpioId, $date);
$postProductoJson = json_decode($postProducto, true);

if($destinolimpioId == NULL){
    header("Location: ../index.php?message=failedSearch");
}
// var_dump($destinolimpioId);

$contProduct = $postProductoJson["products"];
$imgArray = [];
$tituloArray = [];
$descripcionArray = [];
$totalDescuentosArray = [];
$totalPrecioArray = [];
$flagsArray = [];
$TotalReviewArray = [];
$calificacionPromedioArray = [];
$productosCompleto = [];

for ($i = 0; $i < count($contProduct); $i++) {
    $imgAdd = $postProductoJson["products"][$i]["images"][0]["variants"][15]["url"];
    $tituloAdd = $postProductoJson["products"][$i]["title"];
    $decripcionAdd = $postProductoJson["products"][$i]["description"];
    $totalDescuentosAdd = $postProductoJson["products"][$i]["pricing"]["summary"]["fromPrice"];
    $totalPrecioAdd = $postProductoJson["products"][$i]["pricing"]["summary"]["fromPriceBeforeDiscount"];

    //-----------------------------------------------Cancelación----------------------------------------------
        if(isset($postProductoJson["products"][$i]["flags"][0])){
            $flagsAdd = $postProductoJson["products"][$i]["flags"][0];
        }
        else{
            $flagsAdd =  ("sin cancelación");
        }
    //-----------------------------------------------Review--------------------------------
        if(isset($postProductoJson["products"][$i]["reviews"]["totalReviews"])){
            $TotalReviewAdd = $postProductoJson["products"][$i]["reviews"]["totalReviews"];
        } else{
            $TotalReviewAdd="No hay reviews";
        }
    //---------------------------------------------Promedio Reviews--------------------------
        if(isset($postProductoJson["products"][$i]["reviews"]["combinedAverageRating"])){
            $calificacionPromedioAdd = $postProductoJson["products"][$i]["reviews"]["combinedAverageRating"]; 
        }
        else{
            $calificacionPromedioAdd = "No hay reviews";
        }


        array_push($imgArray, $imgAdd);
        array_push($tituloArray, $tituloAdd);
        array_push($descripcionArray, $decripcionAdd);
        array_push($totalDescuentosArray, $totalDescuentosAdd);
        array_push($totalPrecioArray, $totalPrecioAdd);
        array_push($flagsArray,$flagsAdd);
        array_push($TotalReviewArray,$TotalReviewAdd);
        array_push($calificacionPromedioArray,$calificacionPromedioAdd);
    }

    for ($i=0; $i < count($tituloArray) ; $i++) { 
        $bodyResultado = array( "imagen" => $imgArray[$i],
                                "titulo" => $tituloArray[$i], 
                                "descripcion" => $descripcionArray[$i], 
                                "total_descuento" => $totalDescuentosArray[$i], 
                                "total_precio" => $totalPrecioArray[$i], 
                                "total_reviews" => $TotalReviewArray[$i], 
                                "promedio_review" => $calificacionPromedioArray[$i], 
                                "cancelacion" => $flagsArray[$i]
                            );
        array_push($productosCompleto, $bodyResultado);
    }


    //----------------------------------------------Table------------------------------------------------
    $datoConcatenado = "";

    for ($i = 0; $i < count($productosCompleto); $i++) {

        if($i<$productosCompleto){
            $datoConcatenado .=
        "<table >".
        "<tr>".
            "<th >"."<img src=". $productosCompleto[$i]['imagen']." ></img>"."</th>".
            "<td>".
                "<table>".
                    "<tr>".
                        "<th>". $productosCompleto[$i]["titulo"] ."</th>".
                    "</tr>".
                "</table>".
                "<table >".
                    "<tr>".
                        "<td>". $productosCompleto[$i]["descripcion"] ."</td>".
                    "</tr>".
                "</table>".
                "<table >".
                    "<tr>".
                        "<td>"."Precio total: ".$productosCompleto[$i]["total_precio"]."</td>".
                        "<td>"."Descuento total: ".$productosCompleto[$i]["total_descuento"]."</td>".
                    "</tr>".
                "</table>".
            "</td>".
            "<td>".
                "<table>".
                    "<tr>".
                        "<td>".
                            "<td>"."Total reviews: ".$productosCompleto[$i]["total_reviews"]."</td>".
                            "<td>"."Promedio reviews: ".$productosCompleto[$i]["promedio_review"]."</td>".
                        "</td>".
                    "</tr>".
                "</table>".
                "<table>".
                    "<tr>".
                        "<td>".$productosCompleto[$i]["cancelacion"]."</td>".
                    "</tr>".
                "</table>".
            "</td>".
        "</tr>".
        "</table>";
        }
        // $datoConcatenado2 = $datoConcatenado;
    // print_r($datosConcatenados);
    // var_dump($datosConcatenados);
        // print_r($prueba);
        // print_r($stringTabla);
        // print_r("<button>" . $productosCompleto[$i]["titulo"] . "</button>");
    }

    $templateCompleto = implode("", file("../Templates/datatable.html"));

    $templateCompleto = str_replace("[TABLE-PRODUCTO]", $datoConcatenado, $templateCompleto);

    echo "<a href='../index.php'><---Volver a buscar</a>".$templateCompleto;

    // print_r($datoConcatenado2);
    // echo($datoConcatenado);
    // $tablasCompletas = "<tabla>"."<tablA<".""."".""."".n;
