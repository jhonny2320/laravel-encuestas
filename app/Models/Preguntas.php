<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preguntas extends Model
{
    use HasFactory;
    protected $table ='intra_encu_pregunta';// nombre tercera tabla
    protected $primaryKey = 'id_pregunta'; // nombre de la llave primaria

    public function encabezado()
    {
        return $this->belongsTo(Encabezado::class,'id_encabezado', 'id_encabezado'); // Clave foránea
    }
    public function opciones(){
        return $this->hasMany(Opciones::class,'id_pregunta','id_pregunta');
    }
}
