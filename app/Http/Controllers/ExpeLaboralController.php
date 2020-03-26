<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\ExpeLaboralmodel;
use App\Http\Requests\ExperienciaFormRequest;
use DB; 
use Alert;
use App\Estado;
class ExpeLaboralController extends Controller
{

      public function __construct(){

        $this->middleware('auth:UsuariosAspi');
    }

   // 
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
       //  $datoacademico = $this->obtenerDatosAcademico();

        $id_user=\Auth::user()->id;
        //dd($id_user);

          $Esperiencia=DB::table('ExperienciaLaboral')->where('ExperienciaLaboral.user_id', '=', $id_user)
          ->leftJoin('Estados', 'ExperienciaLaboral.Estado_id', '=', 'Estados.id')
        ->select('ExperienciaLaboral.NombreInstitucion','Estados.Estado','ExperienciaLaboral.AñoGraduado','ExperienciaLaboral.AñoServicio','ExperienciaLaboral.Estado_id','ExperienciaLaboral.id')->get($id_user);

        /*$Esperiencia=DB::select('select * FROM ExperienciaLaboral where user_id ='.$id_user);*/
       // dd($Esperiencia);
        //ExpeLaboralmodel::orderBy('id', 'DESD')->paginate();
        $estado =Estado::orderBy('Estado','ASC')->pluck('Estado','id'); 
        //$Esperiencia= \Auth::user()->ExperienciaLaboral()-> withoutGroup()->get();
        return view('Aspidatos.indexExper',compact('Esperiencia','estado'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estado =Estado::orderBy('Estado','ASC')->pluck('Estado','id'); 
        
        return view('Aspidatos.createExpe',compact('estado'));
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
            'NombreInstitucion' => 'required|filled',
            'AñoGraduado'  =>'required',
            'AñoServicio' =>'required',
            'Estado_id' =>'required',
           
        ];


         $messages = [
            'NombreInstitucion.required' => 'Este Campo Solo Debe Contener Letras y es Requerido.',
            'AñoGraduado.required' => 'Por Favor Debe Señalar la Dirección ',
            'AñoServicio.required' => 'Por Favor Es Importante Este Campo.',
            'tipoOrEstado_idganizacion.required' => 'Este Campo es Obligatorio.',
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->action('ExpeLaboralController@create')
                ->withErrors($validator)
                ->withInput();
        }       



        $id_user=\Auth::user()->id;
        $Dato =DB::select('SELECT AspPregrado.id FROM AspPregrado , UsuariosAspi where   UsuariosAspi.id=user_id and    UsuariosAspi.id ='.$id_user);
         
        $activo="1"; 
       $per= DB::table('Periodo')
       ->where('Periodo.Vigente', '=',$activo)->first();
      $idperiodo=$per->id;  
      

        $Esperiencia= new ExpeLaboralmodel(request()->all());
        $Esperiencia->user_id= \Auth::user()->id; 
        $Esperiencia->AspPregrado_id = $Dato[0]->id;
        $Esperiencia->Periodo_id= $idperiodo;
        
        $Esperiencia->save();

         \Auth::user()->update([
        'datos_Experiencia' => 1,
       ]);
        alert()->success(' ', 'Sus datos fueron guardado correctamente')->autoclose(2500);
        return redirect()->route('Esperiencia.index');
               
   

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


    $Esperiencia=ExpeLaboralmodel::find($id);
    $estado =Estado::orderBy('Estado','ASC')->pluck('Estado','id');    
    return view('Aspidatos.editExperiencia', compact('Esperiencia','estado'));

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
            'NombreInstitucion' => 'required|filled',
            'AñoGraduado'  =>'required',
            'AñoServicio' =>'required',
            'Estado_id' =>'required',
           
        ];


         $messages = [
            'NombreInstitucion.required' => 'Este Campo Solo Debe Contener Letras y es Requerido.',
            'AñoGraduado.required' => 'Por Favor Debe Señalar la Dirección ',
            'AñoServicio.required' => 'Por Favor Es Importante Este Campo.',
            'Estado_id.required' => 'Este Campo es Obligatorio.',
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->action('ExpeLaboralController@edit',$id)
                ->withErrors($validator)
                ->withInput();
        }   


       $Esperiencia= ExpeLaboralmodel::findOrFail($id);
       $Esperiencia->NombreInstitucion = $request->get('NombreInstitucion');
       $Esperiencia->AñoGraduado = $request->get('AñoGraduado');
       $Esperiencia->AñoServicio = $request->get('AñoServicio');
       $Esperiencia->Estado_id = $request->get('Estado_id');
       $Esperiencia->update();

        alert()->success(' ', 'Sus datos fueron actualizados correctamente')->autoclose(2500);
        return redirect()->route('Esperiencia.index');
                

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
