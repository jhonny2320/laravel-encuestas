<?php
// app/Http/Controllers/EncuestaController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
// funciones para traer los datos de las encuestas
use App\Models\Encuesta;
use App\Models\Encu_respuestas;

class EncuestaController extends Controller
{
    public function index()
    {
        return view('encuestas.index');
    }
    public function getEncuestaAreas(Request $request)
    {
        // recibir datos del ajax
        $titulo = $request->input('Titulo');
        $id_servicio = $request->input('Servicio');
        $hoy = date('Y-m-d');
        // consulta a la base de datos
        $activas = DB::table('intra_encuesta as e')
            ->join('intra_encu_area as a', 'e.id_area', '=', 'a.id_area')
            ->join('intra_encu_servicio as s', 'a.id_servicio', '=', 's.id_servicio')
            ->where('s.id_servicio', $id_servicio)
            ->where('e.fecha_inicio', '<=', $hoy)
            ->where('e.fecha_fin', '>=', $hoy)
            ->select('e.id_encuesta', 's.id_servicio', 's.nombre as servicio', 'a.id_area', 'a.nombre as area', 'e.titulo', 'e.fecha_inicio', 'e.fecha_fin')
            ->get();
        // enviar el array 'activas' y el titulo al archivo encuestas_areas
        return view('partials.encuesta_areas', compact('activas','titulo'));
    }
    public function guardar(Request $request)
    {
        // Lógica para guardar los datos de la encuesta
        $respuestas = $request->all();
        unset($respuestas['_token']); // Eliminar el token CSRF de los datos enviados
        // recorrer el formulario para extraer las respuestas
        foreach ($respuestas as $preguntaId  => $respuesta) {
            //si respuesta viene vacio asignarle " sin comentarios"
            $respuesta = !empty($respuesta) ? $respuesta : "Sin comentarios";
            if (is_array($respuesta)) {
                // Para respuestas múltiples (checkboxes), concatenar las respuestas con comas
                $opcion = implode(',', $respuesta);
                // enviar valores al modelo
                Encu_respuestas::create([
                    'id_pregunta' => str_replace('pregunta_', '',$preguntaId) ,
                    'respuesta' => $opcion,
                ]);
            }else{
                //para respuestas unicas (radio, text....)
                $id = str_replace ('pregunta_', '',$preguntaId);
                Encu_respuestas::create([
                    'id_pregunta' => $id ,
                    'respuesta' => $respuesta,
                ]);
            }
        }
        return response()->json('Guardar');
    }
    // cargar encuesta en el modal
    public function cargarPreguntas(Request $request)
    {
        // recibir datos del ajax
        $id_encuesta = $request->input('Encuesta');
        // cargar los elementos con sus preguntas y opciones
        try {
            $encabezados= Encuesta::with('encabezados.preguntas.opciones')->findOrFail($id_encuesta);
            return view('partials.preguntas', compact('encabezados'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
?>