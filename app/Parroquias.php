<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parroquias extends Model
{
    public $timestamps = false;
    protected $table = 'Parroquias';
    protected $fillable =['Parroquias','Municipios_id'];

    public function Municipios(){
    	return $this->belongsTo(Municipio::class);
    }
}
