<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosBasicos extends Model
{
     public $timestamps = false;
	 protected $table = 'DatosBasicos';
     protected $fillable = ['id','ModoIngreso_Id','Especialidad_a_cursar1_id','Especialidad_a_cursar2_id','Especialidad_a_cursar3_id','cupos_dirigidos_id','Programas_id','Institutos_id','AspPregrado_id'];


		public function especialidad()
	{
   return $this->belongsTo(Ofertas::class, 'Especialidad_Id');
	}
 
	public function aspirantes()
	{
		return $this->belongsTo(Datosaspirante::class);
	}

	public function institutos()
	{
		return $this->belongsTo(InstitutoUser::class);
	}

	public function Datosbasicos()
	{
		return $this->hasMany(audit::class);
	}

	public function modoingreso()
	{
		return $this->hasMany(ModoIngreso::class);
	}

	public function scopeNombInstituto($query, $NombInstituto){
        if($NombInstituto)
            return $query->where('NombInstituto', 'LIKE', "%$NombInstituto%");

		}
		
		public function scopeNombEspecialidad($query, $NombEspecialidad)
    {
        //dd("scope: " . $name);
         if($NombEspecialidad)
       return $query->where('NombEspecialidad','LIKE',"%$NombEspecialidad%");
    }


}
