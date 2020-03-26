<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class audit extends Model
{
    public $timestamps = false;
    protected $table = 'AudDastosDasicos';
    protected $fillable = ['datosbasicos_id ','accion','Created_at','Registro'];

    public function audit() {

    	return $this->belongsTo(DatosBasicos::class);
    }
}
