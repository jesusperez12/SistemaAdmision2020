<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Academico extends Model
{
     public $timestamps = false;
	 protected $table = 'DatosAcademicos';
     protected $fillable = ['TiposTitulos_id','TituloCarrera','Universidad','FechaInicio','fechaCulminacion','FechaGrado','tipoOrganizacion', 
     'Escala','PuestoPromocion','Promedio','AspPostgrado_id','PaisEstudio_id','Periodo_id'];

        public function scopeWithoutGroup($query)
	{
		return $query->whereNotNull('AspPostgrado_id');
	}


     	 public function setFechaDepoAttribute($value)
   {
       $this->attributes['FechaInicio'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
   } 


    public function setFechaCulmiAttribute($value)
   {
       $this->attributes['fechaCulminacion'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
   } 

    public function getDobAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }


}
