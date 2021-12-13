<?php
include("../Controllers/ProductoController.php");
$templateCompleto = implode("", file("../templates/datatable.html"));
$templateCompleto = str_replace("[TABLE-PRODUCTOS]", $vistaTable, $templateCompleto);
echo $templateCompleto;
?>