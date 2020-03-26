<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use App\ValorIndicardor;
use App\DetalleSocial;
use App\IndicadorSocial;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\DatosSocioEconomico;
use App\Http\Requests\SocioEconomicoFormRequest;
use Alert;
class SocioEconomicoController extends Controller
{
   // $socioEconomico = $this->obtenerExpeciencia();

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct(){

        $this->middleware('auth:UsuariosAspi');
    }
    

    public function index()
    {   
        $id_user=\Auth::user()->id;
        $primerafase=DB::table('DetalleSocial_has_indicadorSocial')->where('DetalleSocial_has_indicadorSocial.user_id', '=', $id_user)
        ->leftJoin('indicadorSocial', 'DetalleSocial_has_indicadorSocial.indicadorSocial_id', '=', 'indicadorSocial.id')
        ->leftJoin('DetalleSocial', 'DetalleSocial_has_indicadorSocial.DetalleSocial_id', '=', 'DetalleSocial.id')
        ->select('indicadorSocial.Nombreindicador','DetalleSocial.ContenidoSelect','DetalleSocial_has_indicadorSocial.id','DetalleSocial_has_indicadorSocial.indicadorSocial_id','DetalleSocial_has_indicadorSocial.DetalleSocial_id')->get($id_user);



        /*$user= DB::table('indicadorSocial')
       // ->leftJoin('indicadorSocial', 'DetalleSocial_has_indicadorSocial.indicadorSocial_id', '=', 'indicadorSocial.id')
       // ->leftJoin('tipo_admision', 'users.Id_Tipo', '=', 'tipo_admision.id_tipo')
        //->leftJoin('rols', 'users.rols_id', '=', 'rols.id_rols')
        ->select('indicadorSocial.id')
        ->first();*/

   $user=IndicadorSocial::whereIn('id', [1])->first();
        $id=$user->id;
       // dd($id);
      $id_user=\Auth::user()->id;
         $socio=DB::select('select *, DetalleSocial_has_indicadorSocial.id FROM DetalleSocial_has_indicadorSocial 
        INNER JOIN indicadorSocial ON DetalleSocial_has_indicadorSocial.indicadorSocial_id = indicadorSocial.id 
        INNER JOIN DetalleSocial ON DetalleSocial_has_indicadorSocial.DetalleSocial_id = DetalleSocial.id
         where DetalleSocial.indicadorSocial_id ='.$id.' and DetalleSocial_has_indicadorSocial.indicadorSocial_id ='.$id.' and user_id  ='.$id_user);//. 'and user_id  ='.$id_user);


         $padre=IndicadorSocial::whereIn('id', [2])->first();
        $idpadre=$padre->id;
      // dd($idpadre);


     
         $sociopadre=DB::select('select *, DetalleSocial_has_indicadorSocial.id FROM DetalleSocial_has_indicadorSocial 
        INNER JOIN indicadorSocial ON DetalleSocial_has_indicadorSocial.indicadorSocial_id = indicadorSocial.id 
        INNER JOIN DetalleSocial ON DetalleSocial_has_indicadorSocial.DetalleSocial_id = DetalleSocial.id
        where DetalleSocial_has_indicadorSocial.indicadorSocial_id ='.$idpadre.' and user_id  ='.$id_user);//. 'and user_id  ='.$id_user);
//dd($sociopadre);

         $fuenteingreso=IndicadorSocial::whereIn('id', [3])->first();
        $ingre=$fuenteingreso->id;
       // dd($id);


      
         $ingresos=DB::select('select *, DetalleSocial_has_indicadorSocial.id FROM DetalleSocial_has_indicadorSocial 
        INNER JOIN indicadorSocial ON DetalleSocial_has_indicadorSocial.indicadorSocial_id = indicadorSocial.id 
        INNER JOIN DetalleSocial ON DetalleSocial_has_indicadorSocial.DetalleSocial_id = DetalleSocial.id
         where DetalleSocial_has_indicadorSocial.indicadorSocial_id ='.$ingre.' and user_id  ='.$id_user);//. 'and user_id  ='.$id_user);



         $nivelingreso=IndicadorSocial::whereIn('id', [4])->first();
        $nivelingre=$nivelingreso->id;
       // dd($id);


      
         $Nivel_ingreso=DB::select('select *, DetalleSocial_has_indicadorSocial.id FROM DetalleSocial_has_indicadorSocial 
        INNER JOIN indicadorSocial ON DetalleSocial_has_indicadorSocial.indicadorSocial_id = indicadorSocial.id 
        INNER JOIN DetalleSocial ON DetalleSocial_has_indicadorSocial.DetalleSocial_id = DetalleSocial.id
         where DetalleSocial_has_indicadorSocial.indicadorSocial_id ='.$nivelingre.' and user_id  ='.$id_user);//. 'and user_id  ='.$id_user);



        $Condiciones=IndicadorSocial::whereIn('id', [5])->first();
        $alojamiento=$Condiciones->id;
       // dd($id);


         $Condiciones_alojamiento=DB::select('select *, DetalleSocial_has_indicadorSocial.id FROM DetalleSocial_has_indicadorSocial 
        INNER JOIN indicadorSocial ON DetalleSocial_has_indicadorSocial.indicadorSocial_id = indicadorSocial.id 
        INNER JOIN DetalleSocial ON DetalleSocial_has_indicadorSocial.DetalleSocial_id = DetalleSocial.id
        where DetalleSocial_has_indicadorSocial.indicadorSocial_id ='.$alojamiento.' and user_id  ='.$id_user);//. 'and user_id  ='.$id_user);


        $traslado=IndicadorSocial::whereIn('id', [6])->first();
        $tiempotraslado=$traslado->id;
       // dd($id);


    
         $Tiempo_Traslado=DB::select('select *, DetalleSocial_has_indicadorSocial.id FROM DetalleSocial_has_indicadorSocial 
        INNER JOIN indicadorSocial ON DetalleSocial_has_indicadorSocial.indicadorSocial_id = indicadorSocial.id 
        INNER JOIN DetalleSocial ON DetalleSocial_has_indicadorSocial.DetalleSocial_id = DetalleSocial.id
        where DetalleSocial_has_indicadorSocial.indicadorSocial_id ='.$tiempotraslado.' and user_id  ='.$id_user);//. 'and user_id  ='.$id_user);



$costeoPOs=IndicadorSocial::whereIn('id', [7])->first();
        $costeo=$costeoPOs->id;
       // dd($id);


     
         $Costeo_Postgrado=DB::select('select *, DetalleSocial_has_indicadorSocial.id FROM DetalleSocial_has_indicadorSocial 
        INNER JOIN indicadorSocial ON DetalleSocial_has_indicadorSocial.indicadorSocial_id = indicadorSocial.id 
        INNER JOIN DetalleSocial ON DetalleSocial_has_indicadorSocial.DetalleSocial_id = DetalleSocial.id
        where DetalleSocial_has_indicadorSocial.indicadorSocial_id ='.$costeo.' and user_id  ='.$id_user);//. 'and user_id  ='.$id_user);


$hijos=IndicadorSocial::whereIn('id', [8])->first();
        $numhijos=$hijos->id;
       // dd($id);


     
         $Numero_hijos=DB::select('select *, DetalleSocial_has_indicadorSocial.id FROM DetalleSocial_has_indicadorSocial 
        INNER JOIN indicadorSocial ON DetalleSocial_has_indicadorSocial.indicadorSocial_id = indicadorSocial.id 
        INNER JOIN DetalleSocial ON DetalleSocial_has_indicadorSocial.DetalleSocial_id = DetalleSocial.id
         where DetalleSocial_has_indicadorSocial.indicadorSocial_id ='.$numhijos.' and user_id  ='.$id_user);//. 'and user_id  ='.$id_user)

//dd($socio);


  $daso=DB::table('DatosSocioEconomico')->where('DatosSocioEconomico.user_id', '=', $id_user)
        
        ->select('DatosSocioEconomico.TiempoPost','DatosSocioEconomico.CantDineroPost','DatosSocioEconomico.Posee_Computador','DatosSocioEconomico.Posee_internet','DatosSocioEconomico.TiempoInternet','DatosSocioEconomico.id')->get($id_user);

       /*   $daso =DB::select('select *, DatosSocioEconomico.id FROM DatosSocioEconomico 
         where user_id ='.$id_user); */
        
            

          //Indicadores de SocioEconomico
        $Madre       = IndicadorSocial::first();
        $deta=$Madre->id;

           $fuente     = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '3')->first();
          $fuenteingre=$fuente->id;


            $nivelingre     = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '4')->first();
             $ingrenivel=$nivelingre->id;

            $condiciones     = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '5')->first();
            $condicionaloja=$condiciones->id;

            $traslado     = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '6')->first();
            $tiempotraslos=$traslado->id;

            $Costeopost     = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '7')->first();
            $costeo=$Costeopost->id;

            $hijos     = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '8')->first();
            $Nunhijos=$hijos->id;
 //dd($hijos);

 $indicadorsocial       = IndicadorSocial::whereIn('id', [1])->pluck('Nombreindicador', 'id');
      
 $indicadorPadre        = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '2')
     ->get();
    // dd($indicadorPadre);
 $indicadorfamilia1     = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '3')
     ->get();
 $indicadorfamilia2     = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '4')
     ->get();
 $indicadorAlojamientoF = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '5')
     ->get();
 $indicadortraslado     = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '6')
     ->get();
 $indicadorCosteo       = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '7')
     ->get();
 $indicadorhijos        = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '8')
     ->get();
  $indicadorTiempo      = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '9')
     ->get();
  
          

  $detallesocial=DB::table('DetalleSocial')->where('DetalleSocial.indicadorSocial_id', '=', $deta)->pluck('ContenidoSelect', 'id');

  $detallesocialfamilia2 = DB::table('DetalleSocial')->where('DetalleSocial.indicadorSocial_id', '=', $ingrenivel)->pluck('ContenidoSelect', 'id');
//dd($detallesocialfamilia1);
        $detallesocialfamilia1 =DB::table('DetalleSocial')->where('DetalleSocial.indicadorSocial_id', '=', $fuenteingre)->pluck('ContenidoSelect', 'id');

        $detallesocialAlojamientoF = DB::table('DetalleSocial')->where('DetalleSocial.indicadorSocial_id', '=', $condicionaloja)->pluck('ContenidoSelect', 'id');
       
       $detallesocialtraslado     = DB::table('DetalleSocial')->where('DetalleSocial.indicadorSocial_id', '=', $tiempotraslos)->pluck('ContenidoSelect', 'id');
       
        $detallesocialCosteoPost   = DB::table('DetalleSocial')->where('DetalleSocial.indicadorSocial_id', '=', $costeo)->pluck('ContenidoSelect', 'id');
        
        $detallesocialhijos        = DB::table('DetalleSocial')->where('DetalleSocial.indicadorSocial_id', '=', $Nunhijos)->pluck('ContenidoSelect', 'id');
        
         return view('Aspidatos.socioE',compact('primerafase','socio','daso','sociopadre','ingresos','Nivel_ingreso','Condiciones_alojamiento','Tiempo_Traslado','Costeo_Postgrado','Numero_hijos','indicadorsocial','indicadorPadre','indicadorfamilia1','indicadorfamilia2','indicadorAlojamientoF','indicadortraslado','indicadorCosteo','indicadorhijos','indicadorTiempo','indicadorCantidad','indicadorComputador','indicadorInternet','TiempoInternet','detallesocial','detallesocialfamilia1','detallesocialfamilia2','detallesocialAlojamientoF','detallesocialtraslado','detallesocialCosteoPost','detallesocialhijos'));

    }

   
    public function create()
    {
            $indicadoMadre  = DB::table('DetalleSocial')
            ->join('DetalleSocial_has_indicadorSocial', 'DetalleSocial.id', '=', 'DetalleSocial_has_indicadorSocial.DetalleSocial_id')
            ->join('indicadorSocial', 'indicadorSocial.id', '=', 'DetalleSocial_has_indicadorSocial.indicadorSocial_id')
            ->get();
        $detallesocial=DetalleSocial::whereIn('id', [1, 2, 3 ,4, 5])->pluck('ContenidoSelect', 'id');
           
        $detallesocialfamilia1 = DetalleSocial::whereIn('id', [6, 7, 8 ,9, 10])->pluck('ContenidoSelect', 'id');

        $detallesocialfamilia2 =DetalleSocial::whereIn('id', [11, 12, 13 ,14, 15])->pluck('ContenidoSelect', 'id');

        $detallesocialAlojamientoF = DetalleSocial::whereIn('id', [16, 17, 18 ,19, 20])->pluck('ContenidoSelect', 'id');
       
       $detallesocialtraslado     = DetalleSocial::whereIn('id', [21, 22, 23 ,24, 25])->pluck('ContenidoSelect', 'id');
       
        $detallesocialCosteoPost   = DetalleSocial::whereIn('id', [26, 27, 28 ,29, 30])->pluck('ContenidoSelect', 'id');
        
        $detallesocialhijos        = DetalleSocial::whereIn('id', [31, 32, 33 ,34, 35,36])->pluck('ContenidoSelect', 'id');


        //Indicadores de SocioEconomico
        $indicadorsocial       = IndicadorSocial::whereIn('id', [1])->pluck('Nombreindicador', 'id');
      
        $indicadorPadre        = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '2')
            ->get();
            
        $indicadorfamilia1     = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '3')
            ->get();
        $indicadorfamilia2     = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '4')
            ->get();
        $indicadorAlojamientoF = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '5')
            ->get();
        $indicadortraslado     = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '6')
            ->get();
        $indicadorCosteo       = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '7')
            ->get();
        $indicadorhijos        = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '8')
            ->get();
         $indicadorTiempo      = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '9')
            ->get();
         $indicadorCantidad  = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '10')
            ->get();
      $indicadorComputador        = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '11')
            ->get();
      $indicadorInternet        = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '12')
            ->get();
      $TiempoInternet        = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '13')
            ->get();
        // $indicadoMadre=ValorIndicardor::get();

        return view('Aspidatos.socioEconomico',compact('indicadoMadre', 'detallesocial', 'indicadorsocial', 'indicadorPadre', 'indicadorfamilia1', 'detallesocialfamilia1', 'indicadorfamilia2', 'detallesocialfamilia2', 'indicadorAlojamientoF', 'detallesocialAlojamientoF', 'indicadortraslado', 'detallesocialtraslado', 'indicadorCosteo', 'detallesocialCosteoPost', 'indicadorhijos', 'detallesocialhijos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'Nivel_madre' => 'required|integer',
            'Nivel_padre' => 'required|integer',
            'Fuente_ingreso' => 'required|integer',
            'Nivel_ingreso' => 'required|integer',
            'Condiciones_alojamiento' => 'required|integer',
            'Tiempo_Traslado' => 'required|integer',
            'Costeo_Postgrado' => 'required|integer',
            'Numero_hijos' => 'required|integer',
             'TiempoPost' => 'required',
            'CantDineroPost' => 'required',
            'TiempoInternet' => 'required',
            'Posee_Computador' => 'required|alpha',
            'Posee_internet' => 'required|alpha',
        ];

        $messages = [
            'Nivel_madre.required' => 'El nivel de instrucción de la madre es requerido.',
            'Nivel_padre.required' => 'El nivel de instrucción del padre es requerido.',
            'Fuente_ingreso.required' => 'La fuente de ingreso de la familia es requerida.',
            'Nivel_ingreso.required' => 'El nivel de ingreso de la familia es requerido.',
            'Condiciones_alojamiento.required' => 'Las condiciones de alojamiento son requeridas',
            'Tiempo_Traslado.required' => 'El tiempo de traslado es requerido',
            'Costeo_Postgrado.required' => 'El costeo del posgrado es requerido',
            'Numero_hijos.required' => 'EL número de hijos es requerido',
            'TiempoPost.required' => 'Este campo  es requerido.',
            'CantDineroPost.required' => 'Este campo es requerido',
            'TiempoInternet.required' => 'Este campo  es requerido',
            'Posee_Computador.required' => 'Este campo  es requerido',
            'Posee_internet.required' => 'Este campo es requerido',
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->action('SocioEconomicoController@create')
                ->withErrors($validator)
                ->withInput();
        }

        $indicadorsocial       = IndicadorSocial::whereIn('id', [1])->pluck('Nombreindicador', 'id');
      
        $indicadorPadre        = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '2')
            ->get();
           // dd($indicadorPadre);
        $indicadorfamilia1     = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '3')
            ->get();
        $indicadorfamilia2     = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '4')
            ->get();
        $indicadorAlojamientoF = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '5')
            ->get();
        $indicadortraslado     = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '6')
            ->get();
        $indicadorCosteo       = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '7')
            ->get();
        $indicadorhijos        = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '8')
            ->get();
         $indicadorTiempo      = DB::table('indicadorSocial')->where('indicadorSocial.id', '=', '9')
            ->get();

        $data = array(
            $request->input('level_mother_id') => $request->input('Nivel_madre'),
            $request->input('level_father_id') => $request->input('Nivel_padre'),
            $request->input('family_income_id') => $request->input('Fuente_ingreso'),
            $request->input('level_family_income_id') => $request->input('Nivel_ingreso'),
            $request->input('family_accommodation_id') => $request->input('Condiciones_alojamiento'),
            $request->input('transfer_time_id') => $request->input('Tiempo_Traslado'),
            $request->input('graduate_cost_id') => $request->input('Costeo_Postgrado'),
            $request->input('number_of_children_id') => $request->input('Numero_hijos'),
          
            
              //$request->input('TiempoPostgrado') => $request->input('TiempoPost'),
            //$request->input('DineroPost') => $request->input('CantDineroPost'),
            //$request->input('INternet') => $request->input('TiempoInternet'),
            //$request->input('Posee_Computadora') => $request->input('Posee_Computador'),
            //$request->input('Posees_internet') => $request->input('Posee_internet'),
           
        );
        
        
        //dd($data);
        $id_user=\Auth::user()->id;
            
         
         $Dato =DB::select('SELECT AspPregrado.id FROM AspPregrado , UsuariosAspi where   UsuariosAspi.id=user_id and    UsuariosAspi.id ='.$id_user);
           
       /*if($Dato <= [0]) {
           
    alert()->error('error','Primero debe de llenar sus Datos Personales para continuar.')->autoclose(2500);
           
           return redirect()->route('DatosAcademicos.index')->withInput();
           // lo rediriges a la página que quieras
       }*/
       $activo = "1";
       $per= DB::table('Periodo')
       ->where('Periodo.Vigente', '=',$activo)->first();
      $idperiodo=$per->id;
       //dd($idperiodo);

        $user = Auth::user();
        foreach ($data as $key => $value) {
          // dd($key);
            $datosSocio                     = new ValorIndicardor;
            $datosSocio->indicadorSocial_id = $key;
            $datosSocio->user_id           = $user->id;
            $datosSocio->DetalleSocial_id   = $value;
            $datosSocio->AspPregrado_id = $Dato[0]->id;
            $datosSocio->Periodo_id=$idperiodo;
            $datosSocio->save();
        }
        
        

        $SegundosDATOSOCIO= new DatosSocioEconomico(request()->all());
        $SegundosDATOSOCIO->user_id= \Auth::user()->id;
        $SegundosDATOSOCIO->AspPregrado_id = $Dato[0]->id;
        $SegundosDATOSOCIO->Periodo_id=$idperiodo;
        $SegundosDATOSOCIO->save();
         \Auth::user()->update([
        'datos_socioEconomico' => 1,
       ]);
        alert()->success(' ', 'Su datos fueron guardado correctamente')->autoclose(2500);
        return redirect()->route('SocioEconomico.index');
        

    }//end function

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
      {        
        
        
       // $data=ValorIndicardor::findOrFail($id);
       $SegundosDATOSOCIO=DatosSocioEconomico::findOrFail($id);
    

       


        return view('Aspidatos.editSocioE',compact('edit','sociopadre','SegundosDATOSOCIO', 'detallesocial', 'indicadorsocial',
         'indicadorPadre', 'indicadorfamilia1', 'detallesocialfamilia1', 'indicadorfamilia2', 'detallesocialfamilia2',
          'indicadorAlojamientoF', 'detallesocialAlojamientoF', 'indicadortraslado', 'detallesocialtraslado', 'indicadorCosteo', 'detallesocialCosteoPost', 'indicadorhijos', 'detallesocialhijos'));
    }






    public function update(Request $request, $id)
    {

         $rules = [
           
             //'TiempoPost' => 'required',
            'CantDineroPost' => 'numeric|required',
           // 'TiempoInternet' => 'required',
            'Posee_Computador' => 'required|alpha',
            'Posee_internet' => 'required|alpha',
        ];

        $messages = [
            
            //'TiempoPost.required' => 'Este campo  es requerido.',
            'CantDineroPost.required' => 'Este campo es requerido',
            //'TiempoInternet.required' => 'Este campo  es requerido',
            'Posee_Computador.required' => 'Este campo  es requerido',
            'Posee_internet.required' => 'Este campo es requerido',
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->action('SocioEconomicoController@edit',$id)
                ->withErrors($validator)
                ->withInput();
        }


          $SegundosDATOSOCIO= DatosSocioEconomico::findOrFail($id);
           
          // Si existe
        //  if(count($SegundosDATOSOCIO)>=1){
             // Seteamos un nuevo titulo
            $SegundosDATOSOCIO->TiempoPost = $request->get('TiempoPost');
               $SegundosDATOSOCIO->CantDineroPost = $request->get('CantDineroPost');
               $SegundosDATOSOCIO->Posee_Computador = $request->get('Posee_Computador');
               $SegundosDATOSOCIO->Posee_internet = $request->get('Posee_internet');
               $SegundosDATOSOCIO->TiempoInternet = $request->get('TiempoInternet');
            $SegundosDATOSOCIO->update();
            alert()->success(' ', 'Sus datos fueron actualizados correctamente')->autoclose(2500);
            return redirect()->route('SocioEconomico.index');
             // Guardamos en base de datos
             
         // }
         // else{
        
       
          
     // }
        
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

          public function getEditMadre(Request $request, $id)
            {        
              
              
              $edit=ValorIndicardor::findOrFail($id);

                
                $indicadorsocial       = IndicadorSocial::whereIn('id', [1])->pluck('Nombreindicador', 'id');
               
           

              $detallesocial=DetalleSocial::whereIn('id', [1, 2, 3 ,4, 5])->orderBy('ContenidoSelect', 'ASC')->pluck('ContenidoSelect', 'id');
             

              return view('Aspidatos.vistaEditM',compact('edit','detallesocial','detallesocialpadre','indicadorsocial','indicadorPadre','indicadorfamilia1','indicadorfamilia2',
                  'indicadorAlojamientoF','indicadortraslado','indicadorCosteo','indicadorhijos','detallesocialfamilia1','detallesocialfamilia2','detallesocialAlojamientoF','detallesocialtraslado','detallesocialCosteoPost',
                  'detallesocialhijos'))->withInput( 'Nivel_madre');
          }



          public function getEditUpdate(Request $request, $id)
            {        
              
               $datosSocio                     =  ValorIndicardor::findOrFail($id);
               $datosSocio->DetalleSocial_id   = $request->get('DetalleSocial_id');
               $datosSocio->update();
               alert()->success(' ', 'Su dato fue guardado correctamente')->autoclose(2500);
              return redirect()->route('SocioEconomico.index');
          }




     public function getEditPadre($padre)
      {        
        //dd($padre);
       
        $sociopadre=ValorIndicardor::findOrFail($padre);

          
        $indicadorPadre = IndicadorSocial::whereIn('id', [2])->pluck('Nombreindicador', 'id');

        
     

        $detallesocial=DetalleSocial::whereIn('id', [1, 2, 3 ,4, 5])->orderBy('ContenidoSelect', 'ASC')->pluck('ContenidoSelect', 'id');
     
         


        return view('Aspidatos.vistaPadreEdit',compact('sociopadre','detallesocial','indicadorPadre','indicadorsocial'));
    }


     public function getUpdatePadre(Request $request, $id)
      { 
         $sociopadre                     =  ValorIndicardor::findOrFail($id);
         $sociopadre->DetalleSocial_id   = $request->get('DetalleSocial_id');
         $sociopadre->update();
         alert()->success(' ', 'Su dato fue guardado correctamente')->autoclose(2500);
        return redirect()->route('SocioEconomico.index');
    }




       public function getEditFuenteI($id)
      {        
        //dd($padre);
       
        $fuenteingreso=ValorIndicardor::findOrFail($id);

          
        $fuente=IndicadorSocial::whereIn('id', [3])->pluck('Nombreindicador', 'id');

        
     

       $detallesocialfamilia1 = DetalleSocial::whereIn('id', [6, 7, 8 ,9, 10])->pluck('ContenidoSelect', 'id');
 
         


        return view('Aspidatos.vistaFuenteIn',compact('fuenteingreso','fuente','detallesocialfamilia1'));
    }


     public function getUpdateFuenteI(Request $request, $id)
      { 
         $fuenteingreso                     =  ValorIndicardor::findOrFail($id);
         $fuenteingreso->DetalleSocial_id   = $request->get('DetalleSocial_id');
         $fuenteingreso->update();
       alert()->success(' ', 'Su dato fue guardado correctamente')->autoclose(2500);
        return redirect()->route('SocioEconomico.index');
    }


      public function getEditNivelI($id)
      {        
        //dd($padre);
       
        $nivelingreso=ValorIndicardor::findOrFail($id);

          
        $Nivel=IndicadorSocial::whereIn('id', [4])->pluck('Nombreindicador', 'id');

        
     

      $Nivel_ingreso =DetalleSocial::whereIn('id', [11, 12, 13 ,14, 15])->pluck('ContenidoSelect', 'id');
         


        return view('Aspidatos.vistaNivelIngreso',compact('nivelingreso','Nivel','Nivel_ingreso'));
    }


     public function getUpdateNivelI(Request $request, $id)
      { 
         $nivelingreso                     =  ValorIndicardor::findOrFail($id);
         $nivelingreso->DetalleSocial_id   = $request->get('DetalleSocial_id');
         $nivelingreso->update();
       alert()->success(' ', 'Su dato fue guardado correctamente')->autoclose(2500);
        return redirect()->route('SocioEconomico.index');
    }


      public function getEditCondiciones($id)
      {        
        //dd($padre);
       
        $Condiciones_alojamiento=ValorIndicardor::findOrFail($id);

          
        $condiciones=IndicadorSocial::whereIn('id', [5])->pluck('Nombreindicador', 'id');


       $detallesocialAlojamientoF = DetalleSocial::whereIn('id', [16, 17, 18 ,19, 20])->pluck('ContenidoSelect', 'id');
 
         


        return view('Aspidatos.vistaCondiciones',compact('Condiciones_alojamiento','condiciones','detallesocialAlojamientoF'));
    }


     public function getUpdateCondiciones(Request $request, $id)
      { 
         $fuenteingreso                     =  ValorIndicardor::findOrFail($id);
         $fuenteingreso->DetalleSocial_id   = $request->get('DetalleSocial_id');
         $fuenteingreso->update();
       alert()->success(' ', 'Su dato fue guardado correctamente')->autoclose(2500);
        return redirect()->route('SocioEconomico.index');
    }



      public function getEditTraslado($id)
      {        
        //dd($padre);
       
        $Tiempo_Traslado=ValorIndicardor::findOrFail($id);

          
        $tiempo=IndicadorSocial::whereIn('id', [6])->pluck('Nombreindicador', 'id');

        
     

      $detallesocialtraslado     = DetalleSocial::whereIn('id', [21, 22, 23 ,24, 25])->pluck('ContenidoSelect', 'id');
 
         


        return view('Aspidatos.vistaTraslado',compact('Tiempo_Traslado','tiempo','detallesocialtraslado'));
    }


     public function getUpdateTraslado(Request $request, $id)
      { 
         $Tiempo_Traslado                     =  ValorIndicardor::findOrFail($id);
         $Tiempo_Traslado->DetalleSocial_id   = $request->get('DetalleSocial_id');
         $Tiempo_Traslado->update();
        alert()->success(' ', 'Su dato fue guardado correctamente')->autoclose(2500);
        return redirect()->route('SocioEconomico.index');
    }



      public function getEditCosteoPost($id)
      {        
        //dd($padre);
       
        $Costeo_Postgrado=ValorIndicardor::findOrFail($id);

          
        $costeoPOst=IndicadorSocial::whereIn('id', [7])->pluck('Nombreindicador', 'id');

        
     

      $detallesocialCosteoPost   = DetalleSocial::whereIn('id', [26, 27, 28 ,29, 30])->pluck('ContenidoSelect', 'id');
 
         


        return view('Aspidatos.vistaCosteoPost',compact('Costeo_Postgrado','costeoPOst','detallesocialCosteoPost'));
    }


     public function getUpdaCosteoPost(Request $request, $id)
      { 
         $Costeo_Postgrado                     =  ValorIndicardor::findOrFail($id);
         $Costeo_Postgrado->DetalleSocial_id   = $request->get('DetalleSocial_id');
         $Costeo_Postgrado->update();
       alert()->success(' ', 'Su dato fue guardado correctamente')->autoclose(2500);
        return redirect()->route('SocioEconomico.index');
    }



       public function getEditHijos($id)
      {        
        //dd($padre);
       
        $Hijos_num=ValorIndicardor::findOrFail($id);

          
        $hijos=IndicadorSocial::whereIn('id', [8])->pluck('Nombreindicador', 'id');

        
     

        $detallesocialhijos = DetalleSocial::whereIn('id', [31, 32, 33 ,34, 35,36])->pluck('ContenidoSelect', 'id');
 
         


        return view('Aspidatos.vistaHijos',compact('Hijos_num','hijos','detallesocialhijos'));
    }


     public function getUpdaHijos(Request $request, $id)
      { 
         $Hijos_num                     =  ValorIndicardor::findOrFail($id);
         $Hijos_num->DetalleSocial_id   = $request->get('DetalleSocial_id');
         $Hijos_num->update();
       alert()->success(' ', 'Su dato fue guardado correctamente')->autoclose(2500);
        return redirect()->route('SocioEconomico.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Datos=ValorIndicardor::findOrFail($id);        
        $Datos->delete();

        $eliminar=DatosSocioEconomico::findOrFail($id);
        $eliminar->delete();
        session()->flash('notif','Su Datos Fueron Eliminados Correctamente');
        return redirect()->route('SocioEconomico.index');
     }
}
