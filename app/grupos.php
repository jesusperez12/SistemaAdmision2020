<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class grupos extends Model
{
    protected $table = 'gruposdiagnostico';

    protected $fillable =['grupo'];

    public function pregunta()
    {
        return $this->hasMany('App\preguntasDiagnosticas','gruposdiagnostico_id');
    }
}
