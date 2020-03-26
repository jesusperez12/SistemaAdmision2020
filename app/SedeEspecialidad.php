<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SedeEspecialidad extends Model
{

	protected $table = 'sede_especialidads';
    protected $fillable = ['Institutos_id','Especialidad_id','Programas_id','Periodo_id','Vigente'];


     public function programa(){
    	return $this->belongsTo(programas::class);
    }

	public function subprograma(){
    	return $this->belongsTo(Especialidad::class);
    }


        public function Institutos()
{
   return $this->belongsTo(InstitutoUser::class,'id');
}

}
