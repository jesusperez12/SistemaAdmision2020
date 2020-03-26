<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class preguntasDiagnosticas extends Model
{
    protected $table = 'preguntasDiagnostica';

    protected $fillable =['id','preguntas'];  

   

    public function grupo(){
    	return $this->belongsTo('App\grupos');
    }
}
