<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\UsuariosAspi;
use Charts;
class DeshboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
      //  dd($incompletos);
      $users_count = UsuariosAspi::count();
      $users = UsuariosAspi::get();
      $valor="1";
      $records = DB::table('UsuariosAspi')->where('UsuariosAspi.datos_personales', '=', $valor)
      ->where('UsuariosAspi.datos_basicos', '=', $valor)
      ->where('UsuariosAspi.datos_academico', '=', $valor)
      ->where('UsuariosAspi.datos_Experiencia', '=', $valor)
      ->where('UsuariosAspi.datos_socioEconomico', '=', $valor)
      ->count();
      $cerovalor="0";
      $incompletos = DB::table('UsuariosAspi')
      ->where('UsuariosAspi.datos_socioEconomico', '=', $cerovalor)
      ->count();
         $users = UsuariosAspi::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))

         ->get();
 
             $chart = Charts::database($users, 'bar', 'highcharts')
 
                 ->title("Nuevos usuarios de registro mensuales")
 
                 ->elementLabel("Total Users")
 
                 ->dimensions(800, 400)
 
                 ->responsive(false)
 
                 ->groupByMonth(date('Y'), true);

      // dd($aspi);
         return view('reporteChart.Deshboard', compact('users_count','records','users','chart','incompletos','userRegister','datcompletos','aspi'));
    }

    public function listall()
    {
        $valor="1";
        $users_count = UsuariosAspi::count();
        $userRegister = DB::table('UsuariosAspi')->get();

        $datcompletos=DB::table('UsuariosAspi')->where('UsuariosAspi.datos_socioEconomico', '=', $valor)
        ->leftJoin('AspPregrado', 'AspPregrado.user_id', '=', 'UsuariosAspi.id')
        //->leftJoin('DatosBasicos', 'DatosBasicos.user_id', '=', 'UsuariosAspi.id')//esyte me trae los datos basicos
        ->leftJoin('DatosBasicos', 'DatosBasicos.Institutos_id', '=', 'UsuariosAspi.id')
        ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
        ->leftJoin('Especialidad', 'DatosBasicos.Especialidad_a_cursar1_id', '=', 'Especialidad.id')
        ->leftJoin('cupos_dirigidos', 'DatosBasicos.cupos_dirigidos_id', '=', 'cupos_dirigidos.id')
        ->select('AspPregrado.id','AspPregrado.Identificacion','AspPregrado.PrimerNombre','AspPregrado.SegundoNombre',
        'AspPregrado.PrimerApellido','AspPregrado.SegundoApellido',
        'AspPregrado.FechaNacimiento','AspPregrado.Edad','AspPregrado.Peso','AspPregrado.Estatura',
        'AspPregrado.Nacionalidad','AspPregrado.NumPasaporte','AspPregrado.EstadoCivil',
        'AspPregrado.Genero','AspPregrado.Direccion','AspPregrado.TelefonoMovil',
        'AspPregrado.TelefonoLocal','AspPregrado.TelefonOficina','AspPregrado.Estados_id',
        'AspPregrado.Municipios_id','AspPregrado.Parroquias_id',
        'AspPregrado.Correo','AspPregrado.user_id','UsuariosAspi.name','UsuariosAspi.email',
        'DatosBasicos.Especialidad_a_cursar1_id',
         'Especialidad.NombEspecialidad',
          'DatosBasicos.Institutos_id','Institutos.NombInstituto',
           'DatosBasicos.cupos_dirigidos_id', 
           'cupos_dirigidos.Cupos')->paginate(2);

         $records = DB::table('UsuariosAspi')->where('UsuariosAspi.datos_personales', '=', $valor)
         ->where('UsuariosAspi.datos_basicos', '=', $valor)
         ->where('UsuariosAspi.datos_academico', '=', $valor)
         ->where('UsuariosAspi.datos_Experiencia', '=', $valor)
         ->where('UsuariosAspi.datos_socioEconomico', '=', $valor)
         ->count();

      
         return view('reporteChart.listall', compact('users_count','records','chart','incompletos','userRegister','datcompletos','aspi'));
    }

    public function datosIncompleto()
    {
        
        $cerovalor="0";
        $aspi=DB::table('UsuariosAspi')->where('UsuariosAspi.datos_socioEconomico', '=', $cerovalor)
         ->leftJoin('AspPregrado', 'AspPregrado.user_id', '=', 'UsuariosAspi.id')
        ->leftJoin('DatosBasicos', 'DatosBasicos.user_id', '=', 'UsuariosAspi.id')//esyte me trae los datos basicos
        ->leftJoin('Especialidad', 'DatosBasicos.Especialidad_a_cursar1_id', '=', 'Especialidad.id')
        ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
       ->select('AspPregrado.id','AspPregrado.Identificacion','AspPregrado.PrimerNombre',
        'AspPregrado.PrimerApellido',
        'AspPregrado.Correo','AspPregrado.user_id',
        'UsuariosAspi.name','UsuariosAspi.email',
        'DatosBasicos.Especialidad_a_cursar1_id',
        'Especialidad.NombEspecialidad',
        'AspPregrado.TelefonoMovil', 
        'UsuariosAspi.datos_personales',
        'UsuariosAspi.datos_basicos', 
        'UsuariosAspi.datos_academico', 
        'UsuariosAspi.datos_Experiencia', 
        'UsuariosAspi.datos_socioEconomico',
        'Institutos.NombInstituto')->paginate(2);
        
        $incompletos = DB::table('UsuariosAspi')
         ->where('UsuariosAspi.datos_socioEconomico', '=', $cerovalor)
         ->count();
         return view('reporteChart.Dateimcomple', compact('users_count','records','chart','incompletos','userRegister','datcompletos','aspi'));
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
        //
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