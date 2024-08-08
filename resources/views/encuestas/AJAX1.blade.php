<?php
include('../modelo/mencuestas.php');
$ins = new Dencuestas();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $encuesta=$_POST;
    // iterar sobre cada encabezado
    $error=false;
    foreach($encuesta as $pregunta => $respuesta){
        // Verificar si la clave comienza con 'pregunta_'
        if (strpos($pregunta, 'pregunta_') === 0) {
            // Extraer el número de la pregunta
            $pregunta_id = substr($pregunta, 9); // Obtener el número después de 'pregunta_'

            // Verificar si la pregunta es una respuesta múltiple
            if (is_array($respuesta)) {
                // Convertir la respuesta múltiple a una cadena
                $respuesta = implode(", ", $respuesta);
            }elseif($respuesta ===''){
                $respuesta="Sin Comentarios";
            }
             else {
                $respuesta = $respuesta;
            }
        }
        // print_r ($pregunta_id.' = '.$respuesta);
        if($pregunta_id && $respuesta){
            $resultado=$ins->guardar_encuesta($pregunta_id,$respuesta);
        }else{
            echo 
            '<script>
                Swal.fire({
                title: "Encuesta",
                text: "Error Al guardar la pregunta ",
                icon: "error",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK"
                }).then((result) => {
                    $("#preguntas").modal("hide");
                });
            </script>';
            return ;
        }
        if(!$resultado){
            $error=true;
        }else{
            $error=false;
        }
    }
    if($error)
    {
        echo 'false';
    }else{
        echo 'true';
    }
} else {
    // Método de solicitud incorrecto
    echo 'false';
}

