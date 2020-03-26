<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facedes\Redirect;
use Illuminate\Support\Facades\Auth;
use DB;
use App\preguntasDiagnosticas;
use App\grupos;
use App\repuestaPrueba;
use App\Datosaspirante;
use App\Municipios;
use App\repuestadiagnostico;
use Carbon\Carbon;
use Alert;
use PDF;


class diagnosticoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){

        $this->middleware('auth:UsuariosAspi');
    }
  

    public function index(Request $request)
    { 
      $id_user=\Auth::user()->id;
     
      $idAspirante =DB::select('SELECT AspPregrado.id FROM AspPregrado , UsuariosAspi where   UsuariosAspi.id=user_id and    UsuariosAspi.id ='.$id_user);
     // dd($idAspirante);
      $dato=repuestaPrueba::
      where('resultadosPrueba.AspPregrado_id', '=', $idAspirante[0]->id)->get();
//  dd($request);
     /*  $prue=DB::table('gruposdiagnostico')
       ->select('gruposdiagnostico.id')->first();
       $idgrud=$prue->id;*/
      // dd($prue);
      $grup= DB::table('gruposdiagnostico')
      ->pluck('id');
       
      $activo = "1";
     // $var = preguntasDiagnosticas::orderBy('gruposdiagnostico_id')->get();
      //$var = preguntasDiagnosticas::all()->groupBy('gruposdiagnostico_id');
      $grupos = grupos::with('pregunta') ->inRandomOrder()->get();
    //dd($grupos);
 
    $idstatus="Admitido";
    $admitidos=Datosaspirante::
  
    //where('resultadosPrueba.condicion', '=', $idcondicion)
    where('resultadosPrueba.condicion', '=', $idstatus)
   ->where('AspPregrado.id', '=', $idAspirante[0]->id)
   // ->where('DatosBasicos.Institutos_id', '=', $NombInstituto)
    ->leftJoin('resultadosPrueba', 'resultadosPrueba.AspPregrado_id', '=', 'AspPregrado.id')
     ->leftJoin('DatosBasicos', 'DatosBasicos.AspPregrado_id', '=', 'AspPregrado.id') 
     ->leftJoin('Deposito', 'Deposito.AspPregrado_id', '=', 'AspPregrado.id')
     ->leftJoin('Especialidad', 'DatosBasicos.Especialidad_a_cursar1_id', '=', 'Especialidad.id')
     ->leftJoin('discapacidades', 'AspPregrado.discapacidad_id', '=', 'discapacidades.id')
     //->leftJoin('Especialidad as b', 'DatosBasicos.Especialidad_a_cursar3_id', '=', 'b.id')
     ->leftJoin('ModoIngreso', 'DatosBasicos.ModoIngreso_Id', '=', 'ModoIngreso.Id')
     ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
     ->leftJoin('datosAcademico', 'datosAcademico.AspPregrado_id', '=', 'datosAcademico.id')
     ->leftJoin('DatosAcademicos', 'DatosAcademicos.AspPregrado_id', '=', 'DatosAcademicos.id')
     ->select('AspPregrado.id','AspPregrado.Cedula','AspPregrado.PrimerNombre','AspPregrado.SegundoNombre',
     'AspPregrado.PrimerApellido','AspPregrado.SegundoApellido','AspPregrado.Nacionalidad','AspPregrado.FechaNacimiento',
     'resultadosPrueba.condicion','Especialidad.NombEspecialidad','Deposito.NumDeposito','AspPregrado.Genero',
     'AspPregrado.PaisOrigen_id','AspPregrado.Etnias_id','AspPregrado.Estados_id','AspPregrado.Municipios_id',
     'AspPregrado.discapacidad_id','AspPregrado.PaisNacimiento_id',
     'DatosBasicos.Institutos_id','Institutos.NombInstituto','AspPregrado.Direccion','AspPregrado.TelefonoMovil','AspPregrado.TelefonoLocal',
     'DatosBasicos.ModoIngreso_Id','ModoIngreso.ModoIngreso','resultadosPrueba.id','resultadosPrueba.estatus',
     'AspPregrado.Correo','AspPregrado.EstadoCivil','discapacidades.discapacidad','datosAcademico.DependenciaPlantel','datosAcademico.namePlantel',
     'datosAcademico.NumeroRNI','DatosAcademicos.Universidad','DatosAcademicos.FechaGrado','DatosAcademicos.tipoOrganizacion',
     'ModoIngreso.codigo')

  
             ->get($id_user);

       // dd($admitidos);
    

        return view('Aspidatos.indexdiagnostico',compact('var','admitidos','dato','grup','grupos'));

    }

   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     

        $data =$request['respuest'];
       /*$data=array(
        $request->input('pregunta')=>$request->input('respuest{{$preguntas->id}}')
       );*/
     // dd($data);
        //dd($data);
        $id_user=\Auth::user()->id;
            
         
         $Dato =DB::select('SELECT AspPregrado.id FROM AspPregrado , UsuariosAspi where   UsuariosAspi.id=user_id and    UsuariosAspi.id ='.$id_user);
         
         $tipoingreMod =DB::table('DatosBasicos')->where('DatosBasicos.user_id','=',$id_user)

                ->leftJoin('Institutos', 'Institutos.id', '=', 'DatosBasicos.Institutos_id')
                ->select('DatosBasicos.Institutos_id')
                ->first();
        $intituto=$tipoingreMod->Institutos_id;
        //dd($intituto);
         $activo = "1";
         $per= DB::table('Periodo')
         ->where('Periodo.Vigente', '=',$activo)->first();
        $idperiodo=$per->id;
         //dd($idperiodo);
  
          $user = Auth::user();
          foreach ($data as $key => $value) {
            // dd($value);
              $datosSocio  = new repuestadiagnostico;
              $datosSocio->Aspirante_id = $Dato[0]->id;
              $datosSocio->preguntasDiagnostica_id = $key;
              $datosSocio->RespuestasVocacional   = $value;
              $datosSocio->Instituto_id =$intituto;
              $datosSocio->user_id = $user->id;
              $datosSocio->Periodo_id=$idperiodo;
             
        //  dd($datosSocio);
              $datosSocio->save();
            
              
             
          }

          $id_user=\Auth::user()->id;
      
          $Dato =DB::table('AspPregrado')
          ->where('AspPregrado.user_id', '=', $id_user)->first();
         
          //dd($Dato);
        
          $Institutoid =DB::table('DatosBasicos')->where('DatosBasicos.user_id','=',$id_user)
          ->leftJoin('Institutos', 'Institutos.id', '=', 'DatosBasicos.Institutos_id')
          ->select('DatosBasicos.Institutos_id')
          ->first();     
          $activo = "1";
  
          $per= DB::table('Periodo')
          ->where('Periodo.Vigente', '=',$activo)->first();
  
         $idperiodo=$per->id;
          $Aspiranteid=$Dato->id;
          $institu=$Institutoid->Institutos_id;
      //  dd($Aspiranteid,$idperiodo,$institu);
  
      $arealiderComunitarioA =DB::table('EvaluacionCompetenciaResultado')
      ->where('EvaluacionCompetenciaResultado.RespuestasVocacional','=','A')
      ->whereIn('EvaluacionCompetenciaResultado.preguntasDiagnostica_id', [1,8,14,20,27,28,33,34,41,48,49,59,61,68,72,78,81,83])
      ->Where('EvaluacionCompetenciaResultado.Aspirante_id', '=',$Aspiranteid)
      ->Where('EvaluacionCompetenciaResultado.Instituto_id', '=',$institu)
      ->Where('EvaluacionCompetenciaResultado.Periodo_id', '=',$idperiodo)
      ->count();    
  
    $arealiderComunitarioB =DB::table('EvaluacionCompetenciaResultado')
      ->where('EvaluacionCompetenciaResultado.RespuestasVocacional','=','B')
      ->whereIn('EvaluacionCompetenciaResultado.preguntasDiagnostica_id', [1,8,14,20,27,28,33,34,41,48,49,59,61,68,72,78,81,83])
      ->Where('EvaluacionCompetenciaResultado.Aspirante_id', '=',$Aspiranteid)
      ->Where('EvaluacionCompetenciaResultado.Instituto_id', '=',$institu)
      ->Where('EvaluacionCompetenciaResultado.Periodo_id', '=',$idperiodo)
      ->count(); 
      
      $AreaOrientadorA =DB::table('EvaluacionCompetenciaResultado')
      ->where('EvaluacionCompetenciaResultado.RespuestasVocacional','=','A')
      ->whereIn('EvaluacionCompetenciaResultado.preguntasDiagnostica_id', [2,7,15,16,21,22,32,39,40,43,50,58,63,65,67,71,73,77,79,84])
      ->Where('EvaluacionCompetenciaResultado.Aspirante_id', '=',$Aspiranteid)
      ->Where('EvaluacionCompetenciaResultado.Instituto_id', '=',$institu)
      ->Where('EvaluacionCompetenciaResultado.Periodo_id', '=',$idperiodo)
      ->count();    
  
     $AreaOrientadorB =DB::table('EvaluacionCompetenciaResultado')
      ->where('EvaluacionCompetenciaResultado.RespuestasVocacional','=','B')
      ->whereIn('EvaluacionCompetenciaResultado.preguntasDiagnostica_id', [2,7,15,16,21,22,32,39,40,43,50,58,63,65,67,71,73,77,79,84])
      ->Where('EvaluacionCompetenciaResultado.Aspirante_id', '=',$Aspiranteid)
      ->Where('EvaluacionCompetenciaResultado.Instituto_id', '=',$institu)
      ->Where('EvaluacionCompetenciaResultado.Periodo_id', '=',$idperiodo)
      ->count(); 
  
      $AreaPlanificadorA =DB::table('EvaluacionCompetenciaResultado')
      ->where('EvaluacionCompetenciaResultado.RespuestasVocacional','=','A')
      ->whereIn('EvaluacionCompetenciaResultado.preguntasDiagnostica_id', [3,4,9,10,13,23,29,35,37,44,53,55,62,74,76])
      ->Where('EvaluacionCompetenciaResultado.Aspirante_id', '=',$Aspiranteid)
      ->Where('EvaluacionCompetenciaResultado.Instituto_id', '=',$institu)
      ->Where('EvaluacionCompetenciaResultado.Periodo_id', '=',$idperiodo)
      ->count();
   
     $AreaPlanificadorB =DB::table('EvaluacionCompetenciaResultado')
      ->where('EvaluacionCompetenciaResultado.RespuestasVocacional','=','B')
      ->whereIn('EvaluacionCompetenciaResultado.preguntasDiagnostica_id', [3,4,9,10,13,23,29,35,37,44,53,55,62,74,76])
      ->Where('EvaluacionCompetenciaResultado.Aspirante_id', '=',$Aspiranteid)
      ->Where('EvaluacionCompetenciaResultado.Instituto_id', '=',$institu)
      ->Where('EvaluacionCompetenciaResultado.Periodo_id', '=',$idperiodo)
      ->count();
  
      $AreaInvestigadorA =DB::table('EvaluacionCompetenciaResultado')
      ->where('EvaluacionCompetenciaResultado.RespuestasVocacional','=','A')
      ->whereIn('EvaluacionCompetenciaResultado.preguntasDiagnostica_id', [5,11,17,24,25,30,31,42,45,46,51,52,56,60,64,69,70,75,80])
      ->Where('EvaluacionCompetenciaResultado.Aspirante_id', '=',$Aspiranteid)
      ->Where('EvaluacionCompetenciaResultado.Instituto_id', '=',$institu)
      ->Where('EvaluacionCompetenciaResultado.Periodo_id', '=',$idperiodo)
      ->count();
  
      $AreaInvestigadorB =DB::table('EvaluacionCompetenciaResultado')
      ->where('EvaluacionCompetenciaResultado.RespuestasVocacional','=','B')
      ->whereIn('EvaluacionCompetenciaResultado.preguntasDiagnostica_id', [5,11,17,24,25,30,31,42,45,46,51,52,56,60,64,69,70,75,80])
      ->Where('EvaluacionCompetenciaResultado.Aspirante_id', '=',$Aspiranteid)
      ->Where('EvaluacionCompetenciaResultado.Instituto_id', '=',$institu)
      ->Where('EvaluacionCompetenciaResultado.Periodo_id', '=',$idperiodo)
      ->count();
 // dd($AreaInvestigadorB);
      $AreaDistraccionA =DB::table('EvaluacionCompetenciaResultado')
      ->where('EvaluacionCompetenciaResultado.RespuestasVocacional','=','A')
      ->whereIn('EvaluacionCompetenciaResultado.preguntasDiagnostica_id', [6,12,18,19,26,36,38,47,54,57,66])
      ->Where('EvaluacionCompetenciaResultado.Aspirante_id', '=',$Aspiranteid)
      ->Where('EvaluacionCompetenciaResultado.Instituto_id', '=',$institu)
      ->Where('EvaluacionCompetenciaResultado.Periodo_id', '=',$idperiodo)
      ->count();
  
      $AreaDistraccionB =DB::table('EvaluacionCompetenciaResultado')
      ->where('EvaluacionCompetenciaResultado.RespuestasVocacional','=','B')
      ->whereIn('EvaluacionCompetenciaResultado.preguntasDiagnostica_id', [6,12,18,19,26,36,38,47,54,57,66])
      ->Where('EvaluacionCompetenciaResultado.Aspirante_id', '=',$Aspiranteid)
      ->Where('EvaluacionCompetenciaResultado.Instituto_id', '=',$institu)
      ->Where('EvaluacionCompetenciaResultado.Periodo_id', '=',$idperiodo)
      ->count();
     /* dd($arealiderComunitarioA,$arealiderComunitarioB,$AreaOrientadorA, 
      $AreaOrientadorB,$AreaPlanificadorA,$AreaPlanificadorB,$AreaInvestigadorA,$AreaInvestigadorB,
      $AreaDistraccionA,$AreaDistraccionB);*/
        $totalvocacional=($arealiderComunitarioA  + $AreaOrientadorA + 
         $AreaPlanificadorA +  $AreaInvestigadorA );
       
  
       /*  
         dd($arealiderComunitarioA,$arealiderComunitarioB,$AreaOrientadorA,
         $AreaOrientadorB,$AreaPlanificadorA,$AreaPlanificadorB,$AreaInvestigadorA,$AreaInvestigadorB,
         $AreaDistraccionA,$AreaDistraccionB);*/

          
    $resultado=DB::table('DatosAcademicos')->where('DatosAcademicos.user_id', '=', $id_user)
    ->leftJoin('Pais', 'DatosAcademicos.PaisEstudio_id', '=', 'Pais.id')
    ->leftJoin('TiposTitulos', 'DatosAcademicos.TiposTitulos_id', '=', 'TiposTitulos.Id')
   
    ->select('Pais.Pais','TiposTitulos.TiposTitulo',
    'DatosAcademicos.Universidad',
    'DatosAcademicos.FechaInicio',
    'DatosAcademicos.tipoOrganizacion',
    'DatosAcademicos.fechaCulminacion',
    'DatosAcademicos.FechaGrado','DatosAcademicos.Escala',
    'DatosAcademicos.PuestoPromocion','DatosAcademicos.id',
    'DatosAcademicos.Promedio')
    ->exists();

    if ($resultado) {
                
      $Dato =DB::select('SELECT AspPregrado.id FROM AspPregrado , UsuariosAspi where   UsuariosAspi.id=user_id and    UsuariosAspi.id ='.$id_user);
         
      $per= DB::table('Periodo')
     ->where('Periodo.Vigente', '=',$activo)->first();
      $idperiodo=$per->id;  

      $DatoPromedio=DB::table('DatosAcademicos')->where('DatosAcademicos.user_id', '=', $id_user)
      ->select('DatosAcademicos.Promedio')->first($id_user);
      $promedio=$DatoPromedio->Promedio;

      $iA = 20 * ( ($promedio * 50 /20)  +  ($totalvocacional* 50 / 73 )  ) / 100;
      $IndiceA = round($iA, 3);
      
     

     // dd($IndiceA);
       $repuestaprueba  = new repuestaPrueba;
       $repuestaprueba->AreaLiderComunitarioA = $arealiderComunitarioA;
       $repuestaprueba->AreaLiderComunitarioB = $arealiderComunitarioB;
       $repuestaprueba->AreaOrientadorA   = $AreaOrientadorA;
       $repuestaprueba->AreaOrientadorB =$AreaOrientadorB;
       $repuestaprueba->AreaPlanificadorA = $AreaPlanificadorA;
       $repuestaprueba->AreaPlanificadorB=$AreaPlanificadorB;
      
       $repuestaprueba->AreaInvestigadorA = $AreaInvestigadorA;
       
       $repuestaprueba->AreaInvestigadorB = $AreaInvestigadorB;
      /// dd($repuestaprueba);
       $repuestaprueba->AreaDistraccionA   = $AreaDistraccionA;
       $repuestaprueba->AreaDistraccionB =$AreaDistraccionB;
       $repuestaprueba->TotVocacional = $totalvocacional;
       $repuestaprueba->Periodo_id=$idperiodo;
       $repuestaprueba->IndiceAcademico=$IndiceA;
       $repuestaprueba->AspPregrado_id = $Dato[0]->id;
       $repuestaprueba->save();

       \Auth::user()->update([
         'datos_vocacional' => 1,
        ]);


       alert()->success(' ', 'Su datos fueron guardado correctamente')->autoclose(2500);
       return redirect()->route('Diagnostico.index');
    
    }else {
      $Dato =DB::select('SELECT AspPregrado.id FROM AspPregrado , UsuariosAspi where   UsuariosAspi.id=user_id and    UsuariosAspi.id ='.$id_user);
         
      $per= DB::table('Periodo')
     ->where('Periodo.Vigente', '=',$activo)->first();
      $idperiodo=$per->id;  
      
      $DatPromedio=DB::table('datosAcademico')->where('datosAcademico.user_id', '=', $id_user)
      ->select('datosAcademico.Promedio')->first($id_user);
      $idpromedio=$DatPromedio->Promedio;
        /*  $DatoPromedio=DB::table('DatosAcademicos')->where('DatosAcademicos.user_id', '=', $id_user)
         ->select('DatosAcademicos.Promedio')->first($id_user);
         $promedio=$DatoPromedio->Promedio;*/
         //dd($promedio);
         
         $iA = 20 * ( ($idpromedio * 50 /20)  +  ($totalvocacional* 50 / 73 )  ) / 100;
         $IndiceA = round($iA, 3);
         
        // dd($IndiceA);
          $repuestaprueba  = new repuestaPrueba;
          $repuestaprueba->AreaLiderComunitarioA = $arealiderComunitarioA;
          $repuestaprueba->AreaLiderComunitarioB = $arealiderComunitarioB;
          $repuestaprueba->AreaOrientadorA   = $AreaOrientadorA;
          $repuestaprueba->AreaOrientadorB =$AreaOrientadorB;
          $repuestaprueba->AreaPlanificadorA = $AreaPlanificadorA;
          $repuestaprueba->AreaPlanificadorB=$AreaPlanificadorB;
         
          $repuestaprueba->AreaInvestigadorA = $AreaInvestigadorA;
          
          $repuestaprueba->AreaInvestigadorB = $AreaInvestigadorB;
         /// dd($repuestaprueba);
          $repuestaprueba->AreaDistraccionA   = $AreaDistraccionA;
          $repuestaprueba->AreaDistraccionB =$AreaDistraccionB;
          $repuestaprueba->TotVocacional = $totalvocacional;
          $repuestaprueba->Periodo_id=$idperiodo;
          $repuestaprueba->IndiceAcademico=$IndiceA;
          $repuestaprueba->AspPregrado_id = $Dato[0]->id;
          $repuestaprueba->save();

          \Auth::user()->update([
            'datos_vocacional' => 1,
           ]);


          alert()->success(' ', 'Su datos fueron guardado correctamente')->autoclose(2500);
          return redirect()->route('Diagnostico.index');
    }


     
    }



    public function pdf()
    {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
        $fecha = Carbon::now();
      $fechas= $fecha->format('d/m/Y h:i:s A');
      $id_user=\Auth::user()->id;
     
      $idAspirante =DB::select('SELECT AspPregrado.id FROM AspPregrado , UsuariosAspi where   UsuariosAspi.id=user_id and    UsuariosAspi.id ='.$id_user);

      $idstatus="Admitido";
      $admitidos=Datosaspirante::
    
      //where('resultadosPrueba.condicion', '=', $idcondicion)
      where('resultadosPrueba.condicion', '=', $idstatus)
     ->where('AspPregrado.id', '=', $idAspirante[0]->id)
     // ->where('DatosBasicos.Institutos_id', '=', $NombInstituto)
      ->leftJoin('resultadosPrueba', 'resultadosPrueba.AspPregrado_id', '=', 'AspPregrado.id')
       ->leftJoin('DatosBasicos', 'DatosBasicos.AspPregrado_id', '=', 'AspPregrado.id') 
       ->leftJoin('Deposito', 'Deposito.AspPregrado_id', '=', 'AspPregrado.id')
       ->leftJoin('Especialidad', 'DatosBasicos.Especialidad_a_cursar1_id', '=', 'Especialidad.id')
       ->leftJoin('discapacidades', 'AspPregrado.discapacidad_id', '=', 'discapacidades.id')
       //->leftJoin('Especialidad as b', 'DatosBasicos.Especialidad_a_cursar3_id', '=', 'b.id')
       ->leftJoin('ModoIngreso', 'DatosBasicos.ModoIngreso_Id', '=', 'ModoIngreso.Id')
       ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
       ->leftJoin('datosAcademico', 'datosAcademico.AspPregrado_id', '=', 'datosAcademico.id')
       ->leftJoin('DatosAcademicos', 'DatosAcademicos.AspPregrado_id', '=', 'DatosAcademicos.id')
       ->select('AspPregrado.id','AspPregrado.Cedula','AspPregrado.PrimerNombre','AspPregrado.SegundoNombre',
       'AspPregrado.PrimerApellido','AspPregrado.SegundoApellido','AspPregrado.Nacionalidad','AspPregrado.FechaNacimiento',
       'resultadosPrueba.condicion','Especialidad.NombEspecialidad','Deposito.NumDeposito','AspPregrado.Genero',
       'AspPregrado.PaisOrigen_id','AspPregrado.Etnias_id','AspPregrado.Estados_id','AspPregrado.Municipios_id',
       'AspPregrado.discapacidad_id','AspPregrado.PaisNacimiento_id',
       'DatosBasicos.Institutos_id','Institutos.NombInstituto','AspPregrado.Direccion','AspPregrado.TelefonoMovil','AspPregrado.TelefonoLocal',
       'DatosBasicos.ModoIngreso_Id','ModoIngreso.ModoIngreso','resultadosPrueba.id','resultadosPrueba.estatus',
       'AspPregrado.Correo','AspPregrado.EstadoCivil','discapacidades.discapacidad','datosAcademico.DependenciaPlantel','datosAcademico.namePlantel',
       'datosAcademico.NumeroRNI','DatosAcademicos.Universidad','DatosAcademicos.FechaGrado','DatosAcademicos.tipoOrganizacion',
       'ModoIngreso.codigo')
  
    
               ->get($id_user);

        $pdf = PDF::loadView('Aspidatos.pdf.planillAdmitido', compact('fechas','admitidos'));

        return $pdf->download('Admitido.pdf');
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
        //
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
        //
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
