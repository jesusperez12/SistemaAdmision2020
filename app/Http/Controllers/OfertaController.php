<?php

namespace App\Http\Controllers;

use App\Oferta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\admin;
use App\User;
use Illuminate\Support\Facades\Validator;
//use App\Http\Requests\OfertaRequest;
use App\InstitutoUser;
use App\Periodo;
use App\SedeEspecialidad;
use App\Especialidad;
use App\programas;
use App\Sede;
use App\cuposdiriginos;
use Alert;
use App\Rols;
class OfertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function __construct()

    {

      $this->middleware('permission:ofertas.create')->only(['create','store']);	

      $this->middleware('permission:ofertas.index')->only('index');

      $this->middleware('permission:ofertas.consultaAprobacion')->only('consultaAprobacion');
      $this->middleware('permission:ofertas.aprobar')->only('aprobar');
      $this->middleware('permission:ofertas.desAprobarindex')->only('desAprobarindex');
      $this->middleware('permission:ofertas.desaprobar')->only('desaprobar');
      $this->middleware('permission:ofertas.edit')->only(['edit','update']);

      $this->middleware('permission:ofertas.show')->only('show');

      $this->middleware('permission:ofertas.destroy')->only('destroy');

 
    }

    public function getTipoIngreso(Request $request)
    {

                       $tipoingreMod = cuposdiriginos::where('ModoIngreso_Id',$request->valor)->get();
               
                 /*  $tipoingreMod =DB::table('ofertas')->where('ofertas.ModoIngreso_Id','=',$id)

               ->leftJoin('cupos_dirigidos', 'cupos_dirigidos.id', '=', 'cupos_dirigidos.ModoIngreso_Id')
               ->select('cupos_dirigidos.Cupos','cupos_dirigidos.id')
               ->get();*/

               return response()->json($tipoingreMod);

                   }


 


    public function getsubprogramas($id)
           {


               $subprograma = DB::table('sede_especialidads')

   ->leftJoin('Especialidad', 'Especialidad.id', '=', 'sede_especialidads.Especialidad_id')
   //->leftJoin('Institutos', 'sede_especialidads.Institutos_id', '=', 'Institutos.id')->where('Institutos_id', '=', \Auth::user()->sede_id)

  ->where('sede_especialidads.Institutos_id','=',$id)

    ->pluck("Especialidad.NombEspecialidad","Especialidad.id");
//dd($subprograma);

    return json_encode($subprograma);

                //$subprograma = SedeEspecialidad::where('Programas_id',$request->valor)->get();
             
               //return response()->json($subprograma);

           }


   public function index()
   {

  //  $isEditor = auth()->user()->hasRole('editor');

    //dd($isEditor);
    $id_user=\Auth::user()->id;
    if (\Auth::user()->role_id == '1'){

        $ofertas=DB::table('ofertas')->where('sede_id', '=', \Auth::user()->sede_id)
        //->leftJoin('cupos_dirigidos', 'ofertas.cupos_dirigidos_id', '=', 'cupos_dirigidos.id')
       ->leftJoin('ModoIngreso', 'ofertas.ModoIngreso_Id', '=', 'ModoIngreso.Id')
      // ->leftJoin('ModoIngres', 'ofertas.ModoIngreso_Id', '=', 'ModoIngres.id')
        ->leftJoin('Institutos', 'ofertas.Institutos_id', '=', 'Institutos.id')
       ->leftJoin('Especialidad', 'ofertas.Especialidad_id', '=', 'Especialidad.id')
       ->select('ModoIngreso.ModoIngreso','Institutos.NombInstituto',
       'Especialidad.NombEspecialidad','ofertas.Aprobacion','ofertas.Cuposopsu',
       'ofertas.nroresolucion','ofertas.id','ofertas.created_at')->paginate(4);
    }
    else{

        $ofertas=DB::table('ofertas')->where('sede_id', '=', \Auth::user()->sede_id)
        ->where('ofertas.users_id', '=', $id_user)
        ->leftJoin('ModoIngreso', 'ofertas.ModoIngreso_Id', '=', 'ModoIngreso.Id')
        // ->leftJoin('ModoIngres', 'ofertas.ModoIngreso_Id', '=', 'ModoIngres.id')
          ->leftJoin('Institutos', 'ofertas.Institutos_id', '=', 'Institutos.id')
         ->leftJoin('Especialidad', 'ofertas.Especialidad_id', '=', 'Especialidad.id')
        // ->leftJoin('Programas', 'ofertas.Programas_id', '=', 'Programas.Id')
         ->select('ModoIngreso.ModoIngreso','Institutos.NombInstituto',
         'Especialidad.NombEspecialidad','ofertas.Aprobacion','ofertas.Cuposopsu',
         'ofertas.nroresolucion','ofertas.id','ofertas.created_at')->paginate(4);
    }
   return view('oferta.index',compact('ofertas'));

          } 


     



    public function create()
   {

         

      // $tipos= DB::table('tipo_admision')->where('id_tipo', '!=', \Auth::user()->Id_Tipo)->get();
      // $tipoadmin= DB::table('tipo_admision')->where('id_tipo', '=', \Auth::user()->Id_Tipo)->get();
       $aspirantes=DB::table('ModoIngres')->orderBy('ModoIngreso', 'ASC')->pluck('ModoIngreso','id');

       $cupos=DB::table('CuposOferta')->orderBy('cuposOfer', 'ASC')->pluck('cuposOfer','cuposOfer');

$per=DB::table('sede_especialidads')
->leftJoin('Periodo', 'sede_especialidads.Periodo_id', '=', 'Periodo.id')->orderBy('Lapso','ASC')
->distinct('sede_especialidads.Periodo_id')
->pluck('Lapso','Periodo.id');

/*if (Auth::user()->rols_id == '1'){


        }*/
          $idusuario = Auth::user()->id;
     if(\Auth::user()->sede_id == '10' ){
    $sedeofertas=DB::table('sede_especialidads')//->where('sede_especialidads.users_id', '=', $idusuario) 
       ->leftJoin('Especialidad', 'sede_especialidads.Especialidad_id', '=', 'Especialidad.Id') 

       //->leftJoin('Programas', 'sede_especialidads.Programas_id', '=', 'Programas.id')->orderBy('NombProgramas')
       ->distinct('sede_especialidads.Institutos_id')

       ->leftJoin('Institutos', 'sede_especialidads.Institutos_id', '=', 'Institutos.id')//->where('sede_id', '=', \Auth::user()->sede_id)
       ->orderBy('NombInstituto','ASC')->pluck('NombInstituto','Institutos.id');

     }else{
$sedeofertas=DB::table('sede_especialidads')//->where('sede_especialidads.users_id', '=', $idusuario) 
       ->leftJoin('Especialidad', 'sede_especialidads.Especialidad_id', '=', 'Especialidad.Id') 

       //->leftJoin('Programas', 'sede_especialidads.Programas_id', '=', 'Programas.id')->orderBy('NombProgramas')
       ->distinct('sede_especialidads.Institutos_id')

       ->leftJoin('Institutos', 'sede_especialidads.Institutos_id', '=', 'Institutos.id')->where('sede_id', '=', \Auth::user()->sede_id)
       ->orderBy('NombInstituto','ASC')->pluck('NombInstituto','Institutos.id');
}
  

   return view('oferta.create',compact('aspirantes','sedeofertas','per', 'cupos'));    




}

   public function store(Request $request)
   {

$rules = [
            //'cupos_dirigidos_id'  => 'required',
           'ModoIngreso_Id' => 'required',
           'Institutos_id' => 'required',
            'Cuposofertas' => 'required',
           'Especialidad_id' => 'required',
           'Vigente' => 'required',
           'nroresolucion' => 'required',
          // 'VigenteAct' => 'required',
           'Cuposopsu' => 'required',
          // 'ConvDeAr' =>  'required',
           'ActaConv' => 'required',
           'Periodo_id' => 'required',
           
       ];

       $messages = [
           //'cupos_dirigidos_id'  => 'Este campo es Obligatorio.',
           'ModoIngreso_Id.required' => 'Este campo es Obligatorio.',
           'Institutos_id.required' => 'Este campo es Obligatorio.',
          'Cuposofertas.required' => 'Este campo es Obligatorio.',
           'Especialidad_id.required' => 'Este campo es Obligatorio.',
           'Vigente.required' => 'Este campo es Obligatorio.',
           'nroresolucion.required' => 'Este campo es Obligatorio.',
          // 'VigenteAct.required' => 'Este campo es Obligatorio.',
           'Cuposopsu.required' => 'Este campo es Obligatorio.',
          // 'ConvDeAr.required' => 'Este campo es Obligatorio.',
           'ActaConv.required' => 'Este campo es Obligatorio.',
           'Periodo_id.required' => 'Este campo es Obligatorio.',
          
           

       ];


       $validator = Validator::make($request->all(), $rules, $messages);

       if ($validator->fails()) {
           return redirect()->action('OfertaController@create')
               ->withErrors($validator)->withInput();
       }

       $resultado=DB::table('ofertas')
       ->leftJoin('Especialidad', 'Especialidad.id', '=', 'ofertas.Especialidad_id')
     ->where('Especialidad_id', $request->input('Especialidad_id'))
     ->where('Institutos_id', $request->input('Institutos_id'))
     ->where('ModoIngreso_Id', $request->input('ModoIngreso_Id'))
 
     ->get();
 
        if (count($resultado) >= 1) {
                    
            Alert::error('Error la Especialidaad para este instituto ya existe')->autoclose(3500);
            return redirect()->route('ofertas.create')->withInput();
        
        }



     /* $resultado=DB::table('ofertas')
    ->where('Especialidad_id', $request->input('Especialidad_id'))
    ->where('Institutos_id', $request->input('Institutos_id'))
    ->where('ModoIngreso_Id', $request->input('ModoIngreso_Id'))
    ->exists();

if ($resultado) {
           
   Alert::error('Error la Especialidaad para este instituto ya existe')->autoclose(3500);
   return redirect()->route('ofertas.create')->withInput();

}*/


      //$user = Auth::user();
     /*  $oferta= new oferta(request()->all());
      $oferta->users_id= \Auth::user()->id;
       
      $oferta->save();*/ 
       $oferta = new Oferta;
       $oferta->users_id= \Auth::user()->id;
       $oferta->Aprobacion       = $request->Aprobacion;
       $oferta->ModoIngreso_Id   = $request->ModoIngreso_Id;
       $oferta->Institutos_id    = $request->Institutos_id;
       $oferta->Especialidad_id  = $request->Especialidad_id;
       $oferta->Cuposopsu        = $request->Cuposopsu;
      // $oferta->Programas_id     = $request->Programas_id;
       $oferta->Periodo_id       = $request->Periodo_id;
      // $oferta->Id_Tipo          = $request->Id_Tipo;
       $oferta->Vigente          = $request->Vigente;
       $oferta->Cuposofertas     = $request->Cuposofertas;
       $oferta->ActaConv         = $request->ActaConv;
       $oferta->nroresolucion    = $request->nroresolucion;
      // $oferta->ConvDeAr         = $request->ConvDeAr;
      // $oferta->VigenteAct       = $request->VigenteAct;
     // dd($oferta);
       $oferta->save();

 Alert::success('Oferta creado con éxito')->autoclose(3500);
 
       return redirect()->route('ofertas.index');
   }


   public function show($id)
   {
       $oferta=DB::table('ofertas')->where('ofertas.id', '=', $id)
      ->leftJoin('ModoIngreso', 'ofertas.ModoIngreso_Id', '=', 'ModoIngreso.Id')
       ->leftJoin('ModoIngres', 'ofertas.ModoIngreso_Id', '=', 'ModoIngres.id')
      ->leftJoin('Institutos', 'ofertas.Institutos_id', '=', 'Institutos.id')
      // ->leftJoin('cupos_dirigidos', 'ofertas.cupos_dirigidos_id', '=', 'cupos_dirigidos.id')
     //  ->leftJoin('Programas', 'ofertas.Programas_id', '=', 'Programas.Id')
       ->leftJoin('Periodo', 'ofertas.Periodo_id', '=', 'Periodo.id')
   //   ->leftJoin('sede', 'ofertas.sede_id', '=', 'sede.id_sede')
      ->leftJoin('Especialidad', 'ofertas.Especialidad_id', '=', 'Especialidad.id')
      ->select('ModoIngreso.ModoIngreso', 'Institutos.NombInstituto', 'Especialidad.NombEspecialidad','ofertas.Cuposopsu','ofertas.nroresolucion','ofertas.id','ofertas.Vigente','ofertas.VigenteAct','Periodo.Lapso','ofertas.Cuposofertas','ofertas.ActaConv', 'ModoIngres.ModoIngreso')
       ->first();

   return view('oferta.show',compact('oferta')); 
   }




   public function edit($id)
   {

        $oferta = oferta::find($id);

 $cupos=DB::table('CuposOferta')->orderBy('cuposOfer', 'ASC')->pluck('cuposOfer','cuposOfer');

        $aspirantes=DB::table('ModoIngreso')->orderBy('ModoIngreso', 'ASC')->pluck('ModoIngreso','Id');

        $per=DB::table('sede_especialidads')
        ->leftJoin('Periodo', 'sede_especialidads.Periodo_id', '=', 'Periodo.id')->orderBy('Lapso','ASC')
        ->distinct('sede_especialidads.Periodo_id')
        ->pluck('Lapso','Periodo.id');

    
        $idusuario = Auth::user()->id;
/*$sedeofertas=DB::table('sede_especialidads')//->where('sede_especialidads.users_id', '=', $idusuario) 
     
       ->groupby('sede_especialidads.Institutos_id')

       ->leftJoin('Institutos', 'sede_especialidads.Institutos_id', '=', 'Institutos.id')
       ->where('sede_id', '=', \Auth::user()->sede_id)
       ->orderBy('NombInstituto','ASC')->pluck('NombInstituto','Institutos.id');*/
       $sedeofertas=DB::table('sede_especialidads')//->where('sede_especialidads.users_id', '=', $idusuario) 
       ->leftJoin('Especialidad', 'sede_especialidads.Especialidad_id', '=', 'Especialidad.Id') 

       //->leftJoin('Programas', 'sede_especialidads.Programas_id', '=', 'Programas.id')->orderBy('NombProgramas')
       ->distinct('sede_especialidads.Institutos_id')

       ->leftJoin('Institutos', 'sede_especialidads.Institutos_id', '=', 'Institutos.id')->where('sede_id', '=', \Auth::user()->sede_id)
       ->orderBy('NombInstituto','ASC')->pluck('NombInstituto','Institutos.id');

 $subprogramas= DB::table('ofertas')
   ->where('ofertas.users_id', '=', $idusuario) 
       ->leftJoin('Especialidad', 'ofertas.Especialidad_id', '=', 'Especialidad.id')
       ->orderBy('NombEspecialidad','ASC')
       ->pluck('NombEspecialidad','Especialidad.Id');

//dd($subprogramas);
   
       return view('oferta.edit',compact('aspirantes','programas','subprogramas', 'cupos', 'sedeofertas','oferta', 'per'));
   }






   public function update(Request $request, $id)
   {

$rules = [
            //'cupos_dirigidos_id'  => 'required',
           'ModoIngreso_Id' => 'required',
           'Institutos_id' => 'required',
            'Cuposofertas' => 'required',
           'Especialidad_id' => 'required',
           'Vigente' => 'required',
           'nroresolucion' => 'required',
          // 'VigenteAct' => 'required',
           'Cuposopsu' => 'required',
          // 'ConvDeAr' =>  'required',
           'ActaConv' => 'required',
           'Periodo_id' => 'required',
           
       ];

       $messages = [
           //'cupos_dirigidos_id'  => 'Este campo es Obligatorio.',
           'ModoIngreso_Id.required' => 'Este campo es Obligatorio.',
           'Institutos_id.required' => 'Este campo es Obligatorio.',
          'Cuposofertas.required' => 'Este campo es Obligatorio.',
           'Especialidad_id.required' => 'Este campo es Obligatorio.',
           'Vigente.required' => 'Este campo es Obligatorio.',
           'nroresolucion.required' => 'Este campo es Obligatorio.',
          // 'VigenteAct.required' => 'Este campo es Obligatorio.',
           'Cuposopsu.required' => 'Este campo es Obligatorio.',
          // 'ConvDeAr.required' => 'Este campo es Obligatorio.',
           'ActaConv.required' => 'Este campo es Obligatorio.',
           'Periodo_id.required' => 'Este campo es Obligatorio.',
          
           

       ];


       $validator = Validator::make($request->all(), $rules, $messages);

       if ($validator->fails()) {
           return redirect()->action('OfertaController@edit',$id)
               ->withErrors($validator)->withInput();
       }






       $oferta = oferta::find($id);
      $oferta->users_id= \Auth::user()->id;
      // $oferta->Id_Tipo          = $request->Id_Tipo;
     
       $oferta->Aprobacion       = $request->Aprobacion;
       $oferta->ModoIngreso_Id   = $request->ModoIngreso_Id;
       $oferta->Institutos_id    = $request->Institutos_id;
       $oferta->Especialidad_id  = $request->Especialidad_id;
       $oferta->Cuposopsu        = $request->Cuposopsu;
      // $oferta->Programas_id     = $request->Programas_id;
       $oferta->Periodo_id       = $request->Periodo_id;
      // $oferta->Id_Tipo          = $request->Id_Tipo;
       $oferta->Vigente          = $request->Vigente;
       $oferta->Cuposofertas     = $request->Cuposofertas;
       $oferta->ActaConv         = $request->ActaConv;
       $oferta->nroresolucion    = $request->nroresolucion;
      // $oferta->VigenteAct       = $request->VigenteAct;
     

       $oferta->update();
 Alert::success('Oferta Actualizada con éxito')->autoclose(3500);
   
       return redirect()->route('ofertas.index');
  }

   public function destroy($id)
   { 
       $oferta = Oferta::find($id);
       $oferta->delete(); 
       Alert::success('Programa Eliminado con éxito')->autoclose(3500);

       return redirect()->route('ofertas.index');
      }

   public function form()
   {
       $tipos= DB::table('tipo_admision')->where('id_tipo', '!=', \Auth::user()->Id_Tipo)->get();
       $tipoadmin= DB::table('tipo_admision')->where('id_tipo', '=', \Auth::user()->Id_Tipo)->get();
       $aspirantes= DB::table('TipoAspirante')->get();
       $sedes= DB::table('sedes')->where('id_sede', '=', \Auth::user()->id_sede)->get();
       $especialidades= DB::table('sede_especialidads')->where('sede.id_sede', '=', \Auth::user()->id_sede)
       ->leftJoin('Especialidad', 'sede_especialidads.Especialidad_id', '=', 'Especialidad.Id')
       ->leftJoin('sede', 'sede_especialidads.Sede_Id', '=', 'sede.id_sede')->get();
       
   return view('oferta.fragment.form',compact('aspirantes','sedes','especialidades','tipos','tipoadmin'));    
   }


    public function consultaAprobacion(Request $request)
   {
    $NombInstituto  = $request->get('NombInstituto');
    $NombEspecialidad  = $request->get('NombEspecialidad');        

$noaprob = "0";
$ofertas = Oferta::where('ofertas.Aprobacion', '=', $noaprob)

->leftJoin('ModoIngres', 'ofertas.ModoIngreso_Id', '=', 'ModoIngres.id')
->leftJoin('Especialidad', 'ofertas.Especialidad_Id', '=', 'Especialidad.id')
->leftJoin('Institutos', 'ofertas.Institutos_id', '=', 'Institutos.id')
->select('ModoIngres.ModoIngreso','Institutos.NombInstituto','Especialidad.NombEspecialidad','ofertas.id','ofertas.Cuposopsu','ofertas.Cuposofertas','ofertas.nroresolucion','ofertas.created_at')
   ->NombInstituto($NombInstituto)
   ->especialidad($NombEspecialidad)
   
   ->paginate(25);
   //dd($ofertas);

   $users=DB::table('users')->where('id', '=', \Auth::user()->id)
   ->leftJoin('sede', 'users.sede_id', '=', 'sede.id_sede')
   ->get();

$siaprob = "1";
   $aprobar=DB::table('ofertas')->where('ofertas.Aprobacion', '=', $siaprob)
   ->leftJoin('ModoIngreso', 'ofertas.ModoIngreso_Id', '=', 'ModoIngreso.Id')
   ->leftJoin('Institutos', 'ofertas.Institutos_id', '=', 'Institutos.id')
   ->leftJoin('Especialidad', 'ofertas.Especialidad_Id', '=', 'Especialidad.id')
  
  
   ->select('ModoIngreso.ModoIngreso','Institutos.NombInstituto', 'Especialidad.NombEspecialidad','ofertas.Cuposofertas','ofertas.Cuposopsu','ofertas.nroresolucion','ofertas.id','ofertas.created_at')
   ->paginate(4);
  
return view('oferta.indexporAprobar',compact('ofertas','aproba <form >','users'));  


   }

   public function Aprobar(Request  $request)
   {
     
       $var="1";
       $data = $request['aprobacion'];
       foreach ($data as $aprobar) {
                 $p = oferta::where('id', '=', $aprobar)->firstOrFail();
 
                 $p->Aprobacion = $var;
 
                 $p->save();
 
             }
            
      Alert::success('Aprobado con Exito')->autoclose(3500);
      return  redirect()->route('ofertas.consultaAprobacion');
      
   }





    public function ofertasdesaprobadas(Request $request)
   {
    $NombInstituto  = $request->get('NombInstituto');
    //$NombProgramas     = $request->get('NombProgramas');
    
     $siaprob = "1";
    
            $aprobar=Oferta::where('ofertas.Aprobacion', '=', $siaprob)
            ->leftJoin('ModoIngreso', 'ofertas.ModoIngreso_Id', '=', 'ModoIngreso.Id')
            ->leftJoin('Especialidad', 'ofertas.Especialidad_Id', '=', 'Especialidad.id')
            ->leftJoin('Institutos', 'ofertas.Institutos_id', '=', 'Institutos.id')
            ->select('ModoIngreso.ModoIngreso','Institutos.NombInstituto','Especialidad.NombEspecialidad','ofertas.id','ofertas.Cuposopsu','ofertas.Cuposofertas','ofertas.nroresolucion','ofertas.created_at')
                ->NombInstituto($NombInstituto)
                ->paginate(25);
    
        $users=DB::table('users')->where('id', '=', \Auth::user()->id)
            ->leftJoin('sede', 'users.sede_id', '=', 'sede.id_sede')
            
            ->get();
            // Alert::success('Execelente', 'Oferta Aprobada con exito')->autoclose(3500);
            return view('oferta.indexdesaprobar',compact('users','ofertas','aprobar'));

    /* //  dd($id);
       $i="0";
           $aprob=oferta::findOrFail($id);
           $aprob->Aprobacion=$i; 
           // $aprob->Institutos_id=$id;             
            $aprob->save();
            return back()->with('info','Deshabilitado con éxito');*/
   }



   public function desAprobar(Request  $request)
   {
     
       $var="0";
       $data = $request['aprobacion'];
       foreach ($data as $aprobar) {
                 $p = oferta::where('id', '=', $aprobar)->firstOrFail();
 
                 $p->Aprobacion = $var;
 
                 $p->save();
 
             }
            
      Alert::success('Desaprobado con Exito')->autoclose(3500);
      return  redirect()->route('ofertas.desAprobarindex');
      
   }




   
}
