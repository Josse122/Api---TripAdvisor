<?php

$templateFinal = implode("", file("./Templates/index.html"));

if (isset($_GET["message"]) == "failedSearch") {
    echo "Nop encontramos ese producto";
    echo $templateFinal;
} else {
    echo $templateFinal;
}
// if(isset($_GET["message"])){
// echo "No se ha encontrado su busqueda";
// }else{
// echo $templateFinal;
// }
