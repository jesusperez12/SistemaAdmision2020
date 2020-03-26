<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpeLaboralmodel extends Model
{
    public $timestamps = false;
    protected $table = 'ExperienciaLaboral';
    protected $fillable =['NombreInstitucion','AñoGraduado','AñoServicio','Estado_id'];

    public function scopeWithoutGroup($query)
	{
		return $query->whereNotNull('AspPostgrado_id');
	}
}
