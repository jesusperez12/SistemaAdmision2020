<?php

namespace App\Http\Controllers;

use App\Especialidad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Pagination;
use DB;
use Illuminate\Support\Facades\Validator;
use App\SedeEspecialidad;
use App\programas;
use App\Sede;
use App\Periodo;
use App\sedeInstitutos;
use Alert;
class EspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()

    {
 
     $this->middleware('permission:Especialidad.index')->only('index');
         
    $this->middleware('permission:Especialidad.create')->only(['create','store']);	
 
    $this->middleware('permission:Especialidad.edit')->only(['edit','update']);
 
    $this->middleware('permission:Especialidad.show')->only('show');
 
    $this->middleware('permission:Especialidad.destroy')->only('destroy');
    
   
}


    public function getsubprogramas(Request $request)
    {
      $programa = Especialidad::where('Programas_id',$request->valor)->get();
      
        return response()->json($programa);

    }


    public function index()
    {   

        $idusuario = Auth::user()->id;

    if(\Auth::user()->sede_id == '10' ){
    
 $consultas=DB::table('sede_especialidads')->orderby('id','ASC')
  // ->where('sede_especialidads.users_id','=',Auth::user()->id)
            ->leftJoin('Periodo', 'sede_especialidads.Periodo_id', '=', 'Periodo.id')
          //  ->leftJoin('sede', 'sede_especialidads.sede_id', '=', 'sede.id_sede')  
            ->leftJoin('Especialidad', 'sede_especialidads.Especialidad_id', '=', 'Especialidad.id')
           // ->leftJoin('Programas', 'sede_especialidads.Programas_id', '=', 'Programas.Id')
             ->leftJoin('Institutos', 'sede_especialidads.Institutos_id', '=', 'Institutos.id')
            ->select('Periodo.NombrePeriodo','Periodo.Lapso', 'Especialidad.NombEspecialidad',
            'sede_especialidads.id','sede_especialidads.Vigente', 'Institutos.NombInstituto',
            'sede_especialidads.created_at')->paginate(10);
}else{
  $consultas=DB::table('sede_especialidads')->orderby('id','ASC')
->where('sede_especialidads.users_id','=',Auth::user()->id)
            ->leftJoin('Periodo', 'sede_especialidads.Periodo_id', '=', 'Periodo.id')
          //  ->leftJoin('sede', 'sede_especialidads.sede_id', '=', 'sede.id_sede')  
            ->leftJoin('Especialidad', 'sede_especialidads.Especialidad_id', '=', 'Especialidad.id')
           // ->leftJoin('Programas', 'sede_especialidads.Programas_id', '=', 'Programas.Id')
             ->leftJoin('Institutos', 'sede_especialidads.Institutos_id', '=', 'Institutos.id')
            ->select('Periodo.NombrePeriodo','Periodo.Lapso', 'Especialidad.NombEspecialidad',
            'sede_especialidads.id','sede_especialidads.Vigente', 'Institutos.NombInstituto',
            'sede_especialidads.created_at')->paginate(10);
}
    return view('especialidad.index',compact('consultas'));   
    
}



    public function listas()
    {
        $consultas= DB::table('sede_especialidads')->where('id_sede', '=', \Auth::user()->sede_id)
        ->leftJoin('Especialidad', 'sede_especialidads.Especialidad_id', '=', 'Especialidad.Id')
        ->leftJoin('sede', 'sede_especialidads.Sede_Id', '=', 'sede.id_sede')
        ->leftJoin('sede', 'sede_especialidads.Sede_Id', '=', 'sede.id_sede')
        ->leftJoin('sede', 'sede_especialidads.Sede_Id', '=', 'sede.Sede_Id')->get();
    return view('especialidad/prueba',compact('consultas'));    
    }

    public function show($id)
    {
        $especialidad= DB::table('sede_especialidads')->where('sede_especialidads.id', '=', $id)
        ->leftJoin('Especialidad', 'sede_especialidads.Especialidad_id', '=', 'Especialidad.Id')
        ->leftJoin('sede', 'sede_especialidads.sede_id', '=', 'sede.id_sede')
        ->leftJoin('Periodo', 'sede_especialidads.Periodo_id', '=', 'Periodo.id')
         ->select('Especialidad.NombEspecialidad','sede.NombSede','sede_especialidads.Vigente','sede_especialidads.Periodo_id')
        ->first();
  
    return view('especialidad.show',compact('especialidad'));    
    }

   public function create()
    {

     
         $idusuario = Auth::user()->id;

           $sedes= DB::table('Institutos')->orderby('id','ASC')->pluck('NombInstituto','id');

       /* $sedes=DB::table('sedeInstitutos')
        ->leftJoin('Institutos', 'sedeInstitutos.Institutos_id', '=', 'Institutos.id')
        ->orderBy('NombInstituto','ASC')->pluck('NombInstituto','Institutos.id');
      //  dd($nucleos);*/

        $especialidades= DB::table('Especialidad')->orderby('NombEspecialidad','ASC')->pluck('NombEspecialidad','id');
        //$programas= DB::table('Programas')->orderby('NombProgramas','ASC')->pluck('NombProgramas','id');

        $activo = "1";
       /* $ofertas=DB::table('ofertas')->where('ofertas.Aprobacion', '=', $noaprob)
        ->leftJoin('ModoIngreso', 'ofertas.ModoIngreso_Id', '=', 'ModoIngreso.Id')
        ->leftJoin('Institutos', 'ofertas.Institutos_id', '=', 'Institutos.id')
        ->leftJoin('Especialidad', 'ofertas.Especialidad_id', '=', 'Especialidad.Id')
        ->leftJoin('Programas', 'ofertas.Programas_id', '=', 'Programas.id')
        //->leftJoin('tipo_admision', 'ofertas.Id_Tipo', '=', 'tipo_admision.id_tipo')
        ->select('ModoIngreso.ModoIngreso','Institutos.NombInstituto', 'Especialidad.NombEspecialidad','ofertas.Cuposupel','ofertas.nroresolucion','ofertas.id','ofertas.created_at','Programas.NombProgramas')*/




        $per= DB::table('Periodo')
        ->where('Periodo.Vigente', '=',$activo)
        ->orderby('Lapso','ASC')->pluck('Lapso','id');
      // dd($per);
       // $nucleos=DB::table('sedeInstitutos')->where('id', '=', \Auth::user()->Institutos_id)->get();

   
        return view('especialidad.create',compact('especialidades','per','sedes','Sedee'));
    }

  /*  $id_user=\Auth::user()->id;
 
        $user=DB::table('sedeInstitutos')->where('sedeInstitutos.users_id', '=', $id_user)
        ->leftJoin('sede', 'sedeInstitutos.sede_id', '=', 'sede.id_sede')
       // ->leftJoin('tipo_admision', 'users.Id_Tipo', '=', 'tipo_admision.id_tipo')
        ->leftJoin('Institutos', 'sedeInstitutos.Institutos_id', '=', 'Institutos.id')
        ->select('sede.NombSede','Institutos.NombInstituto','sedeInstitutos.sede_id', 'sedeInstitutos.Institutos_id')
        ->first();
        $sedeid=$user->sede_id;
    // dd($sedeid);*/


    public function store(Request  $request)
    {

         $rules = [
            // 'seleccione' => 'required', 
            'Institutos_id' => 'required',
            //'Programas_id' => 'required',
            'Especialidad_id' => 'required',
            'Periodo_id' => 'required',
            'Vigente' => 'required',
           /* 'nucleos' => 'required',
            'rols_id' => 'required',
            'Apellidos' => 'required|max:20|alpha',
            'cedula' =>  'required|numeric|unique:users|digits_between:7,8',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',*/
            
        ];

        $messages = [
           // 'seleccione.required' => 'Este campo es Obligatorio.',
          'Institutos_id.required' => 'Este campo es Obligatorio.',
          //  'Programas_id.required' => 'Este campo es Obligatorio.',
            'Especialidad_id.required' => 'Este campo es Obligatorio.',
            'Periodo_id.required' => 'Este campo es Obligatorio.',
            'Vigente.required' => 'Este campo es Obligatorio.',
           /* 'nucleos.required' => 'Este campo es Obligatorio.',
            'rols_id.required' => 'Este campo es Obligatorio.',
            'Apellidos.required' => 'Este campo es Obligatorio.',
            'cedula.required' => 'Este campo es Obligatorio.',
            'email.required' => 'Este campo es Obligatorio.',
            'email.required' => 'Este campo es Obligatorio.',
            'password.required' => 'Este campo es Obligatorio.',
           
            
*/
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->action('EspecialidadController@create')
                ->withErrors($validator)->withInput();
        }

          /*  $data = array(
            $request->input('Programas_id') => $request->input('Especialidad_id'),

           
        );

        
        foreach ($data as $key => $value) {
            //dd($value);
            foreach ($value as $instituto){
             //dd($instituto);*/
           
    $resultado=DB::table('sede_especialidads')->where('Especialidad_id', $request->input('Especialidad_id'))->where('Institutos_id', $request->input('Institutos_id'))->exists();


if ($resultado) {
            
    Alert::error('Error el programa para este instituto ya existe')->autoclose(3500);
    return redirect()->route('Especialidad.create')->withInput();

}
 $data = array(
            $request->input('Institutos_id') => $request->input('Especialidad_id')

          
        ); 


  foreach ($data as $key => $value) {
     foreach ($value as $Especialidad){
      //dd($Especialidad);
            $datosSocio = new SedeEspecialidad;
            $user = Auth::user();
           // $datosSocio->Programas_id       = $request->Programas_id;
            $datosSocio->users_id           = $user->id;
            //$datosSocio->sede_id            = $request->sede_id;
            $datosSocio->Vigente            = $request->Vigente;
            $datosSocio->Periodo_id         = $request->Periodo_id;
            $datosSocio->Institutos_id      = $request->Institutos_id;
            $datosSocio->Especialidad_id    = $Especialidad;
      

         //   dd($datosSocio);
            $datosSocio->save();
          }
       };
           
    Alert::success('Programa Asignado con éxito')->autoclose(3500);

        return redirect()->route('Especialidad.index');
    }

    public function form()
    {
        $sedes= DB::table('sedes')->where('Id', '=', \Auth::user()->id_sede)->get();
        $especialidades= DB::table('Especialidad')->get();
         $programas= DB::table('Programas')->get();
        return view('especialidad/fragment/form',compact('sedes','especialidades','programas'));
    }





public function edit($id)
    {

      
       $especialidad= SedeEspecialidad::find($id);
       $subprograma=$especialidad->Especilidad_id;
        $idusuario = Auth::user()->id;
       $sedes= DB::table('Institutos')->orderby('id','ASC')->pluck('NombInstituto','id');
     /*   $sedes=DB::table('sedeInstitutos')
        ->leftJoin('Institutos', 'sedeInstitutos.Institutos_id', '=', 'Institutos.id')
        ->orderBy('NombInstituto','ASC')->pluck('NombInstituto','Institutos.id');*/

        $especialidades= DB::table('Especialidad')->orderby('NombEspecialidad','ASC')->pluck('NombEspecialidad','id');
       // $programas= DB::table('Programas')->orderby('NombProgramas','ASC')->pluck('NombProgramas','id');
  $activo = "1";
        $per= DB::table('Periodo')
        ->where('Periodo.Vigente', '=',$activo)
        ->orderby('Lapso','ASC')->pluck('Lapso','id');
    
        return view('especialidad.edit',compact('especialidad','sedes','especialidades','subprograma','per','Sedee'));    
    }

    public function update(Request $request, $id)
    {


        
        /*   $data = array(
            $request->input('Programas_id') => $request->input('Especialidad_id '),

           
        );

        $user = Auth::user();
        foreach ($data as $key => $value) {
            //dd($value);
            foreach ($value as $instituto){
             //dd($instituto);
           
            $especialidad = SedeEspecialidad::find($id);
            $especialidad->Programas_id = $key;
            $especialidad->users_id           = $user->id;
            $especialidad->sede_id            = $request->sede_id;
            $especialidad->Vigente            = $request->Vigente;
            $especialidad->Periodo_id         = $request->Periodo_id;
            $especialidad->Especialidad_id = $instituto;
            $especialidad->update();
           }
        }*/
        

        $user = Auth::user();
         $especialidad = SedeEspecialidad::find($id);
           // $especialidad->Programas_id = $request->Programas_id;
            $especialidad->users_id           = $user->id;
           // $especialidad->sede_id            = $request->sede_id;
            $especialidad->Vigente            = $request->Vigente;
            $especialidad->Periodo_id         = $request->Periodo_id;
            $especialidad->Institutos_id      = $request->Institutos_id;
            $especialidad->Especialidad_id  = $request->Especialidad_id;

            $especialidad->update();
           // dd($especialidad);  

             Alert::success('Programa Actualizado con éxito')->autoclose(3500);
        return redirect()->route('Especialidad.index');
    }
        
    


public function destroy($id)
    {
    $especialidad = SedeEspecialidad::find($id);
        
        $especialidad->delete(); 
   
     Alert::success('Programa Eliminado con éxito')->autoclose(3500);

     return redirect()->route('Especialidad.index');
    }



}
