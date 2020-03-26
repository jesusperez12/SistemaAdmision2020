<?php

namespace App\Http\Controllers\Auth;

use App\UsuariosAspi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Alert;
use Mail;
class AspiranteRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    public function redirectTo(){

        // alert()->success('Bienvenido ', 'Tu registro se a guardado correctamente');
        alert()->info(' ', 'Tu registro se a guardado correctamente,
         debe entrar al correo registrado para activar la cuenta')->persistent('Close');
         // session()->flash('success','Tu registro se a guardado correctamente.');
           
           return 'Aspirante/login';
    }
  

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:UsuariosAspi');
    }

      public function showRegistrationForm()
    {
        alert()->info('Obligatorio ','Bienvenido!!! Ingrese su correo de gmail para 
        recuperar su contraseña, recuerde colocar la dirección de correo exacta  
        de lo contrario no podrá acceder al sistema'
        )->persistent('Close');
        return view('authAspirante.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:UsuariosAspi',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \SistemaAdmision\User
     */
   /* protected function create(array $data)
    {
        return UsuariosAspi::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }*/
    
    protected function create(array $data)
    {
        $data['confirmation_code'] = str_random(25);

        $user = UsuariosAspi::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'confirmation_code' => $data['confirmation_code']
        ]);

         Mail::send('emails.confirmation_code', $data, function($message) use ($data) {
        $message->to($data['email'], $data['name'])->subject('Por favor confirma tu correo');
         });

        return $user;


    }


    public function verify($code)
{
    $user = UsuariosAspi::where('confirmation_code', $code)->first();

    if (! $user)
        return redirect('/');

    $user->confirmed = true;
    $user->confirmation_code = true;
    $user->save();

     alert()->info(' ', 'Has confirmado correctamente tu correo!')->autoclose(3000);

    return redirect('Aspirante/login');//->session()->flash('notification', 'Has confirmado correctamente tu correo!');
}


}
