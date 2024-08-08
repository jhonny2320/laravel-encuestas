<!-- <script src="include/js/script.js"></script> -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
<form id="respuestas" method="post">
    @foreach($encabezados->encabezados as $datosEncuesta)
        <div class="radio_style">
            <center><h5><strong>{{ $datosEncuesta->nombre }}</strong></h5></center><br>
            @foreach($datosEncuesta->preguntas as $indice => $pregunta)
                <label for="form-label"><strong>{{ $indice + 1 }}. {{ $pregunta->nombre }}</strong><span class="obligatorio_c">*</span></label>
                @switch($pregunta->id_tipo)
                    @case(1)
                        <!-- única respuesta -->
                        <div class="form-check">
                            @foreach($pregunta->opciones as $opcion)
                                <div class="option">
                                    <input type="radio" name="pregunta_{{ $pregunta->id_pregunta }}" value="{{ $opcion->nombre }}">
                                    <label class="form-check-label" for="radio_{{ $opcion->id_opcion }}">{{ $opcion->nombre }}</label>
                                </div>
                            @endforeach
                        </div><br>
                        @break
                    @case(2)
                        <!-- múltiple respuesta -->
                        <div class="form-check">
                            @foreach($pregunta->opciones as $opcion)
                                <div class="option">
                                    <input type="checkbox" name="pregunta_{{ $pregunta->id_pregunta }}[]" value="{{ $opcion->nombre }}">
                                    <label class="form-check-label" for="checkbox_{{ $opcion->id_opcion }}">{{ $opcion->nombre }}</label>
                                </div>
                            @endforeach
                        </div><br>
                        @break
                    @case(3)
                        <!-- respuesta escala -->
                        <br>
                        <div class="rating">
                            @for($i = 1; $i <= 5; $i++)
                                <div class="option">
                                    <input type="radio" name="pregunta_{{ $pregunta->id_pregunta }}" value="nivel_{{ $i }}">
                                    <label class="form-check-label" for="radio_{{ $i }}">{{ $i }}</label>
                                </div>
                            @endfor
                        </div>
                        <br>
                        @break
                    @case(4)
                        <!-- respuesta abierta -->
                        <input type="textarea" class="form-control" name="pregunta_{{ $pregunta->id_pregunta }}" id="comentarios">
                        @break
                @endswitch 
            @endforeach
        </div>
    @endforeach
</form>