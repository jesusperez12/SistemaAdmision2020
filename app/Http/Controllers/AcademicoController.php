<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Academico;
use App\DatosAcademico;
use App\Pais;
use App\titulos;
use App\EducacionMedia;
use App\Estado; //MODELO LLAMADO DE LA TABLA
use App\Municipio; //MODELO LLAMADO DE LA TABLA
//use SistemaAdmision\Pais;
use Illuminate\Support\Facedes\Redirect;
use App\Http\Requests\AcademicoFormRequest;
use DB;
use Carbon\Carbon;
use Alert;
class AcademicoController extends Controller
{
     

  public function __construct(){

        $this->middleware('auth:UsuariosAspi');
    }
	public function index(){

      //  $Datosbasicos = $this->obtenerDatosbasicos();


		 $id_user=\Auth::user()->id;
		  $academico=DB::table('DatosAcademicos')->where('DatosAcademicos.user_id', '=', $id_user)
        ->leftJoin('Pais', 'DatosAcademicos.PaisEstudio_id', '=', 'Pais.id')
        ->leftJoin('TiposTitulos', 'DatosAcademicos.TiposTitulos_id', '=', 'TiposTitulos.Id')
       
        ->select('Pais.Pais','TiposTitulos.TiposTitulo',
        'DatosAcademicos.Universidad',
        'DatosAcademicos.FechaInicio',
        'DatosAcademicos.tipoOrganizacion',
        'DatosAcademicos.fechaCulminacion',
        'DatosAcademicos.FechaGrado','DatosAcademicos.Escala',
        'DatosAcademicos.PuestoPromocion','DatosAcademicos.id',
        'DatosAcademicos.Promedio')->get($id_user);

              $fech=DB::table('DatosAcademicos')->where('DatosAcademicos.user_id', '=', $id_user)
        ->leftJoin('Pais', 'DatosAcademicos.PaisEstudio_id', '=', 'Pais.id')
        ->leftJoin('TiposTitulos', 'DatosAcademicos.TiposTitulos_id', '=', 'TiposTitulos.Id')
       
        ->select('Pais.Pais','TiposTitulos.TiposTitulo',
        'DatosAcademicos.Universidad',
        'DatosAcademicos.FechaInicio',
        'DatosAcademicos.tipoOrganizacion',
        'DatosAcademicos.fechaCulminacion',
        'DatosAcademicos.FechaGrado','DatosAcademicos.Escala',
        'DatosAcademicos.PuestoPromocion','DatosAcademicos.id',
        'DatosAcademicos.Promedio')->first($id_user);

      /*  $fechaCulminacion=$fech->fechaCulminacion;
        $fechainicio=$fech->FechaInicio;
        $fechafinal=$fech->FechaGrado;

         $fechad=Carbon::parse($fechaCulminacion)->format('d/m/Y');
          $iniciofecha=Carbon::parse($fechainicio)->format('d/m/Y');
           $gradofinal=Carbon::parse($fechafinal)->format('d/m/Y');*/
		/*$Datos =DB::select('select *,DatosAcademicos.id FROM DatosAcademicos
        INNER JOIN Pais ON DatosAcademicos.PaisEstudio_id = Pais.id 

        INNER JOIN TiposTitulos ON DatosAcademicos.TiposTitulos_id = TiposTitulos.Id
        where user_id ='.$id_user);*/
        
        $pais=Pais::orderBy('Pais','ASC')->pluck('Pais','id'); 
        //$organizacion=Academico::get();
        $Datos=Academico::get();
        $Promocion=Academico::get();
        $titulo=titulos::where('TiposTitulos.id', '=', '1')
        ->orderBy('TiposTitulo','ASC')->pluck('TiposTitulo','id'); 

		
    	return view('Aspidatos.indexAcademicoDocent', compact('Aspirante','fechad','iniciofecha','gradofinal','academico','pais','escala','Promocion','titulo','Datos'));

	}

   


	public function create(){


		$pais=Pais::orderBy('Pais','ASC')->pluck('Pais','id'); 
		//$organizacion=Academico::get();
		$Datos=Academico::get();
		$Promocion=Academico::get();
        $titulo=titulos::where('TiposTitulos.id', '=', '1')
        ->orderBy('TiposTitulo','ASC')->pluck('TiposTitulo','id'); 
		
		return view('Aspidatos.createacademico', compact('pais','escala','Promocion','titulo','Datos'));

	}




	 public function store(Request $request){

	 	  $rules = [
            'FechaInicio' => 'required|date_format:d/m/Y',
            //'fechaCulminacion' => 'required|date_format:d/m/Y',
            'fechaCulminacion' => 'required|date_format:d/m/Y|after:FechaInicio',
            'FechaGrado' => 'required|date_format:d/m/Y|after:fechaCulminacion',
            'TiposTitulos_id'  =>'required',
            'TituloCarrera'  =>'required|alpha',
            'Universidad' =>'required|alpha',
            'PaisEstudio_id' =>'required',
            'tipoOrganizacion' =>'required',
             'Escala' =>'required',
            'Promedio' =>'required',
            'PuestoPromocion' =>'required|numeric'
           
        ];


         $messages = [
            'FechaInicio.required' => 'La Fecha de inicio es obligatoria o formato incorrecta.',
            'fechaCulminacion.required' => 'La Fecha de culminación es obligatoria o formtato incorrecta.',
            'FechaGrado.required' => 'La Fecha de grado es obligatoria o esta Incorrecta.',
            'TiposTitulos_id.required' => 'Debes Completar este Campo.',
            'TituloCarrera.required' => 'Debes Completar este Campo.',
            'Universidad.required' => 'No se Puede dejar este Campo Vacio.',
            'tipoOrganizacion.required' => 'Este Campo es Obligatorio.',
            'Escala.required' => 'Este Campo es Requerido .',
            'Promedio.required' => 'El Promedio es Obligatoria.',
            'PuestoPromocion.required' => 'No se permite dejar este campo vacio.',
        	'PaisEstudio_id.required' => 'El Campo Pais es Requerido.',
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->action('AcademicoController@index')
                ->withErrors($validator)
                ->withInput();
        }

        $id_user=\Auth::user()->id;
            
         
           $Dato =DB::select('SELECT AspPregrado.id FROM AspPregrado , UsuariosAspi where   UsuariosAspi.id=user_id and    UsuariosAspi.id ='.$id_user);

       
       $mytime = Carbon::now();
    $fecha=$mytime->format('d/m/Y'); 
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
        return redirect()->route('DatosAcademicos.index')->withInput();
      }elseif($inpu  < $promediomenor ){
        session()->flash('error','Tu promedio no puede ser menor que 10');
        return redirect()->route('DatosAcademicos.index')->withInput();
      }
      
     
   
	 	$academico= new Academico(request()->all());
	 	$academico->AspPregrado_id = $Dato[0]->id;
         $academico->user_id= \Auth::user()->id;
         $academico->Periodo_id=$idperiodo;
        $academico->FechaInicio= Carbon::createFromFormat('d/m/Y', $request->input('FechaInicio'));
        $fechainicio=$request->input('FechaInicio');
       // dd($fechainicio);
        $academico->fechaCulminacion= Carbon::createFromFormat('d/m/Y', $request->input('fechaCulminacion'));
        $fechaiculminacion=$request->input('fechaCulminacion');
        $academico->FechaGrado= Carbon::createFromFormat('d/m/Y', $request->input('FechaGrado'));
        $fechagrado=$request->input('FechaGrado');
      /*  if ($fechainicio > $fecha  ) {
           // dd($fecha,$fechainicio);
            alert()->error(' ', 'La fecha que ingresas no puede ser mayor que la fecha actual')->autoclose(3000);
            return redirect()->route('DatosAcademicos.create')->withInput();
            }
            elseif ($fechaiculminacion > $fecha) {
                alert()->error(' ', 'La fecha que ingresas no puede ser mayor que la fecha actual')->autoclose(3000);
            return redirect()->route('DatosAcademicos.create')->withInput();
            }
            elseif ($fechagrado > $fecha) {
                alert()->error(' ', 'La fecha que ingresas no puede ser mayor que la fecha actual')->autoclose(3000);
            return redirect()->route('DatosAcademicos.create')->withInput();
            }*/
        
        $academico->save();

          \Auth::user()->update([
        'datos_academico' => 1,
       ]);

        alert()->success(' ', 'Su Datos Fueron Guardado Correctamente')->autoclose(2500);
        return redirect()->route('DatosAcademicos.index');
        
         
	 }

	 public function edit($id){
    //$organizacion=Academico::get();
	//$escala=Academico::get();
	//$Promocion=Academico::get();
      $id_user=\Auth::user()->id;
          $academico=DB::table('DatosAcademicos')->where('DatosAcademicos.user_id', '=', $id_user)
        ->leftJoin('Pais', 'DatosAcademicos.PaisEstudio_id', '=', 'Pais.id')
        ->leftJoin('TiposTitulos', 'DatosAcademicos.TiposTitulos_id', '=', 'TiposTitulos.Id')
       
        ->select('Pais.Pais','TiposTitulos.TiposTitulo','DatosAcademicos.Universidad','DatosAcademicos.FechaInicio','DatosAcademicos.tipoOrganizacion','DatosAcademicos.fechaCulminacion','DatosAcademicos.FechaGrado','DatosAcademicos.Escala','DatosAcademicos.PuestoPromocion','DatosAcademicos.id','DatosAcademicos.Promedio')->first($id_user);   

        $fechainicio=$academico->FechaInicio;
        $fechaculmi=$academico->fechaCulminacion;
        $fechagrad=$academico->FechaGrado;

         $fechaini=Carbon::parse($fechainicio)->format('d/m/Y');
          $fechacul=Carbon::parse($fechaculmi)->format('d/m/Y');
           $fechagra=Carbon::parse($fechagrad)->format('d/m/Y');

        //dd($fechaini);
    $pais=Pais::orderBy('Pais','ASC')->pluck('Pais','id');
	$titulo=titulos::orderBy('TiposTitulo','ASC')->pluck('TiposTitulo','id');
	$Editar=Academico::find($id);
	$Datos = Academico::get();
	return view('Aspidatos.edit', compact('Editar','titulo','pais','escala','Promocion','Datos','fechaini','fechacul','fechagra'));

	}



   public function update(Request $request, $id)
{
	
  $rules = [
            'FechaInicio' => 'required|date_format:d/m/Y',
            'fechaCulminacion' => 'required|date_format:d/m/Y|after:FechaInicio',
            'FechaGrado' => 'required|date_format:d/m/Y|after:fechaCulminacion',
            'TiposTitulos_id'  =>'required',
            'TituloCarrera'  =>'required|alpha',
            'Universidad' =>'required|alpha',
            'PaisEstudio_id' =>'required',
            'tipoOrganizacion' =>'required',
             'Escala' =>'required',
            'Promedio' =>'required',
            'PuestoPromocion' =>'required|numeric',
           
        ];

   $messages = [
            'FechaInicio.required' => 'Formato De La Fecha es Obligatoria/Incorrecta.',
            'fechaCulminacion.required' => ' Formato De La Fecha es Obligatoria/Incorrecta.',
            'FechaGrado.required' => ' Formato De La Fecha es Incorrecta/Obligatoria.',
            'TiposTitulos_id.required' => 'Debes Completar este Campo.',
            'TituloCarrera.required' => 'Debes Completar este Campo.',
            'Universidad.required' => 'No se Puede dejar este Campo Vacio.',
            'tipoOrganizacion.required' => 'Este Campo es Obligatorio.',
            'Escala.required' => 'Este Campo es Requerido .',
            'Promedio.required' => 'El Promedio es Obligatoria.',
            'PuestoPromocion.required' => 'No se permite dejar este campo vacio.',
            'PaisEstudio_id.required' => 'El Campo Pais es Requerido.',
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->action('AcademicoController@edit',$id)
                ->withErrors($validator)
                ->withInput();
        }

        $promediovar='20.00';
     $promediomenor='10';
     $inpu=$request->input('Promedio');
     //dd($promediovar,$inpu);
     if ($inpu  > $promediovar ) {
       session()->flash('error','Tu promedio no puede ser mayor de 20');
       return redirect()->action('AcademicoController@edit',$id)->withInput();
     }elseif($inpu  < $promediomenor ){
       session()->flash('error','Tu promedio no puede ser menor que 10');
       return redirect()->action('AcademicoController@edit',$id)->withInput();
     }
     

	$Actualizar = Academico::find($id);

	$Actualizar->TiposTitulos_id = $request->get ('TiposTitulos_id');
	$Actualizar->Universidad = $request->get ('Universidad');
	$Actualizar->FechaInicio =  Carbon::createFromFormat( 'd/m/Y', $request->input('FechaInicio'));
	$Actualizar->fechaCulminacion = Carbon::createFromFormat( 'd/m/Y', $request->input('fechaCulminacion'));
	$Actualizar->tipoOrganizacion = $request->get ('tipoOrganizacion'); 
	$Actualizar->Escala = $request-> get ('Escala');
	$Actualizar->PuestoPromocion = $request->get ('PuestoPromocion');
	$Actualizar->Promedio = $request->get ('Promedio');
	$Actualizar->PaisEstudio_id = $request->get ('PaisEstudio_id');
	$Actualizar->save();



	alert()->success(' ', 'Sus datos fueron actualizados correctamente')->autoclose(2500);
	return redirect()->route('DatosAcademicos.index');
				

}

}