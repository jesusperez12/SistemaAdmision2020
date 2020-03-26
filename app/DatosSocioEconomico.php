<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosSocioEconomico extends Model
{
 	public $timestamps = false;
	 protected $table = 'DatosSocioEconomico';
     protected $fillable = ['TiempoPost','CantDineroPost','Posee_Computador','Posee_internet','TiempoInternet','AspPostgrado_id','Periodo_id','user_id'];
}
