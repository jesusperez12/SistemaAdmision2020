<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Deposito;
use App\Banco;
use App\modingress;
use App\modoingreso;
use App\DatosBasicos;
use App\Datosaspirante;
use App\Especialidad;
use App\SedeEspecialidades;
use App\sede;
use App\Ofertas;
use App\oferta;
use App\Programas;
use App\cuposdiriginos;
use App\audit;
use App\InstitutoUser;
use App\Http\Requests\DatosBasicosFormRequest;
use Illuminate\Support\Facedes\Redirect;
use DB;
use App\Level;
use Carbon\Carbon;
use Alert;
class DepositoController extends Controller
{
    protected $redirectTo = '/Datosbasicos/create';

   

    public function __construct(){

        $this->middleware('auth:UsuariosAspi');
    }

 public function index(){

 //$DatosAspirante = $this->obtenerDatos();

            $id_user=\Auth::user()->id;

    
        //dd($idaspi);

         $Datos=DB::table('DatosBasicos')->where('DatosBasicos.user_id', '=', $id_user)
        ->leftJoin('ModoIngreso', 'DatosBasicos.ModoIngreso_id', '=', 'ModoIngreso.id')
        ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
        ->select('ModoIngreso.ModoIngreso','Institutos.NombInstituto','DatosBasicos.id')->get($id_user);

        $deposito=DB::table('Deposito')->where('Deposito.user_id', '=', $id_user)
        ->leftJoin('Banco', 'Deposito.Banco_id', '=', 'Banco.id')
        //->leftJoin('Especialidad', 'Deposito.Especialidad_Id', '=', 'Especialidad.Id')
       // ->leftJoin('sede', 'DatosBasicos.sede_id', '=', 'sede.id_sede')
        ->select('Deposito.NumDeposito','Deposito.FechaDeposito','Deposito.id','Banco.NombBanco')->get($id_user); 
    
    $DatosBasicos=DB::table('DatosBasicos')->where('DatosBasicos.user_id', '=', $id_user)
        ->leftJoin('ModoIngreso', 'DatosBasicos.ModoIngreso_id', '=', 'ModoIngreso.id')
        ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
        ->leftJoin('Especialidad', 'DatosBasicos.Especialidad_a_cursar1_id', '=', 'Especialidad.id')
        ->leftJoin('Especialidad as a', 'DatosBasicos.Especialidad_a_cursar2_id', '=', 'a.id')
        ->leftJoin('Especialidad as b', 'DatosBasicos.Especialidad_a_cursar3_id', '=', 'b.id')
        ->select('ModoIngreso.ModoIngreso','Institutos.NombInstituto','a.NombEspecialidad as curso2','b.NombEspecialidad as curso3', 'Especialidad.NombEspecialidad','DatosBasicos.id')->get($id_user);
//dd($DatosBasicos);


        $depositodatos=DB::table('Deposito')->where('Deposito.user_id', '=', $id_user)
        ->leftJoin('Banco', 'Deposito.Banco_id', '=', 'Banco.id')
        //->leftJoin('Especialidad', 'Deposito.Especialidad_Id', '=', 'Especialidad.Id')
       // ->leftJoin('sede', 'DatosBasicos.sede_id', '=', 'sede.id_sede')
        ->select('Deposito.NumDeposito','Deposito.FechaDeposito','Deposito.id','Banco.NombBanco')->first($id_user);
  
       /* $fechadepo=$deposito->FechaDeposito;

        $fechad=Carbon::parse($fechadepo)->format('d/m/Y');*/
  ///$deposito=Carbon::parse($request->input('FechaDeposito'))->format('d/m/Y'); 
   // $fecha=Carbon::createFromFormat('d/m/Y');    
    //dd($fechad);


        $aprob = "1";

     
        $banco =Banco::orderBy('NombBanco','ASC')->pluck('NombBanco','id'); 
       
    $sedeofertas=DB::table('ofertas')->where('ofertas.Aprobacion', '=', $aprob)
       // ->leftJoin('Especialidad', 'ofertas.Especialidad_Id', '=', 'Especialidad.Id')
        ->leftJoin('Institutos', 'ofertas.Institutos_id', '=', 'Institutos.id')->orderBy('NombInstituto')
        //->groupby('ofertas.sede_id')
        ->orderBy('NombInstituto','ASC')->pluck('NombInstituto','Institutos.id');


        $modingreso=modingress:: orderBy('ModoIngreso','ASC')->pluck('ModoIngreso','Id');

   
        return view('Aspidatos.indexBasico',compact('Datos','deposito','fechad','banco','sedeofertas','modingreso', 'depositodatos', 'DatosBasicos'));


    }


    

   public function create()
    {
        $aprob = "1";

        $deposito=Deposito::get();
        $banco =Banco::orderBy('NombBanco','ASC')->pluck('NombBanco','id'); 
       
    $sedeofertas=DB::table('ofertas')->where('ofertas.Aprobacion', '=', $aprob)
        ->leftJoin('Especialidad', 'ofertas.Especialidad_Id', '=', 'Especialidad.Id')
        ->leftJoin('Institutos', 'ofertas.Institutos_id', '=', 'Institutos.id')->orderBy('NombInstituto')
        //->groupby('ofertas.sede_id')
        ->orderBy('NombInstituto','ASC')->pluck('NombInstituto','Institutos.id');


        $modingreso= DB::table('ModoIngreso')->where('ModoIngreso.Id', '=', '9')
        ->orWhere('ModoIngreso.Id','=' ,'8')->orderBy('ModoIngreso','ASC')->pluck('ModoIngreso','id'); 
        //$deposito=Deposito::get();
        //$banco =Banco::get();
        //$modingreso =modingresos::get();
       // $basico =Datosbasicos::get();
       // $especialidad =Especialidad::get();
       //$sede=sede::get();
       // $asp=Aspirante::get();

        return view('Aspidatos.form', compact('deposito','banco','modingreso','especialidad','sede','sedeofertas'));
    }

    public function getNuevoIngreso($id)
    {
       
     /*  $modingreso= oferta::first();
       $idmodo=$modingreso->users_id;
       // dd($idmodo);*/
        $modoingreso =DB::table('ofertas')->where('ofertas.ModoIngreso_Id','=',$id)
       
            ->leftJoin('Institutos', 'Institutos.id', '=', 'ofertas.Institutos_id')
            ->pluck("Institutos.NombInstituto","Institutos.id");
            return json_encode($modoingreso);

    }
 

                    public function getTipoIngreso(Request $request){

                        $tipoingreMod = cuposdiriginos::where('ModoIngreso_Id',$request->valor)->get();
                
                  /*  $tipoingreMod =DB::table('ofertas')->where('ofertas.ModoIngreso_Id','=',$id)

                ->leftJoin('cupos_dirigidos', 'cupos_dirigidos.id', '=', 'cupos_dirigidos.ModoIngreso_Id')
                ->select('cupos_dirigidos.Cupos','cupos_dirigidos.id')
                ->get();*/

                return response()->json($tipoingreMod);

                    }


                        public function getEspecialidadcurso1($id)
                        {
                       
                        $Especialidadcurso1 =DB::table('ofertas')
                        ->where('ofertas.Institutos_id','=',$id)
                   
                    ->leftJoin('Especialidad', 'Especialidad.id', '=', 'ofertas.Especialidad_id')
                    ->pluck('Especialidad.NombEspecialidad','Especialidad.id');
                    
                    
                    return json_encode($Especialidadcurso1);

                        }

                        public function getEspecialidadcurso2($id)
                        {
                        // dd($institutoId,$programaId);
                        $Especialidadcurso2 =DB::table('ofertas')->where('ofertas.Institutos_id','=',$id)
                    //->where('ofertas.Programas_id','=', $id)
                    ->leftJoin('Especialidad', 'Especialidad.id', '=', 'ofertas.Especialidad_id')
                    
                    // ->where('ofertas.Institutos_id', $institutoId)
                    
                    ->pluck('Especialidad.NombEspecialidad','Especialidad.id');
                   
                    
                    return json_encode($Especialidadcurso2);

                        }

                    public function getEspecialidadcurso3($id)
                        {
                        // dd($institutoId,$programaId);
                        $Especialidadcurso3 =DB::table('ofertas')->where('ofertas.Institutos_id','=',$id)
                    //->where('ofertas.Programas_id','=', $id)
                    ->leftJoin('Especialidad', 'Especialidad.id', '=', 'ofertas.Especialidad_id')
                    
                    // ->where('ofertas.Institutos_id', $institutoId)
                    
                    ->pluck('Especialidad.NombEspecialidad','Especialidad.id');
                    
                    return json_encode($Especialidadcurso3);
                    

                        }





    public function store(Request $request ){

          $mytime = Carbon::now();
      $fecha= $mytime; 
       // dd($fecha);
    
   
       $rules = [
            'FechaDeposito' => 'nullable|date_format:d/m/Y',
            'Banco_id'  =>'nullable',
            'NumDeposito' =>'nullable|digits_between:4,8|numeric',
            'deposito_confirm' =>'nullable|numeric|digits_between:4,8|same:NumDeposito',
            'cupos_dirigidos_id'=>'required',
            'ModoIngreso_Id' =>'required',
            'Institutos_id' =>'required',
            'Especialidad_a_cursar1_id' =>'required',
            'Especialidad_a_cursar2_id' =>'required',
            'Especialidad_a_cursar3_id' =>'required'
           
        ];


 $messages = [
    'FechaDeposito.required' => 'La Fecha es Obligatoria/Incorrecta.',
    'Banco_id.required' => 'Debes seleccionar el banco donde realizo su transacción.',
    'NumDeposito.required' => 'Por Favor Es Importante El Numero de Deposito.',
    'deposito_confirm.required' => 'Por Favor Es Importante la Comfirmacion del de Deposito.',
            'ModoIngreso_Id.required' => 'Este Campo es Obligatorio.',
            'cupos_dirigidos_id.required' => 'Este Campo es Obligatorio.',
            'Institutos_id.required' => 'El instituto es Requerido .',
            'Especialidad_a_cursar1_id.required' => 'La Especialidad curso 1 es Obligatoria.',
            'Especialidad_a_cursar2_id.required' => 'La Especialidad curso 2 es Obligatoria.',
            'Especialidad_a_cursar3_id.required' => 'La Especialidad curso 3 es Obligatoria.',
        
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->action('DepositoController@index')
                ->withErrors($validator)
                ->withInput();
        }



        $id_user=\Auth::user()->id;
        $activo = "1";
        $per= DB::table('Periodo')
        ->where('Periodo.Vigente', '=',$activo)->first();
       $idperiodo=$per->id;     
         
   $Dato =DB::select('SELECT AspPregrado.id FROM AspPregrado , UsuariosAspi where   UsuariosAspi.id=user_id and    UsuariosAspi.id ='.$id_user);
  
  
   $fechadeposito=  $request->input('FechaDeposito');
  // dd($fechadeposito,$fecha);
 /*  $inputmodoingreso=  $request->input('ModoIngreso_Id');
 
   $modingreso= DB::table('ModoIngreso')->where('ModoIngreso.Id', '=', '1')
   ->select('ModoIngreso.ModoIngreso','ModoIngreso.id')->first();
   $mod=$modingreso->id;  */   

//if ($mod = $inputmodoingreso) {


    
            if($fechadeposito  <= $fecha) 
                # code...
            
            {
                
                $deposito= new Deposito(request()->all());
                $deposito->user_id= \Auth::user()->id;
                $deposito->FechaDeposito = $request->filled('FechaDeposito') ? Carbon::createFromFormat('d/m/Y', $request->input('FechaDeposito')):null;
                //$deposito->FechaDeposito=Carbon::createFromFormat( 'd/m/Y', $request->input('FechaDeposito'));
                $deposito->AspPregrado_id = $Dato[0]->id;
                $deposito->Periodo_id=$idperiodo;
                // $deposito->rols_id  = $request->rols_id;
            //  dd($deposito);
            
                $deposito->save();
                
                  
   $basico=new DatosBasicos(request()->all());
   $basico->user_id= \Auth::user()->id;
   $basico->AspPregrado_id = $Dato[0]->id;  
   $basico->Periodo_id=$idperiodo;
   //dd($basico);
   $basico->save();
   
   $nombre_especialidad1 = Especialidad::find($request->input('Especialidad_a_cursar1_id'))->NombEspecialidad;
   $nombre_especialidad2 = Especialidad::find($request->input('Especialidad_a_cursar2_id'))->NombEspecialidad;
   $nombre_especialidad3 = Especialidad::find($request->input('Especialidad_a_cursar3_id'))->NombEspecialidad;
   $modoingreso = modingress::find($request->input('ModoIngreso_Id'))->ModoIngreso;
   $institutos = InstitutoUser::find($request->input('Institutos_id'))->NombInstituto;
   
   $info = array(
       ('ModoIngreso') =>  $modoingreso,
       ('Especialidad_Cursando_1')=>   $nombre_especialidad1,
       ('Especialidad_Cursando_2')=>   $nombre_especialidad2,
       ('Especialidad_Cursando_3')=>   $nombre_especialidad3,
       ('Institutos')=>  $institutos,
       
       
       );
   
   
   $array_json = json_encode($info);
   // $array_json->modoingreso->ModoIngreso;
   // dd($array_json);
   $Datobasico =DB::select('SELECT DatosBasicos.id FROM DatosBasicos , UsuariosAspi where   UsuariosAspi.id=user_id and    UsuariosAspi.id ='.$id_user);
   $Acciones="Creacion";
   $fechacreacion = Carbon::now();
   
   $auditoria=new audit(request()->all());
   $auditoria->datosbasicos_id = $Datobasico[0]->id; 
   $auditoria->accion =$Acciones;  
   $auditoria->Created_at =$fechacreacion;  
   
   $auditoria->Registro =$array_json; 
       
   $auditoria->save();
   
       \Auth::user()->update([
   'datos_basicos' => 1,
   ]);
            
            
            
                }
        
            else { 
                alert()->error('Error', 'Fecha de deposito no puede ser mayor que la fecha actual')->autoclose(2500);
                                
                return redirect()->route('Datosbasicos.index')->withInput();
            
                }
            
            
                alert()->success(' ', 'Su datos fueron guardado correctamente')->autoclose(2500);
                return redirect()->route('Datosbasicos.index');
            

    }




    public function show($id)
    {

    }


    public function byproyect($id)
    {
       return DatosBasicos::where('sede_id',$id)->get();
    }

     public function edit($id)
    {
        $id_user=\Auth::user()->id;
        
         $deposito=DB::table('Deposito')->where('Deposito.user_id', '=', $id_user)
        ->leftJoin('Banco', 'Deposito.Banco_id', '=', 'Banco.id')
        //->leftJoin('Especialidad', 'Deposito.Especialidad_Id', '=', 'Especialidad.Id')
       // ->leftJoin('sede', 'DatosBasicos.sede_id', '=', 'sede.id_sede')
        ->select('Deposito.NumDeposito','Deposito.FechaDeposito','Deposito.id','Banco.NombBanco')->first($id_user);
  
       $fechadepo=$deposito->FechaDeposito;

        $fechad=Carbon::parse($fechadepo)->format('d/m/Y');

        //$Datos=DatosBasicos::find($id);
        $deposito=Deposito::find($id);
        $banco =Banco::orderBy('NombBanco','ASC')->pluck('NombBanco','id'); 
     
    

        return view('Aspidatos.editDatosDeposito', compact('fechad','deposito','banco'));
    }


    public function geteditDatBasicos($id, Request $request )
    {
          $id_user=\Auth::user()->id;
        $aprob = "1";

           $Datosbasico=DB::table('DatosBasicos')->where('DatosBasicos.user_id', '=', $id_user)
        ->leftJoin('ModoIngreso', 'DatosBasicos.ModoIngreso_id', '=', 'ModoIngreso.id')
        ->leftJoin('Especialidad', 'DatosBasicos.Especialidad_a_cursar1_id', '=', 'Especialidad.id')
        ->leftJoin('Especialidad as a', 'DatosBasicos.Especialidad_a_cursar2_id', '=', 'a.id')
        ->leftJoin('Especialidad as b', 'DatosBasicos.Especialidad_a_cursar3_id', '=', 'b.id')
        ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
        //->leftJoin('Programas', 'DatosBasicos.Programas_id', '=', 'Programas.id')
        ->select('ModoIngreso.ModoIngreso','a.NombEspecialidad as curso2','b.NombEspecialidad as curso3', 'Especialidad.NombEspecialidad','Institutos.NombInstituto','DatosBasicos.id')->first($id_user);
      //dd($Datosbasico);
      //InstitutoUser::orderBy('NombInstituto','ASC')->pluck('NombInstituto','id');
        $sedeofertas=DB::table('ofertas')->where('ofertas.Aprobacion', '=', $aprob)
        ->leftJoin('Especialidad', 'ofertas.Especialidad_Id', '=', 'Especialidad.Id')
        ->leftJoin('Institutos', 'ofertas.Institutos_id', '=', 'Institutos.id')->orderBy('NombInstituto','ASC')->pluck('NombInstituto','Institutos.id'); 
        //->groupby('ofertas.sede_id')
        

        $modingreso=modoingreso::orderBy('ModoIngreso','ASC')->pluck('ModoIngreso','id');

        $especialidaDatosBasic= DB::table('DatosBasicos')->where('DatosBasicos.user_id', '=', $id_user)
        ->leftJoin('Especialidad', 'DatosBasicos.Especialidad_a_cursar1_id', '=', 'Especialidad.id')
       //dd($Datosbasico);
        ->first();
        $curso1=$especialidaDatosBasic->Especialidad_a_cursar1_id;

        $especialidades=Especialidad::orderBy('NombEspecialidad','ASC')->pluck('NombEspecialidad','id'); 
       
        
       
         
       // dd($especialidades);

       
        //$especialidad =Especialidad::get();
       // Datos$sedeofertas=sede::get();
        $Datos=DatosBasicos::find($id);
        ///dd($Datos);
       

           

        return view('Aspidatos.editDatosBasicos', compact('especialidades','Datos','programass','basico','modingreso','programas','sedeofertas'));
    }


     public function getUpdateDatBasicos(Request $request, $id)
    {
      //dd($id);
         $rules = [
          
            'ModoIngreso_Id' =>'required',
             'Institutos_id' =>'required',
           
        ];


 $messages = [
            'ModoIngreso_Id.required' => 'Este Campo es Obligatorio.',
            'Institutos_id.required' => 'Este Campo es Requerido .',
           // 'Especialidad_Id.required' => 'La Especialidad es Obligatoria.',
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->action('DepositoController@getUpdateDatBasicos',$id)
                ->withErrors($validator)
                ->withInput();
        }

        $basico=DatosBasicos::findOrFail($id);
        $basico->ModoIngreso_Id=$request->get('ModoIngreso_Id');
        $basico->Especialidad_a_cursar1_id=$request->get('Especialidad_a_cursar1_id');  
        $basico->Especialidad_a_cursar2_id=$request->get('Especialidad_a_cursar2_id');  
        $basico->Especialidad_a_cursar3_id=$request->get('Especialidad_a_cursar3_id');  
        $basico->Institutos_id=$request->get('Institutos_id'); 
        $basico->update(); 
        
        $nombre_especialidad = Especialidad::find($request->input('Especialidad_a_cursar1_id'))->NombEspecialidad;
        $curso2 = Especialidad::find($request->input('Especialidad_a_cursar2_id'))->NombEspecialidad;
        $curso3 = Especialidad::find($request->input('Especialidad_a_cursar3_id'))->NombEspecialidad;
        $modoingreso = modingress::find($request->input('ModoIngreso_Id'))->ModoIngreso;
        $institutos = InstitutoUser::find($request->input('Institutos_id'))->NombInstituto;
        
        $info = array(
            ('ModoIngreso') =>  $modoingreso,
            ('Especialidad a cursar 1')=>   $nombre_especialidad,
            ('Especialidad a cursar 2')=>   $curso2,
            ('Especialidad a cursar 3')=>   $curso3,
            ('Programas') =>  $programas,
            ('Institutos')=>  $institutos,
          
           
            );
          
            
$array_json = json_encode($info);
       // $array_json->modoingreso->ModoIngreso;
      // dd($array_json);
      
     
      $id_user=\Auth::user()->id;
            
         $Datobasico =DB::select('SELECT DatosBasicos.id FROM DatosBasicos , UsuariosAspi where   UsuariosAspi.id=user_id and    UsuariosAspi.id ='.$id_user);
         $Acciones="Modificacion";
         $fechacreacion = Carbon::now();

         $auditoria=new audit(request()->all());
         $auditoria->datosbasicos_id = $Datobasico[0]->id; 
         $auditoria->accion =$Acciones;  
         $auditoria->Created_at =$fechacreacion;  
        
         $auditoria->Registro =$array_json; 
          
         $auditoria->save();
       

         alert()->success(' ', 'Actualización exitosa')->autoclose(2500);
        return redirect()->route('Datosbasicos.index');
    }



    public function update(Request $request, $id)
    {
                    $rules = [
                        'FechaDeposito' => 'required|date_format:d/m/Y',
                        'Banco_id'  =>'required',
                        'NumDeposito' =>'nullable|digits_between:4,8|numeric',
                        'deposito_confirm' =>'nullable|numeric|digits_between:4,8|same:NumDeposito',
                    ];


            $messages = [
                'FechaDeposito.required' => 'La Fecha es Obligatoria/Incorrecta.',
                'Banco_id.required' => 'Debes Ingresar el Banco Donde Realizo su Transacción.',
                'NumDeposito.required' => 'Por Favor Es Importante El Numero de Deposito.',
                'deposito_confirm.required' => 'Por Favor Es Importante la Comfirmacion del de Deposito.',  
                    
                    ];


                    $validator = Validator::make($request->all(), $rules, $messages);

                    if ($validator->fails()) {
                        return redirect()->action('DepositoController@edit',$id)
                            ->withErrors($validator)
                            ->withInput();
                    }

                $mytime = Carbon::now();
                $fecha= $mytime; 
                // dd($fecha);
                $fechadeposito= Carbon::createFromFormat( 'd/m/Y', $request->input('FechaDeposito'));
                //dd($fecha,$fechadeposito);
                //$depofecha=$fechadeposito;


                if ($fechadeposito  <= $fecha) 
                # code...
            
            {
                
                    $deposito=Deposito::findOrFail($id);
                    $deposito->NumDeposito=$request->get('NumDeposito');
                    $deposito->deposito_confirm=$request->get('deposito_confirm');
                    $deposito->FechaDeposito=$request->FechaDeposito= Carbon::createFromFormat( 'd/m/Y', $request->input('FechaDeposito'));  
                    $deposito->Banco_id=$request->get('Banco_id');
                    $deposito->update();


                    alert()->success(' ', 'Actualización exitosa')->autoclose(2500);
                    return redirect()->route('Datosbasicos.index');

                }
                    
            else { 
                    alert()->error('Error', 'Fecha de deposito invalida')->autoclose(2500);
                    
                    return redirect()->route('Datosbasicos.edit',$id)->withInput();
                }
        }




}


