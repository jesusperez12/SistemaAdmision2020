<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    public $timestamps = false;
    protected $table = 'Especialidad';

    protected $fillable =['CodEspecialidad','NombEspecialidad', 'Programas_id']; 


     public function programa(){
    	return $this->belongsTo('App\programa', 'Programas_id');//esto lo que hace es que busca en modelo programa la compracion entre el campo programa_id y apartir de alli se puede hacer el scopeprograma
    }

    public function sedeespecialidad() {

    	return $this->hasMany(SedeEspecialidad::class);

    }	
// Query Scope
public function scopeCodEspecialidad($query, $CodEspecialidad){
                if($CodEspecialidad)
                    return $query->where('CodEspecialidad', 'LIKE', "%$CodEspecialidad%");
        }
 public function scopeNombEspecialidad($query, $NombEspecialidad){
                if($NombEspecialidad)
                    return $query->where('NombEspecialidad', 'LIKE', "%$NombEspecialidad%");
        }

    public function scopeprograma($query, $NombProgramas)
    {
        //dd("scope: " . $name);
         if($NombProgramas)
    	return $query->where('NombProgramas','LIKE',"%$NombProgramas%");
    }	
}
