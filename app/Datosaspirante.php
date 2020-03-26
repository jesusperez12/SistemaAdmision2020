<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Datosaspirante extends Model
{
    protected $table='AspPregrado';

    protected $primarykey='id';

    public $timestamps=false;

    protected $fillable =['id','Cedula','PrimerNombre','discapacidad_id', 
    'SegundoNombre','PrimerApellido','SegundoApellido','Nacionalidad',
    'pasaporte','EstadoCivil','Genero','FechaNacimiento','Direccion',
    'TelefonoMovil','TelefonoLocal','TelefonOficina', 'Correo','Edad','Peso',
    'Estatura','PaisOrigen_id','Etnias_id','Estados_id','Municipios_id','Parroquias_id',
    'PaisNacimiento_id','user_id'];
  
    
protected $guarded=[
];


    public function datbasicos()
  {
      return $this->hasMany(DatosBasicos::class, 'AspPregrado_id');
  }

  public function discapacidad()
{
  return $this->hasOne(discapacidad::class);
}

    public function setFechaNacAttribute($value)
   {
       $this->attributes['FechaNacimiento'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
   }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     public function selectpais()
  {
      return $this->belongsTo(Pais::class);
  }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            

  public function scopeNombEspecialidad($query, $NombEspecialidad)
  {
      //dd("scope: " . $name);
       if($NombEspecialidad)
     return $query->where('NombEspecialidad','LIKE',"%$NombEspecialidad%");
  }

  public function scopeNombInstituto($query, $NombInstituto){
    if($NombInstituto)
        return $query->where('NombInstituto', 'LIKE', "%$NombInstituto%");

    }


}
