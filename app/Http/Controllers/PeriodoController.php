<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Pagination;
use DB;
use Illuminate\Support\Facades\Validator;
use App\SedeEspecialidad;
use App\programas;
use App\Sede;
use App\Periodo;
use App\Especialidad;
use App\sedeInstitutos;
use Carbon\Carbon;
//use App\Http\Requests\especialidadRequest;
use Alert;

class PeriodoController extends Controller
{
    public function __construct()

    {

        $this->middleware('permission:periodo.index')->only('index');
        $this->middleware('permission:perido.create')->only(['create','store']);
        $this->middleware('permission:periodo.edit')->only(['edit','update']);
        $this->middleware('permission:periodo.destroy')->only('destroy');
    

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    public function index()
    {
      

        $consultas=DB::table('Periodo')->orderby('id','DESC')
    ->select('Periodo.NombrePeriodo','Periodo.Lapso','Periodo.id','Periodo.Vigente')->paginate(8);
   // dd($consultas);
    return view('Periodo.index',compact('consultas'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $periodos= DB::table('Periodo')->get(); 
        return view('Periodo.create',compact('periodos'));
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
            
            'NombrePeriodo' => 'required|max:4|min:4',
            'Lapso' => 'required|max:6|min:6|string',
            //'Resolucion' => 'required',
            'Vigente' => 'required',
            /*'rols_id' => 'required',
            'Apellidos' => 'required|max:20|alpha',
            'cedula' =>  'required|numeric|unique:users|digits_between:7,8',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',*/
            
        ];

        $messages = [
           // 'seleccione.required' => 'Este campo es Obligatorio.',
         
            'NombrePeriodo.required' => 'Este campo es Obligatorio.',
            'Lapso.required' => 'Este campo es Obligatorio.',
            //'Resolucion.required' => 'Este campo es Obligatorio.',
           'Vigente.required' => 'Este campo es Obligatorio.',
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
            return redirect()->action('PeriodoController@create')
                ->withErrors($validator)->withInput();
        }
        $i="1";
        $mytime = Carbon::now();
        $fecha= $mytime->format('Y');
       // dd($fecha);
        if ($i == $request->input('Vigente')) {
        $resultado=DB::table('Periodo')->where('Vigente', '=', $i)->exists();
          //  dd($resultado);
        
              if($resultado){      
           Alert::error('Error ya se encuentra un periodo activo')->autoclose(3500);
           return redirect()->route('periodo.create')->withInput();
        }
        
     }elseif ($fecha != $request->input('NombrePeriodo')) {
        Alert::error('Error Año inactivo')->autoclose(3500);
           return redirect()->route('periodo.create')->withInput();
     }



             $datosSocio = new Periodo;
            $datosSocio->NombrePeriodo            = $request->NombrePeriodo;
            //$datosSocio->sede_id            = $request->sede_id;
            $datosSocio->Lapso                    = $request->Lapso;
           // $datosSocio->Resolucion         = $request->Resolucion; 
             $datosSocio->Vigente                    = $request->Vigente;
            $datosSocio->save();
        
           
    Alert::success('Periodo creado con éxito')->autoclose(3500);

        return redirect()->route('periodo.index');
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
          $periodos=Periodo::find($id);

    return view('Periodo.edit', compact('periodos'));

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
            'NombrePeriodo' => 'required|max:4|min:4',
            'Lapso' => 'required|max:6|min:6|string',
          //  'Resolucion' => 'required',
            'Vigente' => 'required',
            
        ];

        $messages = [
         'NombrePeriodo.required' => 'Este campo es Obligatorio.',
            'Lapso.required' => 'Este campo es Obligatorio.',
          //  'Resolucion.required' => 'Este campo es Obligatorio.',
           'Vigente.required' => 'Este campo es Obligatorio.',

        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->action('PeriodoController@edit',$id)
                ->withErrors($validator)->withInput();
        }
 $i="1";
        $mytime = Carbon::now();
        $fecha= $mytime->format('Y');
       // dd($fecha);
        if ($i == $request->input('Vigente')) {
        $resultado=DB::table('Periodo')->where('Vigente', '=', $i)->exists();
          //  dd($resultado);
        
              if($resultado){      
           Alert::error('Error ya se encuentra un periodo activo')->autoclose(3500);
           return redirect()->route('periodo.create')->withInput();
        }
        
     }elseif ($fecha != $request->input('NombrePeriodo')) {
        Alert::error('Error Año inactivo')->autoclose(3500);
           return redirect()->route('periodo.create')->withInput();
     }

        $periodos =Periodo::findOrFail($id);
        $periodos->NombrePeriodo=$request->get('NombrePeriodo');
        $periodos->Lapso=$request->get('Lapso');
        //$periodos->Resolucion=$request->get('Resolucion');
        $periodos->Vigente=$request->get('Vigente');
 
        $periodos->update();
     
       Alert::success( 'Periodo actualizado con éxito')->autoclose(3500);
        return redirect()->route('periodo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $periodos  = Periodo::find($id);
           
        $periodos->delete(); 
    
     Alert::success('Periodo Eliminado con éxito')->autoclose(3500);

     return redirect()->route('periodo.index');
    }
}