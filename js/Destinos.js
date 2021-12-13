console.log("ENTRO");
$('#formularioConsulta').on('submit', function (e) {
    e.preventDefault();
    var form = document.getElementById("formularioConsulta");
    var values = new FormData(form);
    console.log(values)
    $.ajax({
        url: './Controllers/DestinosController.php',
        type: 'GET',
        processData: false,
        contentType: false,
        data: values,
        success: function (response, status, xhr, $form) {
            console.log(response);
            alert("Confirm!");
        },
        error: function (response) {
            console.log(response);
            alert("Error");
           
        }
    });

});