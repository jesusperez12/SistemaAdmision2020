<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    protected $fillable = ['users_id','ModoIngreso_Id','Institutos_id',
    'Especialidad_id','Programas_id','Aprobacion','Vigente','nroresolucion',
    'Cuposupel','ActaConv','ConvDeAr','VigenteAct','Periodo_id'];

     public function users()
{
   return $this->hasMany(User::class);
}

	
      public function sede()
{
   return $this->belongsTo(Sede::class,'id_sede');
}

    
	public function instituto(){
    	return $this->belongsTo(InstitutoUser::class);
    }

    public function programa(){
      return $this->belongsTo(programa::class);
   }


   public function sedes(){
      return $this->belongsTo('App\InstitutoUser', 'Institutos_id');
}

  public function programas(){
   return $this->belongsTo('App\programa', 'Programas_id');//esto lo que hace es que busca en modelo programa la compracion entre el campo programa_id y apartir de alli se puede hacer el scopeprograma
}



 public function scopeNombInstituto($query, $NombInstituto){
            if($NombInstituto)
                return $query->where('NombInstituto', 'LIKE', "%$NombInstituto%");
    }

public function scopeespecialidad($query, $NombEspecialidad)
{
    //dd("scope: " . $name);
     if($NombEspecialidad)
   return $query->where('NombEspecialidad','LIKE',"%$NombEspecialidad%");
}



}

