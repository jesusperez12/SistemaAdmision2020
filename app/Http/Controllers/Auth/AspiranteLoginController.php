<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Alert;
class AspiranteLoginController extends Controller
{
    
	 public function __construct()
    {
        $this->middleware('guest:UsuariosAspi');
    }

   public function showLoginForm()
   
   {
    
    return view('authAspirante.login');
   }

     public function viewlistasOfertas()
   {
     $noaprob = "1";
        $ofertasaprobadas=DB::table('ofertas')->where('ofertas.Aprobacion', '=', $noaprob)
        ->leftJoin('ModoIngreso', 'ofertas.ModoIngreso_Id', '=', 'ModoIngreso.Id')
        ->leftJoin('Institutos', 'ofertas.Institutos_id', '=', 'Institutos.id')
        ->leftJoin('Especialidad', 'ofertas.Especialidad_Id', '=', 'Especialidad.Id')
        ->leftJoin('Programas', 'ofertas.Programas_id', '=', 'Programas.id')
        //->leftJoin('tipo_admision', 'ofertas.Id_Tipo', '=', 'tipo_admision.id_tipo')
        ->select('ModoIngreso.ModoIngreso','Institutos.NombInstituto', 'Especialidad.NombEspecialidad','ofertas.Cuposupel','ofertas.nroresolucion','ofertas.id','ofertas.created_at','Programas.NombProgramas')->get();

         return view('authAspirante.login',compact('ofertasaprobadas'));
   }


   	public function login(Request $request)
   	{
 




   		$this->validate($request,[
   			'email' => 'required|email',
   			'password' => 'required|min:6'

   		]);

       if (Auth::guard('UsuariosAspi')->attempt(['email'=> $request->email, 'password' => $request->password, 'confirmed' => 1], $request->remenber))
       {
   			return redirect()->intended(route('DatosAspirante.index'));
   		}
   
        // alert()->error(' ', 'Debe Registrarse / contraseña incorrecta')->persistent('Close');
        alert()->error(' ', 'Activar cuenta o contraseña incorrecta')->persistent('Close');
   			return redirect()->back()->withInput($request->only('email','remenber'));
   	}



}
