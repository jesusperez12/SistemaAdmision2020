<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocioEconomico extends Model
{
    public $timestamps = false;
    protected $table = 'DatosSocioEconomico';
    protected $fillable =['TiempoPost','CantDineroPost','TiempoInternet','Posee_Computador','Posee_internet','Estudios_Madre','Estudios_Padres_id','Fuente_Ingreso_id','Nivel_Ingresos_id','Condicion_Alojamientos_id','Tiempo_Traslados_id','Conteos_Postgrado_id','Hijos','AspPostgrado_id','Periodo_id'];
}
