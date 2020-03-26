<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facedes\Redirect;
use Illuminate\Support\Facades\Validator;
use DB;
use Carbon\Carbon;
use Alert;
use App\Datosaspirante;
use App\Temporal;
use App\UsuariosAspi;
use App\repuestaPrueba;

use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;
class AspirantesAdmitidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()

    {

     // $this->middleware('permission:Admitidos.store')->only(['create','store']);	

      $this->middleware('permission:Admitidos.index')->only('index','AdmitidosStore');

      $this->middleware('permission:no_Aptos')->only(['edit','noAptosStore']);

 
    }

    public function getmodoingreso($id)
    {

        $Aprobacion='1';

        $modingreso = DB::table('ofertas')

        ->leftJoin('ModoIngreso', 'ModoIngreso.Id', '=', 'ofertas.ModoIngreso_Id')
        //->leftJoin('Institutos', 'sede_especialidads.Institutos_id', '=', 'Institutos.id')->where('Institutos_id', '=', \Auth::user()->sede_id)

        ->where('ofertas.Institutos_id','=',$id)
        ->where('ofertas.Aprobacion', '=', $Aprobacion)
        ->distinct('ofertas.ModoIngreso_Id')
        ->pluck("ModoIngreso.ModoIngreso","ModoIngreso.Id");
        //dd($subprograma);

        return json_encode($modingreso);
         //$subprograma = SedeEspecialidad::where('Programas_id',$request->valor)->get();
      
        //return response()->json($subprograma);

    }


    public function getsubprogramas($id)
    {
        $Aprobacion='1';
        $subprograma = DB::table('ofertas')

        ->leftJoin('Especialidad', 'Especialidad.id', '=', 'ofertas.Especialidad_id')
        //->leftJoin('Institutos', 'sede_especialidads.Institutos_id', '=', 'Institutos.id')->where('Institutos_id', '=', \Auth::user()->sede_id)

        ->where('ofertas.ModoIngreso_Id','=',$id)
        //->where('ofertas.Institutos_id','=',$id)
        
       ->where('ofertas.Aprobacion', '=', $Aprobacion)
        ->distinct('ofertas.Especialidad_id')
        ->pluck("Especialidad.NombEspecialidad","Especialidad.id");
        //dd($subprograma);

        return json_encode($subprograma);
         //$subprograma = SedeEspecialidad::where('Programas_id',$request->valor)->get();
      
        //return response()->json($subprograma);

    }

    


    public function index(Request $request)
    {
        $Aprobacion='1';
        $especialidad=DB::table('ofertas')
        ->where('ofertas.Especialidad_id',$request->input('Institutos_id'))
        ->leftJoin('Especialidad', 'ofertas.Especialidad_id', '=', 'Especialidad.id')
        //->leftJoin('Especialidad as a', 'DatosBasicos.Especialidad_a_cursar2_id', '=', 'a.id')
        //->leftJoin('Especialidad as b', 'DatosBasicos.Especialidad_a_cursar3_id', '=', 'b.id')
         ->select('Especialidad.NombEspecialidad')
        ->orderBy('NombEspecialidad', 'DESC')->pluck('NombEspecialidad','Especialidad_id');

        $sedeofertas=DB::table('ofertas')
        ->where('ofertas.Aprobacion', '=', $Aprobacion)
        ->leftJoin('Institutos', 'ofertas.Institutos_id', '=', 'Institutos.id')
        ->orderBy('NombInstituto', 'DESC')->pluck('NombInstituto','Institutos_id');

    


        return view('Admitidos.index', compact('sedeofertas','especialidad'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTemporal(Request $request)
    {
       
      
       $activo = "1";
       $idinstituto= $request->Institutos_id;
       $idmodoingre= $request->ModoIngreso_Id;
       $idEspecial= $request->Especialidad_id;
  
  
       //creando la tabla temporal
        Schema::create('TEMPORALADM', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('resultadosPrueba_id');
            $table->integer('PosicionAdmision')->nullable();
            $table->string('condicion');
        });



        $cupos=DB::table('ofertas')->where('ofertas.Especialidad_id', '=', $idEspecial)
    ->where('ofertas.Institutos_id', '=', $idinstituto)
    ->where('ofertas.ModoIngreso_Id', '=', $idmodoingre)
    ->select('ofertas.Cuposofertas')->first();
   

    $cupoofertas=$cupos->Cuposofertas;
    $per= DB::table('Periodo')
    ->where('Periodo.Vigente', '=',$activo)->first();
   $idperiodo=$per->id;     
  // dd($idperiodo);
    $iDa=DB::table('indiceadmision')->where('indiceadmision.Especialidad_id', '=', $idEspecial)
    ->where('indiceadmision.Periodo_id', '=', $idperiodo)
   // ->where('ofertas.ModoIngreso_Id', '=', $idmodoingre)
    ->select('indiceadmision.IDA')->first();
    $IndiceDA=$iDa->IDA;
   // dd($IndiceDA);
    $acto='Apto';

    DB::statement(DB::raw('SET @rownum = 0')); 
        $posiciones=DB::table('resultadosPrueba')
   
        ->leftJoin('AspPregrado', 'resultadosPrueba.AspPregrado_id', '=', 'AspPregrado.id')
        ->leftJoin('DatosBasicos', 'resultadosPrueba.AspPregrado_id', '=', 'DatosBasicos.AspPregrado_id')
        ->leftJoin('Especialidad', 'DatosBasicos.Especialidad_a_cursar1_id', '=', 'Especialidad.id')
        ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
        ->leftJoin('ModoIngreso', 'DatosBasicos.ModoIngreso_Id', '=', 'ModoIngreso.Id')
        ->select(DB::raw( '@rownum := @rownum + 1 as posicion '),'resultadosPrueba.IndiceAcademico','AspPregrado.PrimerNombre','resultadosPrueba.id','resultadosPrueba.condicion')
        ->where('DatosBasicos.Especialidad_a_cursar1_id', '=', $idEspecial)
        ->where('DatosBasicos.Institutos_id', '=', $idinstituto)
        ->where('DatosBasicos.ModoIngreso_Id', '=', $idmodoingre)
        ->where('resultadosPrueba.IndiceAcademico', '>=', $IndiceDA)
        ->where('resultadosPrueba.estatus', '=',  $acto)
       ->orderBy('resultadosPrueba.IndiceAcademico','posicion', 'DESC')
        //->orderByRaw(DB::raw("FIELD(posicion, ">=", ".$IndiceDA." ) DESC"))
        ->LIMIT($cupoofertas) 
        //->orderBy('idparticipante', 'desc')
        ->get();
       //dd($posiciones);

     //  DB::table('TEMPORALADM')->insert($posiciones);

   


       foreach ($posiciones as $key => $value) {
        //dd($value);

        //GUARDO EN LA TABLA TEMPORAL
        $datos = new temporal;
        $datos->resultadosPrueba_id =  $value->id;
        $datos->condicion= 'Admitido';
       
        $datos->save();      
        //dd($datos->id);

        //ACTUALIZO EN LA TABLA TEMPORAL
        $datos->PosicionAdmision =  $datos->id;
        $datos->update();

        //ACTUALIZO EN LA TABLA ORIGINAL
        $actual =repuestaPrueba::findOrFail( $value->id);
        $actual->PosicionAdmision =  $datos->id;
        $actual->condicion= 'Admitido';
        $actual->update();

       
        };
        ///ELIMINADO TABLA TEMPORAL
       Schema::drop('TEMPORALADM');

       alert()->success('', 'Proceso culminado')->autoclose(2500);
                    
       return redirect()->route('Admitidos.index');
  
        
    }



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
    public function AdmitidosStore(Request $request)
    {
        $var="Admitido";
        $data = $request['aprobacion'];
        foreach ($data as $admitidos) {
                  $p = repuestaPrueba::where('id', '=', $admitidos)->firstOrFail();
  
                  $p->condicion = $var;
  
                  $p->save();
  
              }
             
       Alert::success('Admitido con Exito')->autoclose(3500);
       return  redirect()->route('Admitidos.index');
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

    public function noAptos(Request $request)
    {
        $Aprobacion='1';
       
       

        $especialidad=DB::table('ofertas')
        ->where('ofertas.Especialidad_id',$request->input('Institutos_id'))
        ->leftJoin('Especialidad', 'ofertas.Especialidad_id', '=', 'Especialidad.id')
        //->leftJoin('Especialidad as a', 'DatosBasicos.Especialidad_a_cursar2_id', '=', 'a.id')
        //->leftJoin('Especialidad as b', 'DatosBasicos.Especialidad_a_cursar3_id', '=', 'b.id')
         ->select('Especialidad.NombEspecialidad')
        ->orderBy('NombEspecialidad', 'DESC')->pluck('NombEspecialidad','Especialidad_id');

        $sedeofertas=DB::table('ofertas')
        ->where('ofertas.Aprobacion', '=', $Aprobacion)
        ->leftJoin('Institutos', 'ofertas.Institutos_id', '=', 'Institutos.id')
        ->orderBy('NombInstituto', 'DESC')->pluck('NombInstituto','Institutos_id');

               //dd($admitidos);

        return view('Admitidos.NoAptos', compact('sedeofertas','especialidad'));
    }


    public function IndexActos(Request $request)
    {
        
        $idinstituto= $request->Institutos_id;
        $idmodoingre= $request->ModoIngreso_Id;
        $idEspecial= $request->Especialidad_id;
        $activo = "1";
       // dd($NombEspecialidad);
       $idcondicion="En_Proceso";
       $idstatus="Apto";
       $per= DB::table('Periodo')
       ->where('Periodo.Vigente', '=',$activo)->first();
      $idperiodo=$per->id;     
     // dd($idperiodo);
       $iDa=DB::table('indiceadmision')->where('indiceadmision.Especialidad_id', '=', $idEspecial)
       ->where('indiceadmision.Periodo_id', '=', $idperiodo)
      // ->where('ofertas.ModoIngreso_Id', '=', $idmodoingre)
       ->select('indiceadmision.IDA')->first();
       $IndiceDA=$iDa->IDA;

       $admitidos=Datosaspirante::
       where('resultadosPrueba.condicion', '=', $idcondicion)
       ->where('resultadosPrueba.estatus', '=', $idstatus)
       ->where('DatosBasicos.Especialidad_a_cursar1_id', '=', $idEspecial)
       ->where('DatosBasicos.Institutos_id', '=', $idinstituto)
       ->where('DatosBasicos.ModoIngreso_Id', '=', $idmodoingre)
       ->where('resultadosPrueba.IndiceAcademico', '>=', $IndiceDA)
       ->leftJoin('resultadosPrueba', 'resultadosPrueba.AspPregrado_id', '=', 'AspPregrado.id')
        ->leftJoin('DatosBasicos', 'DatosBasicos.AspPregrado_id', '=', 'AspPregrado.id') 
        ->leftJoin('Deposito', 'Deposito.AspPregrado_id', '=', 'AspPregrado.id')
        ->leftJoin('Especialidad', 'DatosBasicos.Especialidad_a_cursar1_id', '=', 'Especialidad.id')
        //->leftJoin('Especialidad as a', 'DatosBasicos.Especialidad_a_cursar2_id', '=', 'a.id')
        //->leftJoin('Especialidad as b', 'DatosBasicos.Especialidad_a_cursar3_id', '=', 'b.id')
        ->leftJoin('ModoIngreso', 'DatosBasicos.ModoIngreso_Id', '=', 'ModoIngreso.Id')
        ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
         ->select('AspPregrado.id','AspPregrado.Cedula','AspPregrado.PrimerNombre','AspPregrado.SegundoNombre',
        'AspPregrado.PrimerApellido','AspPregrado.SegundoApellido',
        'AspPregrado.FechaNacimiento','AspPregrado.Edad','AspPregrado.Peso','AspPregrado.Estatura',
        'AspPregrado.Nacionalidad','AspPregrado.NumPasaporte','AspPregrado.EstadoCivil',
        'AspPregrado.Genero','AspPregrado.Direccion','AspPregrado.TelefonoMovil',
        'AspPregrado.TelefonoLocal','AspPregrado.TelefonOficina','AspPregrado.Estados_id',
        'AspPregrado.Municipios_id','AspPregrado.Parroquias_id','AspPregrado.PaisOrigen_id',
        'AspPregrado.Correo','AspPregrado.user_id','resultadosPrueba.condicion',
        'Especialidad.NombEspecialidad','Deposito.NumDeposito',
          'DatosBasicos.Institutos_id','Institutos.NombInstituto',
          'DatosBasicos.ModoIngreso_Id','ModoIngreso.ModoIngreso'
          ,'resultadosPrueba.id','resultadosPrueba.estatus'//,
          /*'a.NombEspecialidad as curso2','b.NombEspecialidad as curso3'*/)

       
               
               ->paginate(25);

               return view('Admitidos.ActosRestantes');
    }



    public function noAptosStore(Request $request)
    {
        $var="Admitido";
        $data = $request['aprobacion'];
      //  dd($data);
        foreach ($data as $admitidos) {
                  $p = repuestaPrueba::where('id', '=', $admitidos)->firstOrFail();
  
                  $p->condicion = $var;
                  $p->observacion =$request->input('motivo');
                  $p->save();
  
              }
             
       Alert::success('Admitido con Exito')->autoclose(3500);
       return  redirect()->route('no_Aptos');
    }







}
