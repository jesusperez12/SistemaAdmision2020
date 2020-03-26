<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class repuestaPrueba extends Model
{
    public $timestamps = false;
    protected $table = 'resultadosPrueba';

  protected $fillable =['AreaLiderComunitarioA','AreaLiderComunitarioB','AreaOrientadorA',
  'AreaOrientadorB','AreaPlanificadorA','AspPregrado_id','AreaPlanificadorB','AreaInvestigadorA','AreaInvestigadorB','AreaDistraccionA',
'AreaDistraccionB','TotVocacional','Periodo_id','IndiceAcademico','PosiciónAdmisión','estatus','condicion','observacion']; 
}
