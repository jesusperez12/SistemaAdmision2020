<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Auth;
use Image;
class AvatarAspiranteController extends Controller
{
  //
  public function __construct(){

    $this->middleware('auth:UsuariosAspi');
}

public function profile(){
    return view('Aspidatos.profile', array('user' => Auth::user()) );
}

public function update_avatar(Request $request){

    // Handle the user upload of avatar
          $rules = ['avatar' => 'required|image|max:1024*1024*1',];
    $messages = [
        'avatar.required' => 'La imagen es requerida',
        'avatar.image' => 'Formato no permitido',
        'avatar.max' => 'El máximo permitido es 1 MB',
    ];
    $validator = Validator::make($request->all(), $rules, $messages);
    
    if ($validator->fails('avatar')){
        return redirect('Aspirante/Perfil')->withErrors($validator);
    }
    else{
        $avatar = $request->file('avatar');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(300, 300)->save( public_path('/dist/img/' . $filename ) );

        $user = Auth::user();
        $user->avatar = $filename;
        $user->save();
    }
    // Alert::success( 'Su imagen de perfil ha sido cambiada con éxito')->autoclose(2000);
   //  session()->flash('notification','Su imagen de perfil ha sido cambiada con éxito');
     return redirect('DatosAspirante')->with('notification', 'Su imagen de perfil ha sido cambiada con éxito');

}
}

