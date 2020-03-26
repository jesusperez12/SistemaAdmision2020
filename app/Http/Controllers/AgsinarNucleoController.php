<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sede;

use App\User;
use DB;
use Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\InstitutoUser;
use App\sedeInstitutos;
class AgsinarNucleoController extends Controller
{
    public function __construct()

    {

        $this->middleware('auth');

    }

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function index()
    {   
        

        $nucleo=DB::table('sedeInstitutos')->orderby('id','ASC')
        ->leftJoin('Institutos', 'sedeInstitutos.Institutos_id', '=', 'Institutos.id')
        ->leftJoin('users', 'sedeInstitutos.users_id', '=', 'users.id')
        ->select('Institutos.NombInstituto','sedeInstitutos.users_id')->get();

       
      return view ('nucleo.index',compact('nucleo'));
            
    }
/*
                public function Asignar()
    {   
        $nucleo=DB::table('sedeInstitutos')
        ->leftJoin('Institutos', 'sedeInstitutos.Institutos_id', '=', 'Institutos.id')
        ->leftJoin('users', 'sedeInstitutos.users_id', '=', 'users.id')
        ->select('Institutos.NombInstituto','sedeInstitutos.users_id')->get();

        
      return view ('nucleo.index',compact('nucleo'));
            
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id) 
    {
         $user=DB::table('users')->where('users.id', '=', $id)
        ->leftJoin('sede', 'users.sede_id', '=', 'sede.id_sede')
       // ->leftJoin('tipo_admision', 'users.Id_Tipo', '=', 'tipo_admision.id_tipo')
     
        ->select('sede.NombSede','users.name', 'users.Apellidos','users.cedula','users.email','users.id','users.sede_id')
        ->first();
         //$sed=$user->sede_id;
        $sed = Sede::orderBy('NombSede','ASC')->pluck('NombSede','id_sede');

        return view('users.AsignarNucleos',compact('sedes','user','institutos','sed')); 
    }


    public function store(Request $request)

    { 
 

        $rules = [
            'sede_id' => 'required',
            'name' => 'required|max:20|alpha',
            'nucleos' => 'required',
           // 'Apellidos' => 'required|max:20|alpha',
            'cedula' =>  'required|numeric|unique:users|digits_between:7,8',
            
            
        ];

        $messages = [
            'sede_id.required' => 'Este campo es Obligatorio.',
            'name.required' => 'Este campo es Obligatorio.',
            'nucleos.required' => 'Este campo es Obligatorio.',
           // 'Apellidos.required' => 'Este campo es Obligatorio.',
           'cedula.required' => 'Este campo es Obligatorio.',
                
             ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->action('AgsinarNucleoController@create')
                ->withErrors($validator)->withInput();
        }

         $user=User::first();
          /*DB::table('users')->where('users.id', '=', $id)
        ->leftJoin('sede', 'users.sede_id', '=', 'sede.id_sede')
       // ->leftJoin('tipo_admision', 'users.Id_Tipo', '=', 'tipo_admision.id_tipo')
        ->leftJoin('rols', 'users.rols_id', '=', 'rols.id_rols')
        ->select('sede.NombSede','rols.descripcion','users.name', 'users.Apellidos','users.cedula','users.email','users.id','users.sede_id')
        ->first();*/
        // dd($user);
        $id= $user->id; 
       // $rol=$user->rols_id;
       // dd($id);
        $data = array(
            $request->input('sede_id') => $request->input('nucleos')

          
        ); 

          //jajaja casi lo logro logre guardar el id del ultimo registro del usuario pero no es ese el que necesitamos :S
        //$user=User::select('id')->orderby('id','ACS')->first();

       //dd($user);
        foreach ($data as $key => $value) {
            // dd($key);      
                                     
            foreach ($value as $instituto){
             //dd($value);
            $datosSocio = new sedeInstitutos;
            $datosSocio->sede_id = $key;
            $datosSocio->users_id= $user->id;
            //$datosSocio->rols_id= $user->rols_id;
            $datosSocio->Institutos_id = $instituto;
            $datosSocio->save();
        }
       };


       Alert::success( 'Nucleos Agregados con éxito')->autoclose(3500);
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
         $user= DB::table('users')->where('users.id', '=', $id)
        ->leftJoin('sede', 'users.sede_id', '=', 'sede.id_sede')
       // ->leftJoin('tipo_admision', 'users.Id_Tipo', '=', 'tipo_admision.id_tipo')
        
        ->select('sede.NombSede','users.name', 'users.Apellidos','users.cedula','users.email','users.id','users.sede_id')
        ->first();


        $sede=DB::table('sedeInstitutos')->where('sedeInstitutos.user_id', '=', $id)
        
        ->leftJoin('sede', 'sedeInstitutos.sede_id', '=', 'sede.id_sede')
        ->distinct('sedeInstitutos.sede_id')
     
        ->leftJoin('users', 'sedeInstitutos.user_id', '=', 'users.id')
       
        ->select('sede.NombSede','sedeInstitutos.user_id','sedeInstitutos.sede_id')->get($id);
       
        // dd($sede);
        $nucleo=DB::table('sedeInstitutos')->where('sedeInstitutos.user_id', '=', $id)
        ->leftJoin('Institutos', 'sedeInstitutos.Institutos_id', '=', 'Institutos.id')
        ->leftJoin('users', 'sedeInstitutos.user_id', '=', 'users.id')
        ->select('Institutos.NombInstituto','sedeInstitutos.user_id','sedeInstitutos.id')->get($id);
    

         return view('users.show', compact('user','nucleos','nucleo','sede'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $user=DB::table('users')->where('users.id', '=', $id)
        ->leftJoin('sede', 'users.sede_id', '=', 'sede.id_sede')
       // ->leftJoin('tipo_admision', 'users.Id_Tipo', '=', 'tipo_admision.id_tipo')
       
        ->select('sede.NombSede','users.name', 'users.Apellidos','users.cedula','users.email','users.id','users.sede_id')
        ->first();
     
       $sed=Sede::where('id_sede',$user->sede_id)->get();
        return view('users.AsignarNucleos',compact('sedes','user','institutos','sed'));
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
            'sede_id' => 'required',
            'nucleos' => 'required',
         //  'nucleos' => 'required',
           // 'rols_id' => 'required',
            //'name' => 'required',
            'cedula' =>  'nullable|numeric|digits_between:7,8',
            //'email' => 'nullable|string|email|max:255|unique:users',
          //  'password' => 'required|string|min:6|confirmed',
            
        ];

        $messages = [
            'sede_id.required' => 'Este campo es Obligatorio.',
            'nucleos.required' => 'Este campo es Obligatorio.',
           // 'nucleos.required' => 'Este campo es Obligatorio.',
          // 'rols_id.required' => 'Este campo es Obligatorio.',
         //   'name.required' => 'Este campo es Obligatorio.',
            'cedula.required' => 'Este campo es Obligatorio.',
            //'email.required' => 'Este campo es Obligatorio.',
           // 'email.required' => 'Este campo es Obligatorio.',
           // 'password.required' => 'Este campo es Obligatorio.',
           
            


        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->action('AgsinarNucleoController@edit',$id)
                ->withErrors($validator)->withInput();
        }

         $user =User::find($id);
      //  $user->Id_Tipo  = $request->Id_Tipo;
        //$user->name     = $request->name;
       // $user->Apellidos = $request->Apellidos;
       // $user->email    = $request->email;
       // $user->sede_id  = $request->sede_id;
      //  $user->rols_id  = $request->rols_id;
        //$user->cedula   = $request->cedula;
       //$user->password =  bcrypt($request->password);
        //$user->remember_token = str_random(100);

       // $user->update();
       //dd($user->id);

         $data = array(
            $request->input('sede_id') => $request->input('nucleos')

          
        ); 

          //jajaja casi lo logro logre guardar el id del ultimo registro del usuario pero no es ese el que necesitamos :S
        //$user=User::select('id')->orderby('id','ACS')->first();

       //dd($user);
        foreach ($data as $key => $value) {
            // dd($value);      
                                     
            foreach ($value as $instituto){
            
            $datosSocio = new sedeInstitutos;
            $datosSocio->sede_id = $key;
             $datosSocio->user_id= $user->id;
            $datosSocio->Institutos_id = $instituto;
            $datosSocio->save();
        }
       };


       Alert::success( 'Nucleos Agregados con éxito')->autoclose(3500);
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $nu = sedeInstitutos::findOrFail($id);
        $nu->delete(); 
        Alert::success( 'Núcleo Eliminado con éxito')->autoclose(3500);
        return back();
    }
}