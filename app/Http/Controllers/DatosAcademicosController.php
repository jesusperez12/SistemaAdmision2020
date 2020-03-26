<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facedes\Redirect;
use Illuminate\Support\Facades\Validator;
use App\DatosAcademico;
use App\Pais;
use App\titulos;
use App\EducacionMedia;
use App\Estado; //MODELO LLAMADO DE LA TABLA
use App\Municipio; //MODELO LLAMADO DE LA TABLA
use DB;
use Carbon\Carbon;
use Alert;
class DatosAcademicosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){

        $this->middleware('auth:UsuariosAspi');
    }

    public function getEstado(Request $request){

      $estado = Estado::where('Pais_id',$request->valor)->get();
      //dd($Municipio);
         //$estado = Estado::find($request->valor);
        // $parroquia= Parroquias::has('parroquia')->get();
         return response()->json($estado);
     }
 
     
     public function getMunicipios(Request $request){
 
      $Municipio = Municipio::where('Estados_id',$request->valor)->get();
      //dd($Municipio);
         //$estado = Estado::find($request->valor);
        // $parroquia= Parroquias::has('parroquia')->get();
         return response()->json($Municipio);
     }




    public function index(Request $request)
    {
        $id_user=\Auth::user()->id;
       // dd($id_user);
        $DatosAcademicos=DB::table('datosAcademico')->where('datosAcademico.user_id', '=', $id_user)
      ->leftJoin('Estados', 'datosAcademico.Estados_id', '=', 'Estados.id')
      ->leftJoin('Municipios', 'datosAcademico.Municipio_id', '=', 'Municipios.id')
      ->leftJoin('RamasEducacionMedia', 'datosAcademico.RamasEducacion_id', '=', 'RamasEducacionMedia.id')
      ->select('RamasEducacionMedia.ramas','Estados.Estado','Municipios.Municipio',
      'datosAcademico.sistemaEstudio','datosAcademico.DependenciaPlantel','datosAcademico.namePlantel',
      'datosAcademico.NumeroRNI','datosAcademico.TurnoEstudio','datosAcademico.id','datosAcademico.Promedio')
      ->get($id_user);
      //  dd($DatosAcademicos);


        $municipio =Municipio::orderBy('Municipio','ASC')->pluck('Municipio','id'); 
        $RamasMedia=EducacionMedia::
        orderBy('ramas','ASC')->pluck('ramas','id'); 
        $estado =Estado::orderBy('Estado','ASC')->pluck('Estado','id'); 
        return view('Aspidatos.indexAcademicos', compact('DatosAcademicos','municipio','RamasMedia','estado'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $municipio =Municipio::orderBy('Municipio','ASC')->pluck('Municipio','id'); 
        $RamasMedia=EducacionMedia::
        orderBy('ramas','ASC')->pluck('ramas','id'); 
        $estado =Estado::orderBy('Estado','ASC')->pluck('Estado','id'); 
        return view('Aspidatos.Academicoform', compact('DatosAcademicos','municipio','RamasMedia','estado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            
            'NumeroRNI' => 'required|numeric',
            'namePlantel'  =>'required|alpha',
            'Estados_id'  =>'required',
            'TurnoEstudio' =>'required',
            'sistemaEstudio' =>'required',
            'DependenciaPlantel' =>'required',
             'Municipio_id' =>'required',
            'Promedio' =>'required',
            'RamasEducacion_id' =>'required'
           
        ];


         $messages = [
            'NumeroRNI.required' => 'Debes Completar este Campo',
            'namePlantel.required' => 'Debes Completar este Campo.',
            'Estados_id.required' => 'Debes Completar este Campo.',
            'TurnoEstudio.required' => 'No se Puede dejar este Campo Vacio.',
            'sistemaEstudio.required' => 'Este Campo es Obligatorio.',
            'DependenciaPlantel.required' => 'Este Campo es Requerido .',
            'Promedio.required' => 'El Promedio es Obligatoria.',
            'Municipio_id.required' => 'No se permite dejar este campo vacio.',
        	'RamasEducacion_id.required' => 'El Campo Educacion Media es Requerido.',
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->action('DatosAcademicosController@index')
                ->withErrors($validator)
                ->withInput();
        }

        $id_user=\Auth::user()->id;
            
         
           $Dato =DB::select('SELECT AspPregrado.id FROM AspPregrado , UsuariosAspi where   UsuariosAspi.id=user_id and    UsuariosAspi.id ='.$id_user);

       
     //  dd($fecha);
       $activo="1";
       $per= DB::table('Periodo')
       ->where('Periodo.Vigente', '=',$activo)->first();
      $idperiodo=$per->id;  

      $promediovar='20.00';
      $promediomenor='10';
      $inpu=$request->input('Promedio');
      //dd($promediovar,$inpu);
      if ($inpu  > $promediovar ) {
        session()->flash('error','Tu promedio no puede ser mayor de 20');
        return redirect()->route('Academico')->withInput();
      }elseif($inpu  < $promediomenor ){
        session()->flash('error','Tu promedio no puede ser menor que 10');
        return redirect()->route('Academico.index')->withInput();
      }
   
	 	$academico= new DatosAcademico(request()->all());
	 	$academico->AspPregrado_id = $Dato[0]->id;
        $academico->user_id= \Auth::user()->id;
        $academico->Periodo_id=$idperiodo;
       // $academico->Promedio== (float) ($request->input('Promedio'));
    
      //  dd($academico); 
      $academico->save();

      \Auth::user()->update([
    'datos_academico' => 1,
   ]);

         

        alert()->success(' ', 'Su Datos Fueron Guardado Correctamente')->autoclose(2500);
        return redirect()->route('Academico.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $DatosAcademicos=DatosAcademico::find($id);
       
        $municipio =Municipio::orderBy('Municipio','ASC')->pluck('Municipio','id'); 
        $RamasMedia=EducacionMedia::
        orderBy('ramas','ASC')->pluck('ramas','id'); 
        $estado =Estado::orderBy('Estado','ASC')->pluck('Estado','id'); 
        return view('Aspidatos.ediAcademicoAspi', compact('DatosAcademicos','DatosAcademicos','municipio','RamasMedia','estado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            
            'NumeroRNI' => 'required|numeric',
            'namePlantel'  =>'required|alpha',
            'Estados_id'  =>'required',
            'TurnoEstudio' =>'required',
            'sistemaEstudio' =>'required',
            'DependenciaPlantel' =>'required',
             'Municipio_id' =>'required',
            'Promedio' =>'required',
            'RamasEducacion_id' =>'required'
           
        ];


         $messages = [
            'NumeroRNI.required' => 'Debes Completar este Campo',
            'namePlantel.required' => 'Debes Completar este Campo.',
            'Estados_id.required' => 'Debes Completar este Campo.',
            'TurnoEstudio.required' => 'No se Puede dejar este Campo Vacio.',
            'sistemaEstudio.required' => 'Este Campo es Obligatorio.',
            'DependenciaPlantel.required' => 'Este Campo es Requerido .',
            'Promedio.required' => 'El Promedio es Obligatoria.',
            'Municipio_id.required' => 'No se permite dejar este campo vacio.',
        	'RamasEducacion_id.required' => 'El Campo Educacion Media es Requerido.',
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->action('DatosAcademicosController@edit',$id)
                ->withErrors($validator)
                ->withInput();
        }

        $id_user=\Auth::user()->id;
            
         
           $Dato =DB::select('SELECT AspPregrado.id FROM AspPregrado , UsuariosAspi where   UsuariosAspi.id=user_id and    UsuariosAspi.id ='.$id_user);

       
     //  dd($fecha);
       $activo="1";
       $per= DB::table('Periodo')
       ->where('Periodo.Vigente', '=',$activo)->first();
      $idperiodo=$per->id;  

      $promediovar='20.00';
      $promediomenor='10';
      $inpu=$request->input('Promedio');
      //dd($promediovar,$inpu);
      if ($inpu  > $promediovar ) {
        session()->flash('error','Tu promedio no puede ser mayor de 20');
        return redirect()->route('Academico.edit')->withInput();
      }elseif($inpu  < $promediomenor ){
        session()->flash('error','Tu promedio no puede ser menor que 10');
        return redirect()->route('Academico.edit')->withInput();
      }
    
	 	$DatosAcademicos=  DatosAcademico::findOrFail($id);
	 	$DatosAcademicos->AspPregrado_id = $Dato[0]->id;
    $DatosAcademicos->user_id= \Auth::user()->id;
    $DatosAcademicos->Periodo_id=$idperiodo;
    $DatosAcademicos->sistemaEstudio = $request->get ('sistemaEstudio');
	  $DatosAcademicos->DependenciaPlantel = $request->get ('DependenciaPlantel');
  	$DatosAcademicos->namePlantel = $request->get ('namePlantel');
  	$DatosAcademicos->NumeroRNI = $request->get ('NumeroRNI');
  	$DatosAcademicos->TurnoEstudio = $request->get ('TurnoEstudio'); 
	  $DatosAcademicos->RamasEducacion_id = $request-> get ('RamasEducacion_id');
	  $DatosAcademicos->Estados_id = $request->get ('Estados_id');
	  $DatosAcademicos->Promedio = $request->get ('Promedio');
	  $DatosAcademicos->Municipio_id = $request->get ('Municipio_id');
       // $academico->Promedio== (float) ($request->input('Promedio'));
    
      // dd($academico); 
        $DatosAcademicos->update();

          \Auth::user()->update([
        'datos_academico' => 1,
       ]);

        alert()->success(' ', 'Su Datos Fueron Actualizados correctamente')->autoclose(2500);
        return redirect()->route('Academico.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
