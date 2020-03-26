<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Especialidad;
use App\indiceAdmision;
use Alert;
use DB;
class IndiceAdmisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()

    {

      $this->middleware('permission:indice.create')->only(['create','store']);	

      $this->middleware('permission:indice.index')->only('index');

      $this->middleware('permission:indice.edit')->only(['edit','update']);

      $this->middleware('permission:indice.show')->only('show');

      $this->middleware('permission:indice.destroy')->only('destroy');

 
    }

    public function index()
    { 
        
        $indice= DB::table('indiceadmision')
       //->where('sede_especialidads.users_id','=',Auth::user()->id)
               //  ->leftJoin('Periodo', 'sede_especialidads.Periodo_id', '=', 'Periodo.id')
               //  ->leftJoin('sede', 'sede_especialidads.sede_id', '=', 'sede.id_sede')  
                 ->leftJoin('Especialidad', 'indiceadmision.Especialidad_id', '=', 'Especialidad.id')
                // ->leftJoin('Programas', 'sede_especialidads.Programas_id', '=', 'Programas.Id')
               //   ->leftJoin('Institutos', 'sede_especialidads.Institutos_id', '=', 'Institutos.id')
                 ->select( 'Especialidad.NombEspecialidad','indiceadmision.IDA','indiceadmision.id')->get();

       //ps $especialidades= Especialidad::orderby('NombEspecialidad','ASC')->pluck('NombEspecialidad','id');
        return view('IndiceAdmision.index',compact('especialidades','indice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $especialidades= Especialidad::orderby('NombEspecialidad','ASC')->pluck('NombEspecialidad','id');
    return view('IndiceAdmision.create',compact('especialidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $activo = "1";
        $per= DB::table('Periodo')
        ->where('Periodo.Vigente', '=',$activo)->first();
       $idperiodo=$per->id; 

        $activo = "1";
        $per= DB::table('Periodo')
        ->where('Periodo.Vigente', '=',$activo)
        ->orderby('Lapso','ASC')->pluck('Lapso','id');


        $indice = new indiceAdmision;
          //  $user = Auth::user();
           // $datosSocio->Programas_id       = $request->Programas_id;
          //  $datosSocio->users_id           = $user->id;
            //$datosSocio->sede_id            = $request->sede_id;
            $indice->IDA            = $request->IDA;
             $indice->Periodo_id=$idperiodo;
            $indice->Especialidad_id    = $request->Especialidad_id;
      

            //dd($datosSocio);
            $indice->save();
        
           
    Alert::success('indice creado con éxito')->autoclose(3500);

        return redirect()->route('indice.index');
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
        $indices=indiceAdmision::find($id);
        $especialidades= Especialidad::orderby('NombEspecialidad','ASC')->pluck('NombEspecialidad','id');
        return view('IndiceAdmision.edit', compact('especialidades','indices'));
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
        $indices=indiceAdmision::findOrFail($id);
        $indices->IDA=$request->get('IDA');
        $indices->Especialidad_id=$request->get('Especialidad_id');
        $indices->update();  

        alert()->success(' ', 'Su datos fueron actualizados correctamente')->autoclose(2500);
        return redirect()->route('indice.index');
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
