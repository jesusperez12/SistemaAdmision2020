<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Datosaspirante;
use App\Academico;
use App\SocioEconomico;
use App\ExpeLaboralmodel;
use App\DetalleSocial;
use App\IndicadorSocial;
use App\User;
use PDF;
use DB;
use Carbon\Carbon;
class PDFController extends Controller
{
      public function __construct(){

        $this->middleware('auth:UsuariosAspi');
    }
    
      public function index()
    {
        $id_user=\Auth::user()->id;

     
        $idAspirante =DB::select('SELECT AspPregrado.id FROM AspPregrado , UsuariosAspi where   UsuariosAspi.id=user_id and    UsuariosAspi.id ='.$id_user);
       // dd($idAspirante);

  //  dd($request);

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
       return view('Aspidatos.pdf.vistaPDF',compact('id_user','admitidos'));
    }


     public function vistaHTMLPDF(Request $request)
    {
         $fecha = Carbon::now();
      $fechas= $fecha->format('d/m/Y h:i:s A');
      view()->share('fechas',$fechas);

 $id_user=\Auth::user()->id;

    $laboral=DB::select('select * FROM ExperienciaLaboral where user_id ='.$id_user);
        view()->share('laboral',$laboral);
    
     $ACADEMICO =DB::select('select *,DatosAcademicos.id FROM DatosAcademicos
        INNER JOIN Pais ON DatosAcademicos.PaisEstudio_id = Pais.id 

        INNER JOIN TiposTitulos ON DatosAcademicos.TiposTitulos_id = TiposTitulos.Id
        where user_id ='.$id_user);
        view()->share('ACADEMICO',$ACADEMICO);

        $ACADEMICOAspi =DB::table('datosAcademico')->where('datosAcademico.user_id', '=', $id_user)
        ->leftJoin('Municipios', 'datosAcademico.Municipio_id', '=', 'Municipios.id')
        ->leftJoin('Estados', 'datosAcademico.Estados_id', '=', 'Estados.id')
        ->leftJoin('RamasEducacionMedia', 'datosAcademico.RamasEducacion_id', '=', 'RamasEducacionMedia.id')
      
        ->select('Municipios.Municipio','Estados.Estado',
        'RamasEducacionMedia.ramas','datosAcademico.sistemaEstudio',
        'datosAcademico.DependenciaPlantel','datosAcademico.Promedio',
        'datosAcademico.namePlantel','datosAcademico.NumeroRNI',
        'datosAcademico.TurnoEstudio')
        ->get($id_user);
        view()->share('ACADEMICOAspi',$ACADEMICOAspi);

$Basicos=DB::table('DatosBasicos')->where('DatosBasicos.user_id', '=', $id_user)
->leftJoin('ModoIngreso', 'DatosBasicos.ModoIngreso_id', '=', 'ModoIngreso.id')
->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
->leftJoin('Especialidad', 'DatosBasicos.Especialidad_a_cursar1_id', '=', 'Especialidad.id')
->leftJoin('Especialidad as a', 'DatosBasicos.Especialidad_a_cursar2_id', '=', 'a.id')
->leftJoin('Especialidad as b', 'DatosBasicos.Especialidad_a_cursar3_id', '=', 'b.id')
->select('ModoIngreso.ModoIngreso','Institutos.NombInstituto','a.NombEspecialidad as curso2','b.NombEspecialidad as curso3', 'Especialidad.NombEspecialidad','DatosBasicos.id')->get($id_user);
 view()->share('Basicos',$Basicos);

        $deposito=DB::table('Deposito')->where('Deposito.user_id', '=', $id_user)
        ->leftJoin('Banco', 'Deposito.Banco_id', '=', 'Banco.id')
        //->leftJoin('Especialidad', 'Deposito.Especialidad_Id', '=', 'Especialidad.Id')
       // ->leftJoin('sede', 'DatosBasicos.sede_id', '=', 'sede.id_sede')
        ->select('Deposito.NumDeposito','Deposito.FechaDeposito','Deposito.id','Banco.NombBanco')->get($id_user);
    view()->share('deposito',$deposito);


    
     $user=IndicadorSocial::whereIn('id', [1])->first();
        $id=$user->id;
       
         $SOCIOE=DB::table('DetalleSocial_has_indicadorSocial')
         ->where('DetalleSocial_has_indicadorSocial.indicadorSocial_id', '=', $id)
         ->where('DetalleSocial_has_indicadorSocial.user_id', '=', $id_user)
         ->leftJoin('indicadorSocial', 'DetalleSocial_has_indicadorSocial.indicadorSocial_id', '=', 'indicadorSocial.id')
         ->leftJoin('DetalleSocial', 'DetalleSocial_has_indicadorSocial.DetalleSocial_id', '=', 'DetalleSocial.id')
         
         ->select('indicadorSocial.Nombreindicador','DetalleSocial.ContenidoSelect')
         ->get($id_user);
         
         
         
        
         view()->share('SOCIOE',$SOCIOE);


         $padre=IndicadorSocial::whereIn('id', [2])->first();
        $idpadre=$padre->id;
       // dd($id);

       $sociopadre=DB::table('DetalleSocial_has_indicadorSocial')
       ->where('DetalleSocial_has_indicadorSocial.indicadorSocial_id', '=', $idpadre)
       ->where('DetalleSocial_has_indicadorSocial.user_id', '=', $id_user)
       ->leftJoin('indicadorSocial', 'DetalleSocial_has_indicadorSocial.indicadorSocial_id', '=', 'indicadorSocial.id')
       ->leftJoin('DetalleSocial', 'DetalleSocial_has_indicadorSocial.DetalleSocial_id', '=', 'DetalleSocial.id')
       
       ->select('indicadorSocial.Nombreindicador','DetalleSocial.ContenidoSelect')
       ->get($id_user);
        /* $sociopadre=DB::select('select *, DetalleSocial_has_indicadorSocial.id FROM DetalleSocial_has_indicadorSocial 
        INNER JOIN indicadorSocial ON DetalleSocial_has_indicadorSocial.indicadorSocial_id = indicadorSocial.id 
        INNER JOIN DetalleSocial ON DetalleSocial_has_indicadorSocial.DetalleSocial_id = DetalleSocial.id
         where indicadorSocial_id ='.$idpadre.' and user_id  ='.$id_user);*/
        
         view()->share('sociopadre',$sociopadre);


         $fuenteingreso=IndicadorSocial::whereIn('id', [3])->first();
        $ingre=$fuenteingreso->id;
       // dd($id);
       $ingresos=DB::table('DetalleSocial_has_indicadorSocial')
       ->where('DetalleSocial_has_indicadorSocial.indicadorSocial_id', '=', $ingre)
       ->where('DetalleSocial_has_indicadorSocial.user_id', '=', $id_user)
       ->leftJoin('indicadorSocial', 'DetalleSocial_has_indicadorSocial.indicadorSocial_id', '=', 'indicadorSocial.id')
       ->leftJoin('DetalleSocial', 'DetalleSocial_has_indicadorSocial.DetalleSocial_id', '=', 'DetalleSocial.id')
       
       ->select('indicadorSocial.Nombreindicador','DetalleSocial.ContenidoSelect')
       ->get($id_user);

         view()->share('ingresos',$ingresos);

         

         $nivelingreso=IndicadorSocial::whereIn('id', [4])->first();
            $nivelingre=$nivelingreso->id;
            // dd($id);
            $Nivel_ingreso=DB::table('DetalleSocial_has_indicadorSocial')
            ->where('DetalleSocial_has_indicadorSocial.indicadorSocial_id', '=', $nivelingre)
            ->where('DetalleSocial_has_indicadorSocial.user_id', '=', $id_user)
            ->leftJoin('indicadorSocial', 'DetalleSocial_has_indicadorSocial.indicadorSocial_id', '=', 'indicadorSocial.id')
            ->leftJoin('DetalleSocial', 'DetalleSocial_has_indicadorSocial.DetalleSocial_id', '=', 'DetalleSocial.id')
            
            ->select('indicadorSocial.Nombreindicador','DetalleSocial.ContenidoSelect')
            ->get($id_user);
         
         view()->share('Nivel_ingreso',$Nivel_ingreso);

           $Condiciones=IndicadorSocial::whereIn('id', [5])->first();
        $alojamiento=$Condiciones->id;
       // dd($id);
       $Condiciones_alojamiento=DB::table('DetalleSocial_has_indicadorSocial')
       ->where('DetalleSocial_has_indicadorSocial.indicadorSocial_id', '=', $alojamiento)
       ->where('DetalleSocial_has_indicadorSocial.user_id', '=', $id_user)
       ->leftJoin('indicadorSocial', 'DetalleSocial_has_indicadorSocial.indicadorSocial_id', '=', 'indicadorSocial.id')
       ->leftJoin('DetalleSocial', 'DetalleSocial_has_indicadorSocial.DetalleSocial_id', '=', 'DetalleSocial.id')
       
       ->select('indicadorSocial.Nombreindicador','DetalleSocial.ContenidoSelect')
       ->get($id_user);
    
         view()->share('Condiciones_alojamiento',$Condiciones_alojamiento);

         $traslado=IndicadorSocial::whereIn('id', [6])->first();
        $tiempotraslado=$traslado->id;
       // dd($id);
       $Tiempo_Traslado=DB::table('DetalleSocial_has_indicadorSocial')
       ->where('DetalleSocial_has_indicadorSocial.indicadorSocial_id', '=', $tiempotraslado)
       ->where('DetalleSocial_has_indicadorSocial.user_id', '=', $id_user)
       ->leftJoin('indicadorSocial', 'DetalleSocial_has_indicadorSocial.indicadorSocial_id', '=', 'indicadorSocial.id')
       ->leftJoin('DetalleSocial', 'DetalleSocial_has_indicadorSocial.DetalleSocial_id', '=', 'DetalleSocial.id')
       
       ->select('indicadorSocial.Nombreindicador','DetalleSocial.ContenidoSelect')
       ->get($id_user);

          view()->share('Tiempo_Traslado',$Tiempo_Traslado);

          $costeoPOs=IndicadorSocial::whereIn('id', [7])->first();
        $costeo=$costeoPOs->id;
       // dd($id);
       $Costeo_Postgrado=DB::table('DetalleSocial_has_indicadorSocial')
       ->where('DetalleSocial_has_indicadorSocial.indicadorSocial_id', '=', $costeo)
       ->where('DetalleSocial_has_indicadorSocial.user_id', '=', $id_user)
       ->leftJoin('indicadorSocial', 'DetalleSocial_has_indicadorSocial.indicadorSocial_id', '=', 'indicadorSocial.id')
       ->leftJoin('DetalleSocial', 'DetalleSocial_has_indicadorSocial.DetalleSocial_id', '=', 'DetalleSocial.id')
       
       ->select('indicadorSocial.Nombreindicador','DetalleSocial.ContenidoSelect')
       ->get($id_user);

     
view()->share('Costeo_Postgrado',$Costeo_Postgrado);

$hijos=IndicadorSocial::whereIn('id', [8])->first();
        $numhijos=$hijos->id;
       // dd($id);
       $Numero_hijos=DB::table('DetalleSocial_has_indicadorSocial')
       ->where('DetalleSocial_has_indicadorSocial.indicadorSocial_id', '=', $numhijos)
       ->where('DetalleSocial_has_indicadorSocial.user_id', '=', $id_user)
       ->leftJoin('indicadorSocial', 'DetalleSocial_has_indicadorSocial.indicadorSocial_id', '=', 'indicadorSocial.id')
       ->leftJoin('DetalleSocial', 'DetalleSocial_has_indicadorSocial.DetalleSocial_id', '=', 'DetalleSocial.id')
       
       ->select('indicadorSocial.Nombreindicador','DetalleSocial.ContenidoSelect')
       ->get($id_user);

     
        
view()->share('Numero_hijos',$Numero_hijos);

$aspirantes=DB::table('AspPregrado')->where('AspPregrado.user_id', '=', $id_user)
->leftJoin('Pais as a', 'AspPregrado.PaisOrigen_id', '=', 'a.id')
->leftJoin('Pais as b', 'AspPregrado.PaisNacimiento_id', '=', 'b.id')
->leftJoin('Etnias', 'AspPregrado.Etnias_id', '=', 'Etnias.id')
->leftJoin('Municipios', 'AspPregrado.Municipios_id', '=', 'Municipios.id')
->leftJoin('UsuariosAspi', 'AspPregrado.user_id', '=', 'UsuariosAspi.id')
->select('Etnias.NombEtnia','AspPregrado.id','AspPregrado.Cedula','AspPregrado.PrimerNombre','AspPregrado.SegundoNombre',
'AspPregrado.PrimerApellido','AspPregrado.SegundoApellido',
'AspPregrado.FechaNacimiento','AspPregrado.Edad','AspPregrado.Peso','AspPregrado.Estatura',
'AspPregrado.Nacionalidad','AspPregrado.NumPasaporte','AspPregrado.EstadoCivil',
'AspPregrado.Genero','AspPregrado.Direccion','AspPregrado.TelefonoMovil',
'AspPregrado.TelefonoLocal','AspPregrado.TelefonOficina','AspPregrado.Correo',
'a.Pais as paisOrigin','b.Pais as paisNacimiento','AspPregrado.user_id')->get($id_user);


    //$aspirantes =DB::select('select *,AspPregrado.id FROM AspPregrado'.$id_user)
    //$aspirantes = Datosaspirante::all();//OBTENGO TODOS MIS PRODUCTO
    view()->share('aspirantes',$aspirantes);//VARIABLE GLOBAL PRODUCTOS
//VARIABLE GLOBAL PRODUCTOS


$SOCI = SocioEconomico::all();
    view()->share('SOCI',$SOCI);

        if($request->has('descargar')){
            $pdf = PDF::loadView('Aspidatos.pdf.listado_reportes');//CARGO LA VISTA
            return $pdf->download('Registro de ADMISIÓN');//SUGERIR NOMBRE A DESCARGAR
        }
        return view('Aspidatos.pdf.listado_reportes',compat(''));//RETORNO A MI VISTA
    }/*Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */












     
   public function veReporte (Request $request) {

     $fecha = Carbon::now();
      $fechas= $fecha->format('d/m/Y h:i:s A');
      view()->share('fechas',$fechas);
   
        $id_user=\Auth::user()->id;

    $laboral=DB::select('select * FROM ExperienciaLaboral where user_id ='.$id_user);
        view()->share('laboral',$laboral);
    
     $ACADEMICO =DB::select('select *,DatosAcademicos.id FROM DatosAcademicos
        INNER JOIN Pais ON DatosAcademicos.PaisEstudio_id = Pais.id 

        INNER JOIN TiposTitulos ON DatosAcademicos.TiposTitulos_id = TiposTitulos.Id
        where user_id ='.$id_user);
        view()->share('ACADEMICO',$ACADEMICO);

        $ACADEMICOAspi =DB::table('datosAcademico')->where('datosAcademico.user_id', '=', $id_user)
        ->leftJoin('Municipios', 'datosAcademico.Municipio_id', '=', 'Municipios.id')
        ->leftJoin('Estados', 'datosAcademico.Estados_id', '=', 'Estados.id')
        ->leftJoin('RamasEducacionMedia', 'datosAcademico.RamasEducacion_id', '=', 'RamasEducacionMedia.id')
      
        ->select('Municipios.Municipio','Estados.Estado',
        'RamasEducacionMedia.ramas','datosAcademico.sistemaEstudio',
        'datosAcademico.DependenciaPlantel','datosAcademico.Promedio',
        'datosAcademico.namePlantel','datosAcademico.NumeroRNI',
        'datosAcademico.TurnoEstudio')
        ->get($id_user);
        view()->share('ACADEMICOAspi',$ACADEMICOAspi);

$Basicos=DB::table('DatosBasicos')->where('DatosBasicos.user_id', '=', $id_user)
        ->leftJoin('ModoIngreso', 'DatosBasicos.ModoIngreso_id', '=', 'ModoIngreso.id')
        ->leftJoin('Especialidad', 'DatosBasicos.Especialidad_a_cursar1_id', '=', 'Especialidad.Id')
        ->leftJoin('Especialidad as a', 'DatosBasicos.Especialidad_a_cursar2_id', '=', 'a.id')
        ->leftJoin('Especialidad as b', 'DatosBasicos.Especialidad_a_cursar3_id', '=', 'b.id')
        ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
      //  ->leftJoin('Programas', 'DatosBasicos.Programas_id', '=', 'Programas.id')
        ->select('ModoIngreso.ModoIngreso','Especialidad.NombEspecialidad','Institutos.NombInstituto','a.NombEspecialidad as curso2','b.NombEspecialidad as curso3','DatosBasicos.id')->get($id_user);
 view()->share('Basicos',$Basicos);

        $deposito=DB::table('Deposito')->where('Deposito.user_id', '=', $id_user)
        ->leftJoin('Banco', 'Deposito.Banco_id', '=', 'Banco.id')
        //->leftJoin('Especialidad', 'Deposito.Especialidad_Id', '=', 'Especialidad.Id')
       // ->leftJoin('sede', 'DatosBasicos.sede_id', '=', 'sede.id_sede')
        ->select('Deposito.NumDeposito','Deposito.FechaDeposito','Deposito.id','Banco.NombBanco')->get($id_user);
    view()->share('deposito',$deposito);


$SOCIOE = SocioEconomico::all();
    view()->share('SOCIOE',$SOCIOE);

     $user=IndicadorSocial::whereIn('id', [1])->first();
        $id=$user->id;
       // dd($id);
       $SOCIOE=DB::table('DetalleSocial_has_indicadorSocial')
       ->where('DetalleSocial_has_indicadorSocial.indicadorSocial_id', '=', $id)
       ->where('DetalleSocial_has_indicadorSocial.user_id', '=', $id_user)
       ->leftJoin('indicadorSocial', 'DetalleSocial_has_indicadorSocial.indicadorSocial_id', '=', 'indicadorSocial.id')
       ->leftJoin('DetalleSocial', 'DetalleSocial_has_indicadorSocial.DetalleSocial_id', '=', 'DetalleSocial.id')
       
       ->select('indicadorSocial.Nombreindicador','DetalleSocial.ContenidoSelect')
       ->get($id_user);
    view()->share('SOCIOE',$SOCIOE);


         $padre=IndicadorSocial::whereIn('id', [2])->first();
        $idpadre=$padre->id;
       // dd($id);
         $sociopadre=DB::select('select *, DetalleSocial_has_indicadorSocial.id FROM DetalleSocial_has_indicadorSocial 
        INNER JOIN indicadorSocial ON DetalleSocial_has_indicadorSocial.indicadorSocial_id = indicadorSocial.id 
        INNER JOIN DetalleSocial ON DetalleSocial_has_indicadorSocial.DetalleSocial_id = DetalleSocial.id
          where DetalleSocial_has_indicadorSocial.indicadorSocial_id ='.$idpadre.' and user_id  ='.$id_user);
         view()->share('sociopadre',$sociopadre);


         $fuenteingreso=IndicadorSocial::whereIn('id', [3])->first();
        $ingre=$fuenteingreso->id;
       // dd($id);


      
         $ingresos=DB::select('select *, DetalleSocial_has_indicadorSocial.id FROM DetalleSocial_has_indicadorSocial 
        INNER JOIN indicadorSocial ON DetalleSocial_has_indicadorSocial.indicadorSocial_id = indicadorSocial.id 
        INNER JOIN DetalleSocial ON DetalleSocial_has_indicadorSocial.DetalleSocial_id = DetalleSocial.id
          where DetalleSocial_has_indicadorSocial.indicadorSocial_id ='.$ingre.' and user_id  ='.$id_user);
         view()->share('ingresos',$ingresos);

         

         $nivelingreso=IndicadorSocial::whereIn('id', [4])->first();
            $nivelingre=$nivelingreso->id;
            // dd($id);

         $Nivel_ingreso=DB::select('select *, DetalleSocial_has_indicadorSocial.id FROM DetalleSocial_has_indicadorSocial 
        INNER JOIN indicadorSocial ON DetalleSocial_has_indicadorSocial.indicadorSocial_id = indicadorSocial.id 
        INNER JOIN DetalleSocial ON DetalleSocial_has_indicadorSocial.DetalleSocial_id = DetalleSocial.id
         where DetalleSocial_has_indicadorSocial.indicadorSocial_id ='.$nivelingre.' and user_id  ='.$id_user);
         view()->share('Nivel_ingreso',$Nivel_ingreso);

           $Condiciones=IndicadorSocial::whereIn('id', [5])->first();
        $alojamiento=$Condiciones->id;
       // dd($id);
         $Condiciones_alojamiento=DB::select('select *, DetalleSocial_has_indicadorSocial.id FROM DetalleSocial_has_indicadorSocial 
        INNER JOIN indicadorSocial ON DetalleSocial_has_indicadorSocial.indicadorSocial_id = indicadorSocial.id 
        INNER JOIN DetalleSocial ON DetalleSocial_has_indicadorSocial.DetalleSocial_id = DetalleSocial.id
         where DetalleSocial_has_indicadorSocial.indicadorSocial_id ='.$alojamiento.' and user_id  ='.$id_user);
         view()->share('Condiciones_alojamiento',$Condiciones_alojamiento);

         $traslado=IndicadorSocial::whereIn('id', [6])->first();
        $tiempotraslado=$traslado->id;
       // dd($id);
         $Tiempo_Traslado=DB::select('select *, DetalleSocial_has_indicadorSocial.id FROM DetalleSocial_has_indicadorSocial 
        INNER JOIN indicadorSocial ON DetalleSocial_has_indicadorSocial.indicadorSocial_id = indicadorSocial.id 
        INNER JOIN DetalleSocial ON DetalleSocial_has_indicadorSocial.DetalleSocial_id = DetalleSocial.id
          where DetalleSocial_has_indicadorSocial.indicadorSocial_id ='.$tiempotraslado.' and user_id  ='.$id_user);
          view()->share('Tiempo_Traslado',$Tiempo_Traslado);

          $costeoPOs=IndicadorSocial::whereIn('id', [7])->first();
        $costeo=$costeoPOs->id;
       // dd($id);


     
         $Costeo_Postgrado=DB::select('select *, DetalleSocial_has_indicadorSocial.id FROM DetalleSocial_has_indicadorSocial 
        INNER JOIN indicadorSocial ON DetalleSocial_has_indicadorSocial.indicadorSocial_id = indicadorSocial.id 
        INNER JOIN DetalleSocial ON DetalleSocial_has_indicadorSocial.DetalleSocial_id = DetalleSocial.id
         where DetalleSocial_has_indicadorSocial.indicadorSocial_id ='.$costeo.' and user_id  ='.$id_user);//. 'and user_id  ='.$id_user);
view()->share('Costeo_Postgrado',$Costeo_Postgrado);

$hijos=IndicadorSocial::whereIn('id', [8])->first();
        $numhijos=$hijos->id;
       // dd($id);


     
         $Numero_hijos=DB::select('select *, DetalleSocial_has_indicadorSocial.id FROM DetalleSocial_has_indicadorSocial 
        INNER JOIN indicadorSocial ON DetalleSocial_has_indicadorSocial.indicadorSocial_id = indicadorSocial.id 
        INNER JOIN DetalleSocial ON DetalleSocial_has_indicadorSocial.DetalleSocial_id = DetalleSocial.id
         where DetalleSocial_has_indicadorSocial.indicadorSocial_id ='.$numhijos.' and user_id  ='.$id_user);
view()->share('Numero_hijos',$Numero_hijos);
    $aspirantes=DB::table('AspPregrado')->where('AspPregrado.user_id', '=', $id_user)
    ->leftJoin('Pais as a', 'AspPregrado.PaisOrigen_id', '=', 'a.id')
    ->leftJoin('Pais as b', 'AspPregrado.PaisNacimiento_id', '=', 'b.id')
    ->leftJoin('Etnias', 'AspPregrado.Etnias_id', '=', 'Etnias.id')
    ->leftJoin('Municipios', 'AspPregrado.Municipios_id', '=', 'Municipios.id')
    ->leftJoin('UsuariosAspi', 'AspPregrado.user_id', '=', 'UsuariosAspi.id')
    ->select('Etnias.NombEtnia','AspPregrado.id','AspPregrado.Cedula','AspPregrado.PrimerNombre','AspPregrado.SegundoNombre',
    'AspPregrado.PrimerApellido','AspPregrado.SegundoApellido',
    'AspPregrado.FechaNacimiento','AspPregrado.Edad','AspPregrado.Peso','AspPregrado.Estatura',
    'AspPregrado.Nacionalidad','AspPregrado.NumPasaporte','AspPregrado.EstadoCivil',
    'AspPregrado.Genero','AspPregrado.Direccion','AspPregrado.TelefonoMovil',
    'AspPregrado.TelefonoLocal','AspPregrado.TelefonOficina','AspPregrado.Correo',
    'a.Pais as paisOrigin','b.Pais as paisNacimiento','AspPregrado.user_id')->get($id_user);


    //$aspirantes =DB::select('select *,AspPregrado.id FROM AspPregrado'.$id_user)
    //$aspirantes = Datosaspirante::all();//OBTENGO TODOS MIS PRODUCTO
    view()->share('aspirantes',$aspirantes);//VARIABLE GLOBAL PRODUCTOS

    if($request->has('ver')){
    $pdf= PDF::loadView('Aspidatos.pdf.listado_reportes');
    
    return $pdf->stream('Registro de ADMISIÓN');
    }
    return view('Aspidatos.pdf.listado_reportes');
   }




    public function create()
    {
        
    }





    public function veReporteAdmitido (Request $request) {
     
      $fecha = Carbon::now();

      $fechas= $fecha->format('d/m/Y h:i:s A');
      $prueb= $fecha->format('Y');
      $id_user=\Auth::user()->id;
     
      $idAspirante =DB::select('SELECT AspPregrado.id FROM AspPregrado , UsuariosAspi where   UsuariosAspi.id=user_id and    UsuariosAspi.id ='.$id_user);

      $idstatus="Admitido";
      
      $dato=Datosaspirante::
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
       ->select('DatosBasicos.Institutos_id','Institutos.NombInstituto','AspPregrado.Direccion','AspPregrado.TelefonoMovil','AspPregrado.TelefonoLocal',
       'DatosBasicos.ModoIngreso_Id','ModoIngreso.ModoIngreso','resultadosPrueba.id','resultadosPrueba.estatus','ModoIngreso.codigo')
       ->first();
       $Idmodoingre=$dato->ModoIngreso_Id;
      
    switch ($Idmodoingre) {
      case '1':
        $Modingreso="Bachiller";
        break;
      
      case '2':
        $Modingreso="Docentes en Servicio";
          break;

      case '3':
        $Modingreso="Egresados Universitarios";
            break;
     
    }
   // dd($Modingreso);
      $admitidos=Datosaspirante::
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


      if($request->has('ver')){
        $pdf= PDF::loadView('Aspidatos.pdf.planillAdmitido',compact('fechas','admitidos','prueb','Idmodoingre','Modingreso'));
        
        return $pdf->stream('Planilla de Admitido');
        }
        return view('Aspidatos.pdf.planillAdmitido');
       }




    public function pdf()
    {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
     

        $fecha = Carbon::now();

      $fechas= $fecha->format('d/m/Y h:i:s A');
      $prueb= $fecha->format('Y');
      $id_user=\Auth::user()->id;
     
      $idAspirante =DB::select('SELECT AspPregrado.id FROM AspPregrado , UsuariosAspi where   UsuariosAspi.id=user_id and    UsuariosAspi.id ='.$id_user);

      $idstatus="Admitido";
      $dato=Datosaspirante::
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
       ->select('DatosBasicos.Institutos_id','Institutos.NombInstituto','AspPregrado.Direccion','AspPregrado.TelefonoMovil','AspPregrado.TelefonoLocal',
       'DatosBasicos.ModoIngreso_Id','ModoIngreso.ModoIngreso','resultadosPrueba.id','resultadosPrueba.estatus','ModoIngreso.codigo')
       ->first();
       $Idmodoingre=$dato->ModoIngreso_Id;
      
    switch ($Idmodoingre) {
      case '1':
        $Modingreso="Bachiller";
        break;
      
      case '2':
        $Modingreso="Docentes en Servicio";
          break;

      case '3':
        $Modingreso="Egresados Universitarios";
            break;
     
    }
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
       //  ->leftJoin('ModoIngres', 'DatosBasicos.ModoIngreso_Id', '=', 'ModoIngreso.id')
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

        $pdf = PDF::loadView('Aspidatos.pdf.planillAdmitido', compact('fechas','admitidos','prueb','Modingreso','Idmodoingre'));

        return $pdf->download('Admitido.pdf');
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
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