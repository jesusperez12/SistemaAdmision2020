<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class repuestadiagnostico extends Model
{
    public $timestamps = false;
    protected $table = 'EvaluacionCompetenciaResultado';

  protected $fillable =['Aspirante_id','preguntasDiagnostica_id','RespuestasVocacional',
  'Instituto_id','user_id','Periodo_id'];    
}
