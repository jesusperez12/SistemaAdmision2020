<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndicadorSocial extends Model
{
    
	
     protected $table = 'indicadorSocial';
     protected $fillable = ['Nombreindicador'];

	public function ValorIndicardor()
    {
        return $this->belongsToMany(DetalleSocial::classe, 'ValorIndicardor')->withPivot('users_id');
    }

}