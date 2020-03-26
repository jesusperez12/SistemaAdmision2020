<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use App\Notifications\AspiranteResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
class UsuariosAspi extends Authenticatable
{
  use Notifiable;
  
  protected $quard ='UsuariosAspi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'UsuariosAspi';
    protected $fillable = [
        'name', 'email', 'password','confirmation_code', 'datos_personales', 'datos_basicos', 'datos_academico', 'datos_vocacional','datos_Experiencia','datos_socioEconomico'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'datos_personales' => 'boolean',
        'datos_basicos' => 'boolean',
        'datos_academico' => 'boolean',
        'datos_vocacional' => 'boolean',
        'datos_Experiencia' => 'boolean',
        'datos_socioEconomico' => 'boolean',
        
     
    ];

    public function scopeNombEspecialidad($query, $NombEspecialidad)
    {
        //dd("scope: " . $name);
         if($NombEspecialidad)
       return $query->where('NombEspecialidad','LIKE',"%$NombEspecialidad%");
    }

      /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AspiranteResetPasswordNotification($token));
    }

    public function scopeNombInstituto($query, $NombInstituto){
        if($NombInstituto)
            return $query->where('NombInstituto', 'LIKE', "%$NombInstituto%");

        }



}