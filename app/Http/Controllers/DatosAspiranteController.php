<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//use SistemaAdmision\Http\Request;
use App\Datosaspirante; //MODELO LLAMADO DE LA TABLA
use App\Pais; //MODELO LLAMADO DE LA TABLA
use App\Etnia; //MODELO LLAMADO DE LA TABLA
use App\Banco; //MODELO LLAMADO DE LA TABLA
use App\Estado; //MODELO LLAMADO DE LA TABLA
use App\Municipio; //MODELO LLAMADO DE LA TABLA
use App\Especialidad; //MODELO LLAMADO DE LA TABLA
use App\modingresos; //MODELO LLAMADO DE LA TABLA
use App\sede; //MODELO LLAMADO DE LA TABLA
use App\UsuariosAspi; //MODELO LLAMADO DE LA TABLA
use App\Parroquias; //MODELO LLAMADO DE LA TABLA
use App\discapacidad;
use Illuminate\Support\Facedes\Redirect;
use App\Http\Requests\DatosAspiFormRequest;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;
use Carbon\Carbon;
use Alert;
//use Pais;
class DatosAspiranteController extends Controller
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

    
    public function getParroquias(Request $request){
    $parroquias = Parroquias::where('Municipios_id',$request->valor)->get();
        

        return response()->json($parroquias);
    

    }

    public function index(Request $request)

    {
       


            $id_user=\Auth::user()->id;
        //dd($id_user); 
           
         

      

        $name=\Auth::user()->name;
//dd($name);
        $Datos=UsuariosAspi::find($id_user);
        $idemail=$Datos->email;
        //dd($idemail);
       // Move::pluck('type_name', 'id'
          $pais = Pais::orderBy('Pais','ASC')->pluck('Pais','id'); 
         $etnia =Etnia::orderBy('NombEtnia','DESC')->pluck('NombEtnia','id'); 
         $estado =Estado::orderBy('Estado','ASC')->pluck('Estado','id'); 
         $municipio =Municipio::orderBy('Municipio','ASC')->pluck('Municipio','id'); 
         $parroquia =Parroquias::orderBy('Parroquias','ASC')->pluck('Parroquias','id'); 

         $discapacidad = discapacidad::orderBy('discapacidad','ASC')->pluck('discapacidad','id'); 
          





             $DatosAspirante=DB::table('AspPregrado')->where('AspPregrado.user_id', '=', $id_user)
        ->leftJoin('Etnias', 'AspPregrado.Etnias_id', '=', 'Etnias.id')
        ->leftJoin('Municipios', 'AspPregrado.Municipios_id', '=', 'Municipios.id')
        ->leftJoin('UsuariosAspi', 'AspPregrado.user_id', '=', 'UsuariosAspi.id')
        ->select('Etnias.NombEtnia','AspPregrado.id','AspPregrado.Cedula','AspPregrado.PrimerNombre','AspPregrado.SegundoNombre',
        'AspPregrado.PrimerApellido','AspPregrado.SegundoApellido',
        'AspPregrado.FechaNacimiento','AspPregrado.Edad','AspPregrado.Peso','AspPregrado.Estatura',
        'AspPregrado.Nacionalidad','AspPregrado.NumPasaporte','AspPregrado.EstadoCivil',
        'AspPregrado.Genero','AspPregrado.Direccion','AspPregrado.TelefonoMovil',
        'AspPregrado.TelefonoLocal','AspPregrado.TelefonOficina','AspPregrado.Correo',
        'AspPregrado.Correo','AspPregrado.Correo','AspPregrado.Correo','AspPregrado.user_id')->get($id_user);
        //dd($DatosAspirante);
        //$FechaNacimiento=$DatosAspirante->FechaNacimiento;

       //  $fechad=Carbon::parse($FechaNacimiento)->format('d/m/Y');

        
       //  dd($Datos);
      //$Datos=Datosaspirante::orderBy('Cedula','DESC')->paginate() ;


        return view('Aspidatos.index',compact('DatosAspirante','discapacidad','user','fechad','pais','etnia','estado','municipio','parroquia','idemail','name'));

       
     }
  

    public function create()
    {
        $id_user=\Auth::user()->id;
        $name=\Auth::user()->name;
//dd($name);
        $Datos=UsuariosAspi::find($id_user);
        $idemail=$Datos->email;
        //dd($idemail);
       // Move::pluck('type_name', 'id'
          $pais = Pais::orderBy('Pais','ASC')->pluck('Pais','id'); 
          $discapacidad = discapacidad::orderBy('discapacidades','ASC')->pluck('discapacidad','id'); 
         $etnia =Etnia::orderBy('NombEtnia','DESC')->pluck('NombEtnia','id'); 
         $estado =Estado::orderBy('Estado','ASC')->pluck('Estado','id'); 
         $municipio =Municipio::orderBy('Municipio','ASC')->pluck('Municipio','id'); 
         $parroquia =Parroquias::orderBy('Parroquias','ASC')->pluck('Parroquias','id'); 
         //dd($fechaedad);
       return view('Aspidatos.create', compact('pais','discapacidad','etnia','estado','municipio','parroquia','idemail','name'));
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request )
    {
        
        $rules = [
            'Cedula' => 'nullable|numeric|unique:users|digits_between:7,8',
            'PrimerNombre' => 'required|alpha|max:15',
           'SegundoNombre' => 'nullable|alpha',
            'PrimerApellido' => 'required|alpha',
            'SegundoApellido' => 'nullable|alpha',
            'NumPasaporte' => 'nullable|numeric',
            'discapacidad_id' => 'nullable|required',
            'Nacionalidad' => 'required',
            'EstadoCivil' => 'required',
            'FechaNacimiento' => 'required|date_format:d/m/Y',
            'Direccion' => 'required',
            'TelefonoMovil' => 'required',
            'TelefonoLocal' => 'required',
           'TelefonOficina' => 'nullable',
            'Peso'  =>'required|numeric',
            'Estatura'  =>'required|numeric',

           // 'Correo'  =>'email',
           // |string|email|max:255|unique:UsuariosAspi',
            'Etnias_id'  =>'required',
            'Genero' =>'required|alpha',
            'discapacidad_id' => 'required',
            //'TelefonOficina' => 'required',
        ];
           


        $messages = [
            'Nacionalidad .required' => 'La Nacionalidad es requerido.',
            'PrimerNombre .required' => 'El Primer Nombre es requerido.',
            'SegundoNombre.required' => 'El Segundo Nombre es requerido.',
            'PrimerApellido .required' => 'El Primer Apellido es requerido.',
            'SegundoApellido.required' => 'El Segundo Apellido es requerido.',
            'Genero.required' => 'El Genero es requerido.',
            'discapacidad_id.required' => 'El  es requerido.',
            'Nacionalidad .required' => 'La Nacionalidad es Importante.',
            'EstadoCivil.required' => 'El Estado Civil es requerido.',
            'FechaNacimiento.required' => 'La Fecha de Nacimiento debe coincidir con el formato correcto.',
            'Direccion.required' => 'La Direccion es requerido.',
            'TelefonoMovil.required' => 'Debes Colocar un Numero De Telefono valido.',
            'TelefonoLocal.required' => 'Debes Colocar un Numero De Telefono Local valido.', 
            'Peso.required' => 'El Peso es requerido.', 
            'Estatura.required' => 'La Estatura es requerido.', 
            'Correo.required' => 'Este Campo  es requerido.', 
            'Etnias_id.required' => 'Este Campo es requerido.',
            'discapacidad_id.required' => 'Este Campo es requerido.',
           // 'Edad' => 'Lo Sentimos pero Usted es Menor de Edad Verifique su Fecha de Nacimiento'  
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->action('DatosAspiranteController@index')
                ->withErrors($validator)
                ->withInput();
        }
     
        $id_user=\Auth::user()->id;
        $Datos=UsuariosAspi::find($id_user);
        $idemail=$Datos->email;
       // dd($idemail);
       $edad = Carbon::createFromFormat('d/m/Y',$request->FechaNacimiento)->age;
     
       if($edad < 18) {
           
                
        session()->flash('error','Eres Menor de Edad, Corrija su fecha de nacimiento');
           
           return redirect()->route('DatosAspirante.index')->withInput();
           // lo rediriges a la página que quieras
       }
       $Datos= new Datosaspirante(request()->all());
       $Datos->Edad = Carbon::createFromFormat('d/m/Y',$request->FechaNacimiento)->age;
       $Datos->FechaNacimiento= Carbon::createFromFormat( 'd/m/Y', $request->input('FechaNacimiento'));
       $Datos->user_id= \Auth::user()->id;
       $Datos->Estados_id = $request->Estados_id;
       $Datos->Municipios_id = $request->Municipios_id;
       $Datos->Parroquias_id = $request->Parroquias_id;
       $Datos->discapacidad_id = $request->discapacidad_id;
       $Datos->Correo = $idemail;
       $Datos->save();

       //aqui actualo el usuario 
       \Auth::user()->update([
        'datos_personales' => 1,
       ]);

     
      alert()->success(' ', 'Su datos fueron guardado correctamente')->autoclose(2500);

        //session()->flash('notif','Su Datos Fueron Guardado Correctamente');
        return redirect()->route('DatosAspirante.index');  
        
    
    

     }

  


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        

     }
    public function edit($id)
    {     
         $id_user=\Auth::user()->id;
         $DatosAspirante=DB::table('AspPregrado')->where('AspPregrado.user_id', '=', $id_user)
        ->leftJoin('Etnias', 'AspPregrado.Etnias_id', '=', 'Etnias.id')
        ->leftJoin('Municipios', 'AspPregrado.Municipios_id', '=', 'Municipios.id')
        ->leftJoin('UsuariosAspi', 'AspPregrado.user_id', '=', 'UsuariosAspi.id')
        ->select('Etnias.NombEtnia','AspPregrado.id','AspPregrado.Cedula','AspPregrado.PrimerNombre','AspPregrado.SegundoNombre',
        'AspPregrado.PrimerApellido','AspPregrado.SegundoApellido',
        'AspPregrado.FechaNacimiento','AspPregrado.Edad','AspPregrado.Peso','AspPregrado.Estatura',
        'AspPregrado.Nacionalidad','AspPregrado.NumPasaporte','AspPregrado.EstadoCivil',
        'AspPregrado.Genero','AspPregrado.Direccion','AspPregrado.TelefonoMovil',
        'AspPregrado.TelefonoLocal','AspPregrado.TelefonOficina','AspPregrado.Correo',
        'AspPregrado.Correo','AspPregrado.Correo','AspPregrado.Correo','AspPregrado.user_id','AspPregrado.Estados_id')->first($id_user);
           $fechanaci=$DatosAspirante->FechaNacimiento;

        $fechad=Carbon::parse($fechanaci)->format('d/m/Y');

        $estado=$DatosAspirante->Estados_id;

          // dd($fechad);
          $Datos=Datosaspirante::find($id);

          

          //$Datos->selectpais;
         $pais = Pais::orderBy('Pais','ASC')->pluck('Pais','id'); 
         $etnia =Etnia::orderBy('NombEtnia','ASC')->pluck('NombEtnia','id'); 
         $estado =Estado::orderBy('Estado','ASC')->pluck('Estado','id'); 
         $discapacidad = discapacidad::orderBy('discapacidad','ASC')->pluck('discapacidad','id');    
         $idEstado =DB::table('AspPregrado')
         ->leftJoin('Estados', 'AspPregrado.Estados_id', '=', 'Estados.id')
         ->where('AspPregrado.user_id', '=', $id_user)
         ->first(); 
         $idesta=$idEstado->Estados_id;

         $idmuni =DB::table('AspPregrado')
         ->leftJoin('Municipios', 'AspPregrado.Municipios_id', '=', 'Municipios.id')
         ->leftJoin('Estados', 'AspPregrado.Estados_id', '=', 'Estados.id')
         ->where('AspPregrado.user_id', '=', $id_user)
         ->where('AspPregrado.Estados_id', '=', $idesta)
         ->first(); 
      
        
         $idMUNI=$idmuni->Municipios_id;
       //  dd($idMUNI);


       /*  $municipio =DB::table('AspPregrado')
         ->leftJoin('Municipios', 'AspPregrado.Municipios_id', '=', 'Municipios.id')
         ->where('AspPregrado.user_id', '=', $id_user)
         ->orderBy('Municipio','ASC')->pluck('Municipio','Municipios.id'); */
           /*$parroquia =DB::table('AspPregrado')
         ->leftJoin('Parroquias', 'AspPregrado.Parroquias_id', '=', 'Parroquias.id')
         ->where('AspPregrado.user_id', '=', $id_user)-> orderBy('Parroquias','ASC')->pluck('Parroquias','Parroquias.id'); */
         $municipio =DB::table('Municipios')
         ->leftJoin('Estados', 'Municipios.Estados_id', '=', 'Estados.id')
         ->where('Municipios.Estados_id', '=', $idesta)
         ->orderBy('Municipio','ASC')->pluck('Municipio','Municipios.id'); 
       // dd($municipio);
       $parroquia =DB::table('Parroquias')
         ->where('Parroquias.Municipios_id', '=', $idMUNI)
         ->orderBy('Parroquias','ASC')->pluck('Parroquias','Parroquias.id'); 
         //dd($parroquia);
        return view('Aspidatos.editpersonales', compact('discapacidad','Datos','pais','etnia','estado','municipio','parroquia','fechad'));   
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
            'Cedula' => 'nullable|numeric|unique:users|digits_between:7,8',
            'PrimerNombre' => 'required|alpha|max:15',
           'SegundoNombre' => 'nullable|alpha',
            'PrimerApellido' => 'required|alpha',
            'SegundoApellido' => 'nullable|alpha',
            'NumPasaporte' => 'nullable|numeric',
            'discapacidad_id' => 'nullable|required',
            'Nacionalidad' => 'required',
            'EstadoCivil' => 'required',
            'FechaNacimiento' => 'required|date_format:d/m/Y',
            'Direccion' => 'required',
            'TelefonoMovil' => 'required',
            'TelefonoLocal' => 'required',
           'TelefonOficina' => 'nullable',
            'Peso'  =>'required|numeric',
            'Estatura'  =>'required|numeric',

           // 'Correo'  =>'email',
           // |string|email|max:255|unique:UsuariosAspi',
            'Etnias_id'  =>'required',
            'Genero' =>'required|alpha',
            'discapacidad_id' => 'required',
            //'TelefonOficina' => 'required',
        ];
           


        $messages = [
            'Nacionalidad .required' => 'La Nacionalidad es requerido.',
            'PrimerNombre .required' => 'El Primer Nombre es requerido.',
            'SegundoNombre.required' => 'El Segundo Nombre es requerido.',
            'PrimerApellido .required' => 'El Primer Apellido es requerido.',
            'SegundoApellido.required' => 'El Segundo Apellido es requerido.',
            'Genero.required' => 'El Genero es requerido.',
            'discapacidad_id.required' => 'El  es requerido.',
            'Nacionalidad .required' => 'La Nacionalidad es Importante.',
            'EstadoCivil.required' => 'El Estado Civil es requerido.',
            'FechaNacimiento.required' => 'La Fecha de Nacimiento debe coincidir con el formato correcto.',
            'Direccion.required' => 'La Direccion es requerido.',
            'TelefonoMovil.required' => 'Debes Colocar un Numero De Telefono valido.',
            'TelefonoLocal.required' => 'Debes Colocar un Numero De Telefono Local valido.', 
            'Peso.required' => 'El Peso es requerido.', 
            'Estatura.required' => 'La Estatura es requerido.', 
            'Correo.required' => 'Este Campo  es requerido.', 
            'Etnias_id.required' => 'Este Campo es requerido.',
            'discapacidad_id.required' => 'Este Campo es requerido.',
           // 'Edad' => 'Lo Sentimos pero Usted es Menor de Edad Verifique su Fecha de Nacimiento'  
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->action('DatosAspiranteController@edit',$id)
                ->withErrors($validator)
                ->withInput();
        }
         $edad = Carbon::createFromFormat('d/m/Y',$request->FechaNacimiento)->age;
       
       if($edad < 18) {
           
     alert()->error('Error', 'Eres Menor de Edad, Corrija su fecha de nacimiento')->autoclose(2500);
           
           return redirect()->route('DatosAspirante.edit',$id)->withInput();
           // lo rediriges a la página que quieras
       }

        $Datos=Datosaspirante::findOrFail($id);
       // dd($Datos);
        $Datos->Cedula=$request->get('Cedula');
        $Datos->PrimerNombre=$request->get('PrimerNombre');  
        $Datos->SegundoNombre=$request->get('SegundoNombre'); 
        $Datos->PrimerApellido=$request->get('PrimerApellido'); 
        $Datos->SegundoApellido=$request->get('SegundoApellido'); 
        $Datos->Nacionalidad=$request->get('Nacionalidad'); 
        $Datos->NumPasaporte=$request->get('NumPasaporte'); 
        $Datos->EstadoCivil=$request->get('EstadoCivil');
        $Datos->Edad = Carbon::createFromFormat('d/m/Y',$request->FechaNacimiento)->age;
        $Datos->Genero=$request->get('Genero');  
        $Datos->FechaNacimiento=$request->FechaNacimiento= Carbon::createFromFormat( 'd/m/Y', $request->input('FechaNacimiento'));
        $Datos->Direccion=$request->get('Direccion'); 
        $Datos->discapacidad_id=$request->get('discapacidad_id');
        $Datos->TelefonoMovil=$request->get('TelefonoMovil'); 
        $Datos->TelefonoLocal=$request->get('TelefonoLocal'); 
        $Datos->TelefonOficina=$request->get('TelefonOficina'); 
        $Datos->discapacidad_id = $request->get('discapacidad_id'); 
       // $Datos->Correo=$request->get('Correo'); 
        $Datos->Peso=$request->get('Peso'); 
        $Datos->PaisOrigen_id=$request->get('PaisOrigen_id');
        $Datos->PaisNacimiento_id=$request->get('PaisNacimiento_id');
        $Datos->Etnias_id=$request->get('Etnias_id');
        $Datos->Estados_id=$request->get('Estados_id');
        $Datos->Municipios_id=$request->get('Municipios_id');
        $Datos->Parroquias_id=$request->get('Parroquias_id');
       // $Datos->ExperienciaLaboral_id=$request->get('ExperienciaLaboral_id');
      // dd($Datos);
        $Datos->update();  

        alert()->success(' ', 'Su datos fueron actualizados correctamente')->autoclose(2500);
        return redirect()->route('DatosAspirante.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Datos=Datosaspirante::findOrFail($id);
        $Datos->condicion='o';
        $Datos->update();
        return Redirect::to('Admision/DatosAspirante');    
         }


}

