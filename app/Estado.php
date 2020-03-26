<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
   	public $timestamps = false;
    protected $table = 'Estados';
    protected $fillable =['Estado'];


    /*  public function pais(){
    	return $this->belongsTo(Pais::class);
    }*/


    public function Municipios() {

    	return $this->hasMany(Municipio::class);
    }

     public function pais() {

    	return $this->belongsTo(Pais::class);
    }


}
