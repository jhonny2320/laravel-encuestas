<!-- resources/views/partials/encuesta_areas.blade.php -->

<link rel="stylesheet" type="text/css" href="{{ asset('css/style_encuesta.css') }}">
{{-- validar que la variable activas tenga informacion --}}
@if (isset($activas) && count($activas) > 0)
<header class="header_info_col">
    <img src="{{ asset('img/logo_club_bordeblanco.png') }}" alt="Logo Club pueblo Viejo">
    <h5 class="modal-title">{{ $titulo }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color:white;"></button>
</header>
<div class="modal-body">
    <div>
        <label class="form-label"><strong>Encuestas activas:</strong></label>
        <select class="form-select" aria-label="Default select example" id="encuesta" onchange="cargar_preguntas(this.value)">
            <option value="">--Seleccionar--</option>
            @foreach($activas as $encuesta)
                <option value="{{ $encuesta->id_encuesta }}">{{ $encuesta->titulo }}</option>
            @endforeach
        </select><br>
        <div class="preguntas"></div>
    </div>
</div>
<div class="modal-footer">
    <center>
        <button type="button" class="btn btn-success" style="width: 150px" onclick="guardar('general')">Guardar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    </center>
</div>    
@else
<script>
    Swal.fire({
        title: "Encuesta",
        text: "No hay Encuestas Activas Por El Momento",
        icon: "error",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "OK"
    }).then((result) => {
        $("#preguntas").modal("hide");
    });
</script>
@endif
