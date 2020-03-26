<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    public $timestamps = false;
    protected $table = 'Municipios';
    protected $fillable =['Municipio','Estados_id'];


    public function estado(){
    	return $this->belongsTo(Estado::class);
    }

    public function Parroquias() {

    	return $this->hasMany(Parroquias::class);
    }

}
