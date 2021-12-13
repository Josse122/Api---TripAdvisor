$(document).ready(function() {
    $('#example').DataTable( {
        "sAjaxSource": "../Controllers/ProductoController.php"
    } );
} );
