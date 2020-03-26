<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosAcademico extends Model
{
    public $timestamps = false;
    protected $table = 'datosAcademico';
    protected $fillable = ['sistemaEstudio','DependenciaPlantel','namePlantel','NumeroRNI','TurnoEstudio','Municipio_id', 
    'Estados_id','RamasEducacion_id','Promedio','AspPregrado_id','Periodo_id','user_id'];
}
