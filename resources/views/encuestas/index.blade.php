<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/script.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <title>Encuestas</title>
</head>
<body>
    <header class="header_info_col">
        <img src="{{ asset('img/logo_club.png') }}" alt="Logo Club Pueblo Viejo">
        <h1>Encuestas</h1>
    </header>

    <div class="title_encuesta">
        <h1 class="">¿Qué opinión nos quiere proporcionar hoy?</h1>
    </div>
    <div class="content_catego" id="servicios">
        <button title="Servicios Deportivos" value="1" data-bs-toggle="modal" data-bs-target="#preguntas" class="click_inf">
            <div class="img_content">
                <img src="{{ asset('img/servicios_deportivos.png') }}" alt="">
            </div>
            <div class="title_categorie">
                <h3>Servicios Deportivos</h3>
            </div>
        </button>

        <button title="Servicios de Bienestar" value="2" data-bs-toggle="modal" data-bs-target="#preguntas" class="click_inf">
            <div class="img_content">
                <img src="{{ asset('img/servicios_bienestar.png') }}" alt="">
            </div>
            <div class="title_categorie">
                <h3>Servicios Bienestar</h3>
            </div>
        </button>

        <button title="Servicios de Alimentos y Bebidas" value="3" data-bs-toggle="modal" data-bs-target="#preguntas" class="click_inf">
            <div class="img_content">
                <img src="{{ asset('img/servicios_ayb.png') }}" alt="">
            </div>
            <div class="title_categorie">
                <h3>Servicios A y B</h3>
            </div>
        </button>

        <button title="Servicios de Eventos" value="4" data-bs-toggle="modal" data-bs-target="#preguntas" class="click_inf">
            <div class="img_content">
                <img src="{{ asset('img/servicios_eventos.png') }}" alt="">
            </div>
            <div class="title_categorie">
                <h3>Servicios Eventos</h3>
            </div>
        </button>
        <br>
        <br>
    </div>
    {{-- abrir modal y cargar el contenido de las encuestas --}}
    <div class="modal fade" id="preguntas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content"></div>
        </div>    
    </div>
    <footer class="footer_clubpuebloviejo" id="locaciones">
        <div class="content_icon">
            <a href="mailto:contacto@clubpuebloviejo.com" class="info_icon" title="Correo de contacto del club">
                <span class="material-symbols-outlined">contact_mail</span>
                contacto@clubpuebloviejo.com
            </a>
            <a href="tel:6013295900" title="Teléfono del club">
                <span class="material-symbols-outlined">call</span>
                601-3295900
            </a>
            <a href="https://maps.app.goo.gl/7Fxpbax7trSPg1EH6" target="_blank" title="Ubicación">
                <span class="material-symbols-outlined">location_city</span>
                Km. 7 vía Suba – Cota
            </a>
        </div>
        <hr>
        <p class="text_info">
            Copyright © 2024 diseñado por 
            <a href="https://clubpuebloviejo.com/" target="_blank">Club Pueblo Viejo</a>
        </p>
    </footer>
</body>
</html>
