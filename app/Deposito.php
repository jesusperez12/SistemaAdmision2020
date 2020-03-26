<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Deposito extends Model
{

		public $timestamps = false;
	 protected $table = 'Deposito';
     protected $fillable = [
        'NumDeposito','deposito_confirm','FechaDeposito','Banco_id','AspPregrado_id'];


	   public function Aspirante()
{
    return $this->belongsTo(Datosaspirante::class);
}




}
