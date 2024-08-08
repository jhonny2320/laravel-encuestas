<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="include/js/script.js"></script>
    <link rel="stylesheet" type="text/css" href="include/css/style_encuesta.css">
    <title>Encuesta</title>
</head><?php
include('../modelo/mencuestas.php');
$ins = new Dencuestas();
// Capturar el valor del parámetro GET 'encuesta'
// $encuestaId = isset($_GET['encuesta']) ? $_GET['encuesta'] : null;
if (isset($_GET['encuesta'])) {
    $encryptedId = $_GET['encuesta'];

    // Función para desencriptar el ID usando Base64
    function decryptId($encryptedId) {
        return base64_decode($encryptedId);
    }
    $encuestaId = decryptId($encryptedId);
    $encuesta=$ins->intra_encuesta_filtro($encuestaId); 
}
$hoy = date('Y-m-d'); // Formato de fecha: año-mes-día
// $fecha_inicio = $encuesta[0]["fecha_inicio"];
$fecha_fin = $encuesta[0]["fecha_fin"];
// Comprobar si hoy está en el rango de fecha_inicio y fecha_fin
if ($hoy <= $fecha_fin) { ?>
    <header class="header_info_col" style="background: <?php echo $encuesta[0]['color']; ?>;">
        <div class="content_logo_club">
            <img class="logo_header_info" src="include/img/logo_club_bordeblanco.png" alt="Logo Club pueblo Viejo">
        </div>
            <h1 class="titulo_header"><?php echo $encuesta[0]['titulo']; ?></h1>
            <div class="class_space"></div>
    </header>
    <body>
    <div class="content">
        <div class="imagen animate__animated animate__zoomInDown ">
            <img src="../encuestas/encuesta_logos/<?php echo $encuesta[0]['imagen']; ?>" alt="">
        </div>
        <div class="content_form_e"><?php
        if($encuestaId){ ?>
        <form action="" method="post"  class="formulario_c" id="respuestas" ><?php
            $encabezado=$ins->info_encabezado($encuestaId);
            foreach($encabezado as $datosEncuesta){?>
                <div class="radio_style">
                    <center><h5><strong class="nombre_encuesta"><?php echo $datosEncuesta['nombre']?></strong></h5></center><br><?php
                    $preguntas=$ins->info_preguntas($datosEncuesta['id_encabezado']);
                    foreach($preguntas as $indice => $pregunta){?>
                        <label for="form-label"><strong><?php echo $indice + 1 ?>. <?php echo $pregunta['nombre']?></strong><span class="obligatorio_c">*</span></label><br><?php
                        $opciones=$ins->info_respuestas($pregunta['id_pregunta']);
                        switch ($pregunta['id_tipo']){
                            case '1':?><!-- unica respuesta -->
                                <br><div class="form-check"><?php
                                    foreach($opciones as $index => $opcion){ ?>
                                        <div class="option">
                                            <input type="radio" name="pregunta_<?php echo $pregunta['id_pregunta'] ?>" value="<?php echo $opcion['nombre'] ?>">
                                            <label class="form-check-label" for="radio_<?php echo $opcion['id_opcion'] ?>"><?php echo $opcion['nombre'] ?></label>
                                        </div><?php
                                    } ?>
                                </div><br><?php
                                break;
                            case '2':?><!-- multiple respuesta -->
                                <div class="form-check"><?php
                                    foreach($opciones as $index => $opcion){ ?>
                                        <div class="option">
                                            <input type="checkbox" name="pregunta_<?php echo $pregunta['id_pregunta'] ?>[]" value="<?php echo $opcion['nombre'] ?>">
                                            <label class="form-check-label" for="checkbox_<?php echo $opcion['id_opcion'] ?>"><?php echo $opcion['nombre'] ?></label>
                                        </div><?php
                                    } ?>
                                </div><br><?php
                                break;
                            case '3':?>  <!-- respuesta escala -->
                                <br> <div class="rating"><?php 
                                    for($i = 1; $i <= 5; $i++) { ?>
                                        <div class="option">
                                            <input type="radio" name="pregunta_<?php echo $pregunta['id_pregunta'] ?>" value="nivel_<?php echo $i ?>">
                                            <label class="form-check-label" for="radio_<?php echo $i ?>"><?php echo $i ?></label>
                                        </div><?php
                                    } ?>
                                </div>
                                <br><?php
                                break;
                            case '4':?> <!-- respuesta abierta -->
                                <input type="textarea" class="form-control" name="pregunta_<?php echo $pregunta['id_pregunta'] ?>" id="comentarios"><?php
                                break;
                        }
                    }?>
                </div><?php
            } ?><br>
            <div id="btn_enviar_encuesta">
                <button type="button" class="btn btn-primary" id="guardar_informacion" onclick="guardar('unica')">Enviar</button>
            </div>
        </form>
        <?php }?>
        </div>
    </div><?php
} else { ?>
    <div class="mensaje_no_valida">
        <div class="animacion animate__animated animate__backInDown">
            <i class="fas fa-exclamation-circle icono-error"></i>
            <h1>Encuesta ya no esta disponible</h1>
        </div>
        <div class="animacion animate__animated animate__backInUp">
            <p>Lo sentimos, esta encuesta ya no está disponible. Por favor, vuelva más tarde para nuevas encuestas.</p>
            <p>Mientras tanto, te invitamos a visitar nuestro menú de encuestas y compartir tu opinión sobre otros temas.</p>
            <a href="https://intranet.clubpuebloviejo.com/encuestas/index.html" target="_blank">Menu de encuesta</a>
        </div>
    </div><?php 
} ?>  
</body>
</html>
