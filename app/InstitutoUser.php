<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class InstitutoUser extends Model
{

    protected $table = 'Institutos';
    protected $fillable =['id','NombInstituto'];


    public function nucleo(){
    	return $this->belongsTo(Sede::class);
    }


 	 public function SedeEspecialidad()
{
   return $this->hasMany(SedeEspecialidad::class);
}
    
}
