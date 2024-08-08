<?php
// definir modelos para la relacion: tabla encuesta->encabezados
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    // use HasFactory;
    protected $table = 'intra_encuesta';//nombre de la primera tabla
    // Especifica el nombre de la clave primaria
    protected $primaryKey = 'id_encuesta';
    //relacion con la tabla encabezados
    public function encabezados(){
        return $this->hasMany(Encabezado::class,'id_encuesta','id_encuesta');//'llave foranea', 'llave primaria'
    }    
}
