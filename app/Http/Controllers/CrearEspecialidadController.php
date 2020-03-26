<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Pagination;
use DB;
use Illuminate\Support\Facades\Validator;
use App\SedeEspecialidad;
use App\programa;
use App\Sede;
use App\Periodo;
use App\Especialidad;
use App\Especialidades;
use App\sedeInstitutos;

//use App\Http\Requests\especialidadRequest;
use Alert;

class CrearEspecialidadController extends Controller
{
    public function __construct()

    {

        $this->middleware('permission:NuevaEspecialidad.index')->only('index');
        $this->middleware('permission:NuevaEspecialidad.create')->only(['create','store']);
        $this->middleware('permission:NuevaEspecialidad.edit')->only(['edit','update']);
        $this->middleware('permission:NuevaEspecialidad.destroy')->only('destroy');
    

    }


        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)

    {
         //dd($request->get('NombEspecialidad'));
         $consultas= DB::table('Especialidad')
        ->paginate(10);


   /* $consultas = Especialidad::Search($request->Programas_id)->orderBy('id','DESC')->paginate(5);
    $programa = programa::all();
    $consultas->each(function($consultas){
    $consultas->programa; 

});*/

// dd($consultas);

/*
    ->leftJoin('Programas', 'Especialidad.Programas_id', '=', 'Programas.id')
    ->select('Programas.NombProgramas','Especialidad.CodEspecialidad','Especialidad.id','Especialidad.NombEspecialidad')->paginate(8);
   // dd($consultas);*/
    return view('CrearEspecialidad.index',compact('consultas'));   
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
 
        return view('CrearEspecialidad.create');
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
            // 'seleccione' => 'required', 
            
           // 'Programas_id' => 'required',
            'NombEspecialidad' => 'required|max:150|string',
            'CodEspecialidad' => 'required|max:4|alpha|min:4',
           /* 'nucleos' => 'required',
            'rols_id' => 'required',
            'Apellidos' => 'required|max:20|alpha',
            'cedula' =>  'required|numeric|unique:users|digits_between:7,8',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',*/
            
        ];

        $messages = [
           // 'seleccione.required' => 'Este campo es Obligatorio.',
         
           // 'Programas_id.required' => 'Este campo es Obligatorio.',
            'NombEspecialidad.required' => 'Este campo es Obligatorio.',
            'CodEspecialidad.required' => 'Este campo es Obligatorio.',
          //  'Vigente.required' => 'Este campo es Obligatorio.',
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
            return redirect()->action('CrearEspecialidadController@create')
                ->withErrors($validator)->withInput();
        }

     $datosSocio = new Especialidad;
         //   $datosSocio->Programas_id            = $request->Programas_id;
            //$datosSocio->sede_id            = $request->sede_id;
            $datosSocio->NombEspecialidad        = $request->NombEspecialidad;
            $datosSocio->CodEspecialidad         = $request->CodEspecialidad;
            $datosSocio->save();
        
           
    Alert::success('Programa creado con éxito')->autoclose(3500);

        return redirect()->route('NuevaEspecialidad.index');
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
        //dd($id);

       $especialidad= Especialidad::find($id);
       ////dd($especialidad);

         return view('CrearEspecialidad.edit', compact('especialidad'));
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
            // 'seleccione' => 'required', 
            
           // 'Programas_id' => 'required',
            'NombEspecialidad' => 'required|max:150|string',
            'CodEspecialidad' => 'required|max:4|alpha|min:4',
           /* 'nucleos' => 'required',
            'rols_id' => 'required',
            'Apellidos' => 'required|max:20|alpha',
            'cedula' =>  'required|numeric|unique:users|digits_between:7,8',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',*/
            
        ];

        $messages = [
           // 'seleccione.required' => 'Este campo es Obligatorio.',
         
          //  'Programas_id.required' => 'Este campo es Obligatorio.',
            'NombEspecialidad.required' => 'Este campo es Obligatorio.',
            'CodEspecialidad.required' => 'Este campo es Obligatorio.',
          //  'Vigente.required' => 'Este campo es Obligatorio.',
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
            return redirect()->action('CrearEspecialidadController@edit',$id)
                ->withErrors($validator)->withInput();
        }
            


        $Especialidad =Especialidad::findOrFail($id);
       // $Especialidad->Programas_id=$request->get('Programas_id');
        $Especialidad->CodEspecialidad=$request->get('CodEspecialidad');
        $Especialidad->NombEspecialidad=$request->get('NombEspecialidad');
        
        $Especialidad->Update();
//dd($Especialidad);
        
           
    Alert::success('Especialidad Actualizada con éxito')->autoclose(3500);

        return redirect()->route('NuevaEspecialidad.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

           $especialidad  = Especialidad::find($id);
           
           $especialidad->delete(); 
       
        Alert::success('Especialidad Eliminada con éxito')->autoclose(3500);
   
        return redirect()->route('NuevaEspecialidad.index');
       }
}