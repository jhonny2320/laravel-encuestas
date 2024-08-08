<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encu_respuestas extends Model
{
    // enlazar con tabla de respuestas
    protected $table = 'intra_encuesta_respuestas';
    protected $primaryKey = 'id_encu_resp';
    //enviar el id de la pregunta y su eleccion
    protected $fillable = ['id_pregunta','respuesta'];
    //desactivar la fecha automatica
    public $timestamps = false;
}
?>