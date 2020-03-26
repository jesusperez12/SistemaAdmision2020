<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User; //MODELO LLAMADO DE LA TABLA
use DB;
class Controller extends BaseController
{

  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function obtenerDatos()

    {
      
 
     $id_usuario = User::select('id')->orderby('created_at','DESC')->first();
            $iduser=$id_usuario->id;
            // dd($iduser);
 
                return DB::table('sedeInstitutos')->where('sedeInstitutos.user_id', '=', $iduser)
         ->leftJoin('Institutos', 'sedeInstitutos.Institutos_id', '=', 'Institutos.id')
         ->leftJoin('users', 'sedeInstitutos.user_id', '=', 'users.id')
         ->select('Institutos.NombInstituto','sedeInstitutos.user_id','sedeInstitutos.id')->get($iduser);
 
           $users=DB::table('users')->where('id', '=', \Auth::user()->id)
         ->leftJoin('sede', 'users.sede_id', '=', 'sede.id_sede')
         ->leftJoin('rols', 'users.rols_id', '=', 'rols.id_rols')
         ->get();
 
         // Alert::success('Execelente', 'Oferta Aprobada con exito')->autoclose(3500);
         return view('home',compact('users'));
 
      }
 
 }
 
