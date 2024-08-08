<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opciones extends Model
{
    use HasFactory;
    protected $table ='intra_encu_respuestas';
    protected $primaryKey = 'id_respuestas';
    // retorna la consulta
    public function preguntas(){
        return $this->belongsTo(Preguntas::class,'id_pregunta','id_pregunta');
    }
}
