<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Encabezado extends Model
{
    // use HasFactory;
    protected $table = 'intra_encu_encabezado';// nombre de la segunda tabla
    protected $primaryKey = 'id_encabezado'; // nombre de la llave primaria de
    public function encuesta()
    {
        return $this->belongsTo(Encuesta::class,'id_encuesta','id_encuesta');//'llave foranea', 'llave primaria'
    }
    // relacionar con tabla preguntas
    public function preguntas(){
        // relacion uno a muchos *hasmany*
        return $this->hasMany(Preguntas::class,'id_encabezado','id_encabezado');
    }
   
}
?>