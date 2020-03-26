<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Caffeinated\Shinobi\Models\Role;
use App\Sede;
use App\Rols;
use App\InstitutoUser;
use App\sedeInstitutos;

use Illuminate\Foundation\Auth\RegistersUsers;
use Alert;
class UserController extends Controller
{
    
   // private $x;
   public function __construct()

   {

    $this->middleware('permission:users.index')->only('index');
		
   $this->middleware('permission:users.create')->only(['create','store']);	

   $this->middleware('permission:users.edit')->only(['edit','update']);

   $this->middleware('permission:users.show')->only('show');

   $this->middleware('permission:users.destroy')->only('destroy');

   }

     public function getsede($id)
        {
           return Sede::where('sede_id',$id)->get();//pluck("NombSede","id");
             //json_encode($sedes);
        }

         public function getnucleos(Request $request)
        {
          $nucleo = InstitutoUser::where('sede_id',$request->valor)->get();
          
            return response()->json($nucleo);



           /* $especialidades =DB::table('sede_especialidads')->where('sede_especialidads.sede_id','=',$id)
            ->leftJoin('Especialidad', 'Especialidad.Id', '=', 'sede_especialidads.Especialidad_Id')
            ->pluck("Especialidad.NombEspecialidad","Especialidad.Id");
            return json_encode($especialidades);*/
        }


    public function index()
    {                
      $id_user=\Auth::user()->id;

      $users = User::withCount(['institutos'])->orderby('id','ASC')
                    ->with(['rols'])
                    ->with(['sede'])
                    //->where('id', '>=', 3)
                    
                    ->paginate(4);
 
  // dd($users);
    $role =DB::table('role_user')//->where('role_user.users_id','=',$id_user)
     ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
      ->select('roles.name')->get();
  
        return view('users.index',compact('users','nucleo','role','Datosboton'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
         $idusuario = Auth::user()->id;
        if($idusuario = 1){ 
       // $sedes= DB::table('sede')->get();
        $institutos = DB::table('Institutos')->get();
        $roli= DB::table('roles')->where('id', '>=', 3)->orderBy('name','ASC')->pluck('name','id');
        $rols= DB::table('roles')->orderBy('name','ASC')->pluck('name','id');
       // dd($roli);
        
        $sed = Sede::orderBy('NombSede','ASC')->pluck('NombSede','id_sede');
      
      //  $tipos= DB::table('tipo_admision')->get();
    return view('users.create',compact('sedes','roli','rols','institutos','sed')); 
        } 
        else
        {
            return view ('vendor.errors.404');
        }
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
            'sede_id' => 'required',
            'name' => 'required|max:20|regex:/^[\pL\s\-]+$/u',
         //  'nucleos' => 'required',
           // 'rols_id' => 'required',
            'Apellidos' => 'required|max:20|regex:/^[\pL\s\-]+$/u',
            'cedula' =>  'required|numeric|unique:users|digits_between:7,8',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            
        ];

        $messages = [
            'sede_id.required' => 'Este campo es Obligatorio.',
            'name.required' => 'Este campo es Obligatorio.',
           // 'nucleos.required' => 'Este campo es Obligatorio.',
            //'rols_id.required' => 'Este campo es Obligatorio.',
            'Apellidos.required' => 'Este campo es Obligatorio.',
            'cedula.required' => 'Este campo es Obligatorio.',
            'email.required' => 'Este campo es Obligatorio.',
            'email.required' => 'Este campo es Obligatorio.',
            'password.required' => 'Este campo es Obligatorio.',
           
            


        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->action('UserController@create')
                ->withErrors($validator)->withInput();
        }

     
       
        foreach ($data as $key => $value) {
       
          foreach ($value as $rol){
           //dd($rol);
          $user = new  User(request()->all());
         // 
          $user->password =bcrypt($request->password);
          $user->role_id = $rol;
          $user->save($request->all());
          $user->roles()->sync($request->get('roles'));
         
  
  
        }
         };

       Alert::success( 'Usuario creado con éxito')->autoclose(3500);
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

       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
   
        $user = User::with('roles')->findOrFail($id);
      
        
        $roles = Role::query()
                    ->orderBy('name')
                    ->get();
        $sed = DB::table('sede')->orderby('NombSede','ASC')->pluck('NombSede','id_sede');
      
      //  $tipos= DB::table('tipo_admision')->get();
    return view('users.edit',compact('usuarios','roles','user','sed')); 
        
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
            'name' => 'required|max:20|regex:/^[\pL\s\-]+$/u',
         //  'nucleos' => 'required',
          //  'rols_id' => 'required',
            'Apellidos' => 'required|max:20|regex:/^[\pL\s\-]+$/u',
             'cedula' => 'required|numeric|digits_between:7,8',
            //'cedula' =>  'required|unique:users,cedula,id,' . $request->get($id),
            'email' => 'nullable|string|email|max:255',
         //   'password' => 'required|string|min:6|confirmed',
            
        ];

        $messages = [
            'sede_id.required' => 'Este campo es Obligatorio.',
            'name.required' => 'Este campo es Obligatorio.',
           // 'nucleos.required' => 'Este campo es Obligatorio.',
           // 'rols_id.required' => 'Este campo es Obligatorio.',
            'Apellidos.required' => 'Este campo es Obligatorio.',
            'cedula.required' => 'Este campo es Obligatorio.',
            'email.required' => 'Este campo es Obligatorio.',
            'email.required' => 'Este campo es Obligatorio.',
           // 'password.required' => 'Este campo es Obligatorio.',
           
            


        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->action('UserController@edit',$id)
                ->withErrors($validator)->withInput();
        }


        $user =User::find($id);
    
      $user->update($request->all());
      $user->role_id =  $request->get('role'); 
      $user->syncRoles([$request->role]);
     // $user->roles()->sync($request->get('roles'));
       


       Alert::success( 'Usuario actualizados con éxito')->autoclose(3500);
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
      $user  = User::find($id);
           
      $user->delete(); 
  
   Alert::success('Usuario Eliminado con éxito')->autoclose(3500);

   return redirect()->route('users.index');
    }


    public function asignar()
    {
         $user=DB::table('users')
        ->leftJoin('sede', 'users.sede_id', '=', 'sede.id_sede')
       // ->leftJoin('tipo_admision', 'users.Id_Tipo', '=', 'tipo_admision.id_tipo')
       
        ->select('sede.NombSede','rols.descripcion','users.name', 'users.Apellidos','users.cedula','users.email','users.id','users.sede_id','users.rols_id')
        ->first();
         //$sed=$user->sede_id;
        $sed = Sede::orderBy('NombSede','ASC')->pluck('NombSede','id_sede');

        return view('users.AsignarNucleos',compact('sedes','user','institutos','sed')); 
    }


      public function guardar(Request $request)
    {
          $data = array(
            $request->input('sede_id') => $request->input('nucleos')

          
        ); 

        foreach ($data as $key => $value) {
               
                                     
            foreach ($value as $instituto){
       
            $datosSocio =sedeInstitutos::find($id);
            $datosSocio->sede_id = $key;
             $datosSocio->users_id= $user->id;
            $datosSocio->Institutos_id = $instituto;
            $datosSocio->save();
        }
       };


       Alert::success( 'Usuario actualizados con éxito')->autoclose(3500);
        return redirect()->route('Usuarios.index');
    }



}
