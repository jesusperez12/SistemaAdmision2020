<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sedeInstitutos extends Model
{
	public $timestamps = false;
   protected $table = 'sedeInstitutos';
   protected $fillable = ['sede_id','Institutos_id','user_id'
    ];

    public function usuario() {

	return $this->belongsTo(User::class);

}

 public function usuario1() {

	return $this->belongsTo(admins::class);

}

}
