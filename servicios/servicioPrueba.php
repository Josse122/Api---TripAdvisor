<?php

include ("../servicios/ServicioProducto.php");

$servicioProducto = new ServicioProducto();
$moneda = $_POST["Moneda"];
print_r($_POST); 
$destinolimpio = $_POST["destinationName"];
$date = $_POST["startDate"];
$postProducto = $servicioProducto -> PostProducto($moneda,$destinolimpio,$date);
if (strpos($postProducto, "BAD_REQUEST")){
    print_r("algo salio mal");
}else{
    print_r($postProducto);
}
