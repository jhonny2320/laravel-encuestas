// Declara la variable id_servicio fuera de cualquier función para hacerla global
var id_servicio;
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // obtener el id del boton seleccionado
    $('#servicios button').click(function(){
        id_servicio = $(this).attr("value");
        var titulo = $(this).attr("title");
        // Limpiar los contenedores de locaciones y preguntas antes de cargar nuevos datos
        $(".modal-content").empty();
        if(id_servicio !== ''){
            $.ajax({
                url: '/encuestas/areas', // Esta es la URL a la que se envía la solicitud
                method: 'POST',
                data: { 
                    Servicio: id_servicio,
                    Titulo: titulo
                },
                beforeSend: function () {
                    $(".modal-content").html("Procesando, espere por favor...");
                    // $('#preguntas').modal('show');
                },
                success: function (response) {
                    // console.log('Response:', response);
                    $(".modal-content").html(response);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
                }
            });
        }
    });
});
//guardar la encuesta 
function guardar(tipo){
    // condicional dependiendo de donde se guarda el formulario
    if(tipo == 'general'){
        //validar que elija una encuesta
        if($('#encuesta').val()=="") {
            Swal.fire({
            icon: "error",
            title: "Error",
            text: "Debe seleccionar una encuesta"
            });
            return;
        }else{
            validar();
        }
    }    
    else{
       validar();
    }
}
function validar(){
    var valido=true;
    //recorrer cada grupo de preguntas para validar
    // Validar campos de radio buttons
    $('input[type="radio"]').each(function() {
        var name = $(this).attr('name');
        if ($('input[name="' + name + '"]:checked').length == 0) {
            valido = false;
            return false; // salir del each
        }
    });
     // Validar campos de checkboxes
     $('input[type="checkbox"]').each(function() {
        var name = $(this).attr('name');
        if ($('input[name="' + name + '"]:checked').length == 0) {
            valido = false;
            return false; // salir del each
        }
    });
    if (!valido) {
        Swal.fire({
            title: 'Error',
            text: 'Por favor, complete todos los campos antes de enviar.',
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    }else{
        var formData = $('#respuestas').serialize();
        // console.log(formData);
        $.ajax({
            type: 'POST',
            url: '/encuestas/guardar',
            data: formData,
            success: function(response) {
                if (response == 'Guardar') {
                    mostrarExito();
                } else {
                    mostrarError();
                }
            },
            error: function(xhr, error, status){
                console.error("Error en la llamada AJAX: " + error + ", " + status);
                swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Hubo un error al procesar tu solicitud. Por favor, intentalo de nuevo"
                });
            }
        });
    }
}
// cargar la encuesta en el modal por la opcion del select
function cargar_preguntas(id_encuesta){
    $.ajax({
        url: '/encuestas/cargar_preguntas',
        method: 'POST',
        data: {Encuesta: id_encuesta},
        beforeSend: function () {
            $(".preguntas").html("Procesando, espere por favor...");
        },
        success: function (response) {
            // console.log(response);
            $(".preguntas").html(response);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
        }
    });
};
function mostrarExito(){
    Swal.fire({
        icon: "success",
        title: "Perfecto",
        text: "Gracias por darnos tu opinión, nos ayuda a mejorar."
    }).then((result) => {
        if (result.isConfirmed) {
            $('#preguntas').modal('hide');
            location.reload();
        }
    });
}
function mostrarError(){
    Swal.fire({
        icon: "error",
        title: "Error",
        text: "No se puede guardar la informacion, Por favor, Intentalo de nuevo."
    });
}
