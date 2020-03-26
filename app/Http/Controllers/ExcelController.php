<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oferta;
use App\User;
use App\UsuariosAspi;
use App\DatosBasicos;
use App\Datosaspirante;
use App\Exports\UsersExport;
use Excel;
use DB;
use Carbon\Carbon;

class ExcelController extends Controller
{
    public function index(Request $request)
    {
    $NombInstituto  = $request->get('NombInstituto');
     
    $siaprob = "1";
    $consultas = Oferta::where('ofertas.Aprobacion', '=', $siaprob)
    
    ->leftJoin('ModoIngreso', 'ofertas.ModoIngreso_Id', '=', 'ModoIngreso.Id')
    ->leftJoin('Especialidad', 'ofertas.Especialidad_Id', '=', 'Especialidad.id')
    ->leftJoin('Institutos', 'ofertas.Institutos_id', '=', 'Institutos.id')
    ->select('ModoIngreso.ModoIngreso','Institutos.NombInstituto', 'Especialidad.NombEspecialidad',
    'ofertas.Aprobacion','ofertas.Cuposopsu','ofertas.nroresolucion','ofertas.id',
    'ofertas.created_at')
       ->NombInstituto($NombInstituto)
->get();


$sedeofertas=DB::table('ofertas')
->leftJoin('Institutos', 'ofertas.Institutos_id', '=', 'Institutos.id')
->orderBy('NombInstituto', 'DESC')->pluck('NombInstituto','NombInstituto');

  
    
    // return Excel::download(new UsersExport, 'users.xlsx');
 

   /* $consultas = DB::table('ofertas')->leftJoin('ModoIngreso', 'ofertas.ModoIngreso_Id', '=', 'ModoIngreso.Id')
    ->leftJoin('Institutos', 'ofertas.Institutos_id', '=', 'Institutos.id')
    ->leftJoin('Especialidad', 'ofertas.Especialidad_id', '=', 'Especialidad.id')
    ->select('ModoIngreso.ModoIngreso','Institutos.NombInstituto', 'Especialidad.NombEspecialidad',
    'ofertas.Aprobacion','ofertas.Cuposopsu','ofertas.ConvDeAr','ofertas.nroresolucion','ofertas.id',
    'ofertas.created_at')->get();*/
    return view('reporteChart.excel',compact('consultas','sedeofertas')); 
    
    
    
    /*  Excel::create('Laravel Excel', function($excel) {
        $excel->sheet('Excel sheet', function($sheet) {
            //otra opción -> $products = Product::select('name')->get();
           
       
            $users = User::select('name','Apellidos','Identificacion', 'email')->get();                
            
            $sheet->fromArray($users);
            $sheet->setOrientation('landscape');
            $sheet->setBorder('A1:F20', 'thin');
            $sheet->cells('A1:F1', function($cells)
            {
                $cells->setbackground('#000000');
                $cells->setFontColor('#ffffff');
                $cells->setAlignment('center');
                $cells->setValignment('middle');
                
               
            });
            
            
        });
    })->download('xlsx');*/
    $users = DB::table('users')
                    ->whereIn('id', [1, 2, 3])
                    ->get();
                

    }
    public function excel(Request $request)
    {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
     
    $NombInstituto  = $request->get('NombInstituto');
     
    $siaprob = "1";
        $customer_data = Oferta::where('ofertas.Aprobacion', '=', $siaprob)
        
        ->leftJoin('ModoIngreso', 'ofertas.ModoIngreso_Id', '=', 'ModoIngreso.Id')
        ->leftJoin('Especialidad', 'ofertas.Especialidad_Id', '=', 'Especialidad.id')
        ->leftJoin('Institutos', 'ofertas.Institutos_id', '=', 'Institutos.id')
        ->select('ModoIngreso.ModoIngreso','Institutos.NombInstituto', 'Especialidad.NombEspecialidad',
        'ofertas.Aprobacion','ofertas.Cuposopsu','ofertas.nroresolucion','ofertas.id',
        'ofertas.created_at')
        ->NombInstituto($NombInstituto)
        ->whereIn('ofertas.id',  $request->aprobacion)
    ->get();


     $customer_array[] = array('Extencion/Instituto', 
     'Modo de Ingreso','Especialidad','Cupos Upel',
     'Cupos Convenio');
     foreach($customer_data as $customer)
     {
        
        
      $customer_array[] = array(
       'Extencion/Instituto'    => $customer->NombInstituto,
       'Modo de Ingreso'  => $customer->ModoIngreso,
       'Especialidad'   => $customer->NombEspecialidad,
       'Cupos Upel'  => $customer->Cuposupel,
       'Cupos Convenio'   => $customer->ConvDeAr,
      
      );
      
     }
     //dd($customer_data);
     Excel::create('Customer Data', function($excel) use ($customer_array){
      $excel->setTitle('Customer Data');
  
      $excel->sheet('Customer Data', function($sheet) use ($customer_array){
     
       $sheet->fromArray($customer_array, null, 'A7', false, false);
       $sheet->setBorder('A7:F20', 'thin');
       $sheet->cells('A7:F7', function($cells)
       {
           $cells->setbackground('#000000');
           $cells->setFontColor('#ffffff');
           $cells->setAlignment('center');
           $cells->setValignment('middle');
           
          
       });

$sheet->mergeCells('A1:D1');
$sheet->row(1, array(
    'República Bolivariana de Venezuela'
  
));
$sheet->mergeCells('A2:E2');
$sheet->row(2, array(
    'Universidad Pedagógica Experimental Libertador'
  
));

$sheet->mergeCells('A3:E3');
$sheet->row(3, array(
    'Secretaria - Coordinación Nacional  de Admisión'
  
));
$sheet->mergeCells('C5:D5');
$sheet->row(5,['jsdgfsigsfjsdfiu']);
$sheet->cells('A5:F6', function($cells)
       {
           $cells->setbackground('#82a0ef');
           $cells->setFontColor('#ffffff');
           $cells->setAlignment('center');
           $cells->setValignment('middle');
          
          
       });

/*$sheet->setSize(array(
    'A5' => array(
        'width'     => 5,
        'height'    => 150
    )
));*/
$sheet->setWidth(array(
    'A'     =>  30,
    'B'     =>  15,
    'C'     =>  15,
    'D'     =>  15,
    'E'     =>  15,
));

#Agreg
         
    });
     })->download('xlsx');
    }

     /*   Excel::create('Laravel Excel', function($excel) {
            $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();
                $products = Oferta::all();                
                $sheet->fromArray($products);
                $sheet->setOrientation('landscape');
            });
        })->download('xlsx');*/

        public function ListAspRegis(Request $request)
    {
     $fecha = Carbon::now();
      $fechas= $fecha->format('d/m/Y h:i:s A');
      //  dd($fechas);

                $valor="1";

                 $NombInstituto  = $request->get('NombInstituto');
               
                 $NombEspecialidad  = $request->get('NombEspecialidad');

                 $sedeofertas=DB::table('DatosBasicos')
                 ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
                 ->select('Institutos.NombInstituto','DatosBasicos.id','DatosBasicos.created_at')
                 ->orderBy('NombInstituto', 'DESC')->pluck('NombInstituto','NombInstituto');

                  $especialidad=DB::table('DatosBasicos')
                 ->leftJoin('Especialidad', 'DatosBasicos.Especialidad_a_cursar1_id', '=', 'Especialidad.id')
                 ->select('Especialidad.NombEspecialidad','DatosBasicos.id','DatosBasicos.created_at')
                 ->orderBy('NombEspecialidad', 'DESC')->pluck('NombEspecialidad','NombEspecialidad');


              $datos=Datosaspirante::where('UsuariosAspi.datos_socioEconomico', '=', $valor)
                ->leftJoin('UsuariosAspi', 'AspPregrado.user_id', '=', 'UsuariosAspi.id')
                 
                ->leftJoin('DatosBasicos', 'DatosBasicos.AspPregrado_id', '=', 'AspPregrado.id') 
                ->leftJoin('Deposito', 'Deposito.AspPregrado_id', '=', 'AspPregrado.id')
                
                ->leftJoin('ModoIngreso', 'DatosBasicos.ModoIngreso_Id', '=', 'ModoIngreso.Id')
                ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
                ->leftJoin('Especialidad', 'DatosBasicos.Especialidad_a_cursar1_id', '=', 'Especialidad.id')
         ->select('AspPregrado.id','AspPregrado.Identificacion','AspPregrado.PrimerNombre','AspPregrado.SegundoNombre',
        'AspPregrado.PrimerApellido','AspPregrado.SegundoApellido',
        'AspPregrado.FechaNacimiento','AspPregrado.EstadoCivil','AspPregrado.Genero','AspPregrado.Direccion','AspPregrado.TelefonoMovil',
        'AspPregrado.TelefonoLocal','AspPregrado.TelefonOficina',
        'AspPregrado.Correo','DatosBasicos.Especialidad_a_cursar1_id','Especialidad.NombEspecialidad','Deposito.NumDeposito',
        'DatosBasicos.Institutos_id','Institutos.NombInstituto','DatosBasicos.ModoIngreso_Id','ModoIngreso.ModoIngreso')

                ->NombInstituto($NombInstituto)
                ->NombEspecialidad($NombEspecialidad)
                ->paginate(10);
                 
              //dd($datos);
                 
                 

      // dd($aspi);
         return view('reporteChart.registroAsp', compact('datos','sedeofertas','programas','especialidad'));
    }

    public function ListAspRegisExport(Request $request)
    {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
     
    $NombInstituto  = $request->get('NombInstituto');

               
    $NombEspecialidad  = $request->get('NombEspecialidad');
    $fecha = Carbon::now();
    $fechas= $fecha->format('d/m/Y h:i:s A');

    $valor="1";


//

    $datos=Datosaspirante::
    where('UsuariosAspi.datos_socioEconomico', '=', $valor)
 ->leftJoin('UsuariosAspi', 'AspPregrado.user_id', '=', 'UsuariosAspi.id')
    
   ->leftJoin('DatosBasicos', 'DatosBasicos.AspPregrado_id', '=', 'AspPregrado.id') 
   ->leftJoin('Deposito', 'Deposito.AspPregrado_id', '=', 'AspPregrado.id')
   ->leftJoin('Especialidad as a', 'DatosBasicos.Especialidad_a_cursar2_id', '=', 'a.id')
   ->leftJoin('Especialidad as b', 'DatosBasicos.Especialidad_a_cursar3_id', '=', 'b.id')
   ->leftJoin('ModoIngreso', 'DatosBasicos.ModoIngreso_Id', '=', 'ModoIngreso.Id')
   ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
  //->leftJoin('discapacidades as d', 'AspPregrado.discapacidad_id', '=', 'd.id')
   ->leftJoin('Especialidad', 'DatosBasicos.Especialidad_a_cursar1_id', '=', 'Especialidad.id')
->select('AspPregrado.id','AspPregrado.Identificacion','AspPregrado.PrimerNombre','AspPregrado.SegundoNombre',
'AspPregrado.PrimerApellido','AspPregrado.SegundoApellido',
'AspPregrado.FechaNacimiento','AspPregrado.EstadoCivil','AspPregrado.Genero','AspPregrado.Direccion','AspPregrado.TelefonoMovil',
'AspPregrado.TelefonoLocal','AspPregrado.TelefonOficina','AspPregrado.discapacidad_id',//'d.discapacidad as discapacid.',
'AspPregrado.Correo','DatosBasicos.Especialidad_a_cursar1_id','Especialidad.NombEspecialidad','Deposito.NumDeposito',
'DatosBasicos.Institutos_id','Institutos.NombInstituto','DatosBasicos.ModoIngreso_Id','ModoIngreso.ModoIngreso',
'a.CodEspecialidad as curso2','b.CodEspecialidad as curso3','ModoIngreso.CodModIngreso')

   ->NombInstituto($NombInstituto)


->NombEspecialidad($NombEspecialidad)

->whereIn('AspPregrado.id',  $request->aspirante)
   
       // ->discapacidad()
    //->find(12)->discapacidad();
    ->get();

$instiespe=Datosaspirante::
    where('UsuariosAspi.datos_socioEconomico', '=', $valor)
 ->leftJoin('UsuariosAspi', 'AspPregrado.user_id', '=', 'UsuariosAspi.id')
    
   ->leftJoin('DatosBasicos', 'DatosBasicos.AspPregrado_id', '=', 'AspPregrado.id') 
  
   ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
  //->leftJoin('discapacidades as d', 'AspPregrado.discapacidad_id', '=', 'd.id')
   ->leftJoin('Especialidad', 'DatosBasicos.Especialidad_a_cursar1_id', '=', 'Especialidad.id')

->select('DatosBasicos.Especialidad_a_cursar1_id','Especialidad.NombEspecialidad','DatosBasicos.Institutos_id','Institutos.NombInstituto')

 ->NombInstituto($NombInstituto)


->NombEspecialidad($NombEspecialidad)

   ->whereIn('AspPregrado.id',  $request->aspirante)
       // ->discapacidad()
    //->find(12)->discapacidad();
    ->first();
$idinstitutos=$instiespe->NombInstituto;
$idespecilidad=$instiespe->NombEspecialidad;

//dd($datos, $instiespe, $idinstitutos);

   /*echo $datos;
    die();*/
  //  dd($datos);
  
     $customer_array[] = array('Num','Identificacion','Deposito','Primer Apellido','Primer Nombre','Segundo Apellido','Segundo Nombre','Genero','Tipo de Aspirante','Tipo de Cupo','CodEsp2','CodEsp3','Correo','Telefono','Fecha Nacimiento','Estado Civil');
     foreach($datos as $user)
     {
        
         
      $customer_array[] = array(
        'Num' => $user->id,
        'Identificacion'  => $user->Identificacion,
        'Deposito'    => $user->NumDeposito,
        'Primer Apellido' => $user->PrimerApellido,
        'Primer Nombre' => $user->PrimerNombre,
        'Segundo Apellido' => $user->SegundoApellido,
        'Segundo Nombre' => $user->SegundoNombre,
        'Genero' => $user->Genero,
        'Tipo de Aspirante' => $user->ModoIngreso,
        'Tipo de Cupo'  => $user->CodModIngreso,
        'CodEsp2' => $user->curso2,
        'CodEsp3' => $user->curso3,
        'Correo'  => $user->Correo,
        'Telefono' => $user->TelefonoMovil,
        'Fecha Nacimiento'  => $user->FechaNacimiento,
        'Estado Civil' => $user->EstadoCivil,

       // 'Discapacidad'   => $user->discapacidad,
      
      );
   
      
     }


     //dd($customer_data);
     Excel::create('Aspirantes Upel', function($excel) use ($customer_array,$fechas,$idinstitutos, $idespecilidad){
      $excel->setTitle('Aspirantes Upel');
  
      $excel->sheet('Aspirantes Upel', function($sheet) use ($customer_array,$fechas,$idinstitutos, $idespecilidad){
     
// Append multiple rows
     // Append row after row 2
       $sheet->appendRow(5, array(
            'Fecha:', $fechas
        ));

        $sheet->appendRow(7, array(
             $idinstitutos
        ));

  $sheet->appendRow(10, array(
             $idespecilidad
        ));


       $sheet->fromArray($customer_array, null, 'A12', false, false);
      // $sheet->setBorder('A7:R'.count($customer_array) + 8, 'thin');
       $sheet->cells('A12:P12', function($cells)
       {
           $cells->setBorder('solid', 'none', 'none', 'solid');
           $cells->setbackground('#000000');
           $cells->setFontColor('#ffffff');
           $cells->setAlignment('center');
           $cells->setValignment('middle');
           $cells->setBorder(array(
    'top'   => array(
        'style' => 'solid'
    ),
));
          
       });

       $sheet->cells('A13:P'.(count($customer_array) + 11), function($cell) {

        // manipulate the cell
       //$cell->setBorder('solid', 'none', 'none', 'solid');
       // $cell->setbackground('#D5CFCE');
       
        
       $cell->setBorder('A13', 'thin', 'thin', 'thin');
    });



// Set borders with array



$sheet->mergeCells('A1:D1');
$sheet->row(1, array(
    'República Bolivariana de Venezuela'
  
));
$sheet->mergeCells('A2:E2');
$sheet->row(2, array(
    'Universidad Pedagógica Experimental Libertador'
  
));

$sheet->mergeCells('A3:E3');
$sheet->row(3, array(
    'Secretaria - Coordinación Nacional  de Admisión'
  
));


$sheet->mergeCells('A8:F8');
$sheet->row(9, array(
   
   'Listado de Aspirante Registrados en el Proceso de Admisión 2019'
));


/*$sheet->mergeCells('A4:C4');
$sheet->row(6, array(
   

));*/

// Set top, right, bottom, left cada lado de margen
//$sheet->setPageMargin(array(
 //   2.00, 2.00, 2.00, 2.00
//));

// Set all margins establecer todos los margenes
$sheet->setPageMargin(1.00);
#



$sheet->setHeight(array(//alto de la fila
    7     =>  15,
));




$sheet->setWidth(array(
    'A'     =>  5,
    'B'     =>  10,
    'C'     =>  10,
    'D'     =>  15,
    'E'     =>  10,
    'F'     =>  10,
    'G'     =>  10,
    'H'     =>  10,
    'I'     =>  10,
    'J'     =>  10,
    'K'     =>  10,
    'L'     =>  10,
    'M'     =>  10,
    'N'     =>  15,
    'O'     =>  12,
    'P'     =>  10, 
    'Q'     =>  10,
    'R'     =>  10,
));

#Agreg
         
    });
     })->download('xlsx');
    }




    public function AspPreinscritos(Request $request)//REPORTE NRO 2
    {
       // dd($id);
                $valor="1";
                //$activo = "1";
                 $NombInstituto  = $request->get('NombInstituto');
                 $NombEspecialidad  = $request->get('NombEspecialidad');
                 

                 $sedeofertas=DB::table('DatosBasicos')
                 ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
                 ->select('Institutos.NombInstituto','DatosBasicos.id','DatosBasicos.created_at')
                 ->orderBy('NombInstituto', 'DESC')->pluck('NombInstituto','NombInstituto');
                
                 $especialidad=DB::table('DatosBasicos')
                 ->leftJoin('Especialidad', 'DatosBasicos.Especialidad_a_cursar1_id', '=', 'Especialidad.id')
                  ->select('Especialidad.NombEspecialidad','DatosBasicos.id','DatosBasicos.created_at')
                 ->orderBy('NombEspecialidad', 'DESC')->pluck('NombEspecialidad','NombEspecialidad');
     

                 $per= DB::table('Periodo')
                 ->where('Periodo.Vigente', '=',$valor)->first();
                $idperiodo=$per->id; 

                 $Preinscritos=DatosBasicos::where('UsuariosAspi.datos_socioEconomico', '=', $valor)
                ->where('DatosBasicos.Periodo_id', '=', $idperiodo)
                ->leftJoin('UsuariosAspi', 'DatosBasicos.user_id', '=', 'UsuariosAspi.id')
                ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
                ->leftJoin('Especialidad', 'DatosBasicos.Especialidad_a_cursar1_id', '=', 'Especialidad.id')
                ->select(DB::raw('count(*) as total'),/* DB::raw('SUM(total) as m_total'),*/'DatosBasicos.Institutos_id','Especialidad.NombEspecialidad','Institutos.NombInstituto','Institutos.CodSede')
                ->groupby('DatosBasicos.Institutos_id','Institutos.NombInstituto','Institutos.CodSede','Especialidad.NombEspecialidad')
                ->NombInstituto($NombInstituto)
                ->NombEspecialidad($NombEspecialidad)           
                           
                    ->paginate(10);
       // dd($Preinscritos);


                 

      // dd($aspi);
         return view('reporteChart.preinscritos', compact('Preinscritos','sedeofertas','programas','especialidad'));
    }


    public function AspPreinscritosExport(Request $request)
    {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/

        $valor="1";

        $NombInstituto  = $request->get('NombInstituto');
      
        
        $per= DB::table('Periodo')
        ->where('Periodo.Vigente', '=',$valor)->first();
       $idperiodo=$per->id; 

        $sedeofertas=DB::table('DatosBasicos')
        ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
        ->select('Institutos.NombInstituto','DatosBasicos.id','DatosBasicos.created_at')
        ->orderBy('NombInstituto', 'DESC')->pluck('NombInstituto','NombInstituto');

        $Preinscritos=DatosBasicos::where('UsuariosAspi.datos_socioEconomico', '=', $valor)
        ->where('DatosBasicos.Periodo_id', '=', $idperiodo)
        ->leftJoin('UsuariosAspi', 'DatosBasicos.user_id', '=', 'UsuariosAspi.id')
        ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
        ->select(DB::raw('count(*) as total'),'DatosBasicos.Institutos_id','Institutos.NombInstituto','Institutos.CodSede')
        ->groupby('DatosBasicos.Institutos_id','Institutos.NombInstituto','Institutos.CodSede')
        ->NombInstituto($NombInstituto)       
                  
        ->whereIn('DatosBasicos.Institutos_id',  $request->preinscritos)
   
         ->get();

         $Total=DatosBasicos::where('UsuariosAspi.datos_socioEconomico', '=', $valor)
         ->where('DatosBasicos.Periodo_id', '=', $idperiodo)
        // ->where('DatosBasicos.Institutos_id', '=', $preinscritos)
         ->leftJoin('UsuariosAspi', 'DatosBasicos.user_id', '=', 'UsuariosAspi.id')
         ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
         ->select(DB::raw('count(*) as TOTAL'))
        // ->groupby('DatosBasicos.Institutos_id','Institutos.NombInstituto','Institutos.CodSede')
         ->NombInstituto($NombInstituto)       
                   
         ->whereIn('DatosBasicos.Institutos_id',  $request->preinscritos)
    
          ->get();

//dd($Total);
     $customer_array[] = array('Código','Institutos','Total');
     foreach($Preinscritos as $user)
     {
        
        
      $customer_array[] = array(
        'Codigo' => $user->CodSede,
        'Institutos' => $user->NombInstituto,
        'Total' => $user->total,
      );
     
     }
     $customer_array[] = array('','','TOTAL');

     foreach($Total as $totall)
     {
        
        
      $customer_array[] = array(
          '',
          '',
        'TOTAL' => $totall->TOTAL,
      );  
    }

     //dd($customer_data);
     Excel::create('TotalAspPre', function($excel) use ($customer_array){
      $excel->setTitle('TotalAspPre');

    $excel->setCreator('TOTAL ASPIRANTES PREINSCRITOS UPEL')
          ->setCompany('UPEL');
      $excel->setDescription('TOTAL ASPIRANTES PREINSCRITOS UPEL DESARROLLADO POR LOS INGENIEROS JESUS PEREZ, MIGUELINA GONZALEZ E HUMBERTO TOVAR');
           
      $excel->sheet('TotalAspPre', function($sheet) use ($customer_array){
     
       $sheet->fromArray($customer_array, null, 'A7', false, false);
      // $sheet->setBorder('A7:c20', 'thin');
       $sheet->cells('A7:c7', function($cells)
       {
           $cells->setBorder('solid', 'none', 'none', 'solid');
           $cells->setbackground('#000000');
           $cells->setFontColor('#ffffff');
           $cells->setAlignment('center');
           $cells->setValignment('middle');
           
           $cells->setBorder(array(
    'top'   => array(
        'style' => 'solid'
    ),
));
          
       });

 $sheet->cells('A7:C'.(count($customer_array) + 6), function($cell) {

        // manipulate the cell
       //$cell->setBorder('solid', 'none', 'none', 'solid');
       // $cell->setbackground('#D5CFCE');
       
        
       $cell->setBorder('A13', 'thin', 'thin', 'thin');
    });


// Set borders with array



$sheet->mergeCells('A1:D1');
$sheet->row(1, array(
    'República Bolivariana de Venezuela'
  
));
$sheet->mergeCells('A2:E2');
$sheet->row(2, array(
    'Universidad Pedagógica Experimental Libertador'
  
));

$sheet->mergeCells('A3:E3');
$sheet->row(3, array(
    'Secretaria - Coordinación Nacional  de Admisión'
  
));


$sheet->mergeCells('A5:F5');
$sheet->row(5, array(
   
   ' Total de Aspirantes Preinscritos'
));



// Sets all borders
//$sheet->setAllBorders('thin');

// Set border for cells
$sheet->setBorder('A9', 'thin');

// Set border for range
//$sheet->setBorder('A12:C7', 'thin');
// Font family
$sheet->setFontFamily('Arial');

// Font size
$sheet->setFontSize(12);

// Font bold LETRAS NEGRITAS
//$sheet->setFontBold(true);
#
$sheet->setPageMargin(1.00);

$sheet->setHeight(array(//alto de la fila
    7     =>  15,
));




$sheet->setWidth(array(
    'A'     =>  10,
    'B'     =>  35,
    'C'     =>  10,
    'D'     =>  15,
    'E'     =>  10,
    'F'     =>  10,
    'G'     =>  10,
    'H'     =>  10,
    'I'     =>  10,
    'J'     =>  10,
    'K'     =>  10,
    'L'     =>  10,
    'M'     =>  10,
    'N'     =>  10,
    'O'     =>  10,
    'P'     =>  10, 
    'Q'     =>  10,
    'R'     =>  10,
));

#Agreg
         
    });
     })->download('xlsx');
    }


    public function AspRegisDisca(Request $request)
    {
       // dd($id);
                $valor="1";
                //$activo = "1";
                 $NombInstituto  = $request->get('NombInstituto');
                 $NombEspecialidad  = $request->get('NombEspecialidad');
                 

                 $sedeofertas=DB::table('DatosBasicos')
                 ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
                 ->select('Institutos.NombInstituto','DatosBasicos.id','DatosBasicos.created_at')
                 ->orderBy('NombInstituto', 'DESC')->pluck('NombInstituto','NombInstituto');
                
                 $especialidad=DB::table('DatosBasicos')
                 ->leftJoin('Especialidad', 'DatosBasicos.Especialidad_a_cursar1_id', '=', 'Especialidad.id')
                  ->select('Especialidad.NombEspecialidad','DatosBasicos.id','DatosBasicos.created_at')
                 ->orderBy('NombEspecialidad', 'DESC')->pluck('NombEspecialidad','NombEspecialidad');
     

                 $per= DB::table('Periodo')
                 ->where('Periodo.Vigente', '=',$valor)->first();
                $idperiodo=$per->id; 
                $iddiscapacidad=1;
                 $RegisAspDisca=DatosBasicos::where('UsuariosAspi.datos_socioEconomico', '=', $valor)
                ->where('DatosBasicos.Periodo_id', '=', $idperiodo)
                ->where('AspPregrado.discapacidad_id', '>', $iddiscapacidad)
                ->leftJoin('UsuariosAspi', 'DatosBasicos.user_id', '=', 'UsuariosAspi.id')
                ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
                ->leftJoin('Especialidad', 'DatosBasicos.Especialidad_a_cursar1_id', '=', 'Especialidad.id')
                ->leftJoin('AspPregrado', 'DatosBasicos.AspPregrado_id', '=', 'AspPregrado.id')
                ->leftJoin('discapacidades', 'AspPregrado.discapacidad_id', '=', 'discapacidades.id')
               
                ->select(DB::raw('count(*) as total'),/* DB::raw('SUM(total) as m_total'),*/
                'DatosBasicos.Institutos_id',
                'Especialidad.NombEspecialidad',
                'Institutos.NombInstituto',
                'Institutos.CodSede',
                'Especialidad.CodEspecialidad',
                'AspPregrado.Genero','AspPregrado.discapacidad_id',
                'discapacidades.discapacidad')
                ->groupby('DatosBasicos.Institutos_id','Institutos.NombInstituto','Institutos.CodSede',
                'Especialidad.NombEspecialidad','Especialidad.CodEspecialidad','AspPregrado.Genero',
                'AspPregrado.discapacidad_id','discapacidades.discapacidad')
                ->distinct('discapacidades.discapacidad')
                ->NombInstituto($NombInstituto)
                ->NombEspecialidad($NombEspecialidad)           
                           
                    ->paginate(10);
     // dd($RegisAspDisca);


                 

      // dd($aspi);
         return view('reporteChart.AspiRegisDiscapacidad', compact('RegisAspDisca','sedeofertas','programas','especialidad'));
    }


    public function AspRegisDiscaExport(Request $request)
    {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/

        $valor="1";

        $NombInstituto  = $request->get('NombInstituto');
        $NombEspecialidad  = $request->get('NombEspecialidad');
        
        $per= DB::table('Periodo')
        ->where('Periodo.Vigente', '=',$valor)->first();
       $idperiodo=$per->id; 

        $sedeofertas=DB::table('DatosBasicos')
        ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
        ->select('Institutos.NombInstituto','DatosBasicos.id','DatosBasicos.created_at')
        ->orderBy('NombInstituto', 'DESC')->pluck('NombInstituto','NombInstituto');

        $RegisAspDisca=DatosBasicos::where('UsuariosAspi.datos_socioEconomico', '=', $valor)
        ->where('DatosBasicos.Periodo_id', '=', $idperiodo)
        
        ->leftJoin('UsuariosAspi', 'DatosBasicos.user_id', '=', 'UsuariosAspi.id')
        ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
        ->leftJoin('Especialidad', 'DatosBasicos.Especialidad_a_cursar1_id', '=', 'Especialidad.id')
        ->leftJoin('AspPregrado', 'DatosBasicos.AspPregrado_id', '=', 'AspPregrado.id')
        ->leftJoin('discapacidades', 'AspPregrado.discapacidad_id', '=', 'discapacidades.id')
        ->select(DB::raw('count(*) as total'),/* DB::raw('SUM(total) as m_total'),*/
        'DatosBasicos.Institutos_id',
        'Especialidad.NombEspecialidad',
        'Institutos.NombInstituto',
        'Institutos.CodSede',
        'Especialidad.CodEspecialidad',
        'AspPregrado.Genero','AspPregrado.discapacidad_id',
        'discapacidades.discapacidad')
        ->groupby('DatosBasicos.Institutos_id','Institutos.NombInstituto','Institutos.CodSede',
        'Especialidad.NombEspecialidad','Especialidad.CodEspecialidad','AspPregrado.Genero',
        'AspPregrado.discapacidad_id','discapacidades.discapacidad')
        ->distinct('discapacidades.discapacidad')
        ->NombInstituto($NombInstituto)
        ->NombEspecialidad($NombEspecialidad)           
        ->whereIn('DatosBasicos.Institutos_id',  $request->preinscritos)          
            ->get();


   //dd($RegisAspDisca);



     $nameCampos[] = array('Código','Institutos','CódigoEsp','Especialidad','Género','Discapacidad','total');
     foreach($RegisAspDisca as $user)
     {
        
        
      $nameCampos[] = array(
        'Codigo' => $user->CodSede,
        'Institutos' => $user->NombInstituto,
        'CódigoEsp' => $user->CodEspecialidad,
        'Especialidad' => $user->NombEspecialidad,
        'Género' => $user->Genero,
        'Discapacidad' => $user->discapacidad,
        'Total' => $user->total,
      );
     
     }
     $nameCampos[] = array('','','','','TOTAL');

     //dd($customer_data);
     Excel::create('TotalDiscapacitados', function($excel) use ($nameCampos){
      $excel->setTitle('TotalDiscapacitados');
  
      $excel->sheet('TotalDiscapacitados', function($sheet) use ($nameCampos){
     
       $sheet->fromArray($nameCampos, null, 'A7', false, false);
       $sheet->setBorder('A7:g20', 'thin');
       $sheet->cells('A7:g7', function($cells)
       {
           $cells->setBorder('solid', 'none', 'none', 'solid');
           $cells->setbackground('#000000');
           $cells->setFontColor('#ffffff');
           $cells->setAlignment('center');
           $cells->setValignment('middle');
           
           $cells->setBorder(array(
    'top'   => array(
        'style' => 'solid'
    ),
));
          
       });




// Set borders with array



$sheet->mergeCells('A1:D1');
$sheet->row(1, array(
    'República Bolivariana de Venezuela'
  
));
$sheet->mergeCells('A2:E2');
$sheet->row(2, array(
    'Universidad Pedagógica Experimental Libertador'
  
));

$sheet->mergeCells('A3:E3');
$sheet->row(3, array(
    'Secretaria - Coordinación Nacional  de Admisión'
  
));




$sheet->mergeCells('A5:F5');
$sheet->row(5, array(
   
   ' Total Aspirantes Registrados Con Discapacidad'
));







$sheet->setHeight(array(//alto de la fila
    7     =>  15,
));




$sheet->setWidth(array(
    'A'     =>  10,
    'B'     =>  35,
    'C'     =>  36,
    'D'     =>  15,
    'E'     =>  10,
    'F'     =>  30,
    'G'     =>  10,
    'H'     =>  10,
    'I'     =>  10,
    'J'     =>  10,
    'K'     =>  10,
    'L'     =>  10,
    'M'     =>  10,
    'N'     =>  10,
    'O'     =>  10,
    'P'     =>  10, 
    'Q'     =>  10,
    'R'     =>  10,
));

#Agreg
         
    });
     })->download('xlsx');
    }



    public function tipoCupo(Request $request)
    {
       // dd($id);
                $valor="1";
                //$activo = "1";
                 $NombInstituto  = $request->get('NombInstituto');
                 $NombEspecialidad  = $request->get('NombEspecialidad');
                 

                 $sedeofertas=DB::table('DatosBasicos')
                 ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
                 ->select('Institutos.NombInstituto','DatosBasicos.id','DatosBasicos.created_at')
                 ->orderBy('NombInstituto', 'DESC')->pluck('NombInstituto','NombInstituto');
                
                 $especialidad=DB::table('DatosBasicos')
                 ->leftJoin('Especialidad', 'DatosBasicos.Especialidad_a_cursar1_id', '=', 'Especialidad.id')
                  ->select('Especialidad.NombEspecialidad','DatosBasicos.id','DatosBasicos.created_at')
                 ->orderBy('NombEspecialidad', 'DESC')->pluck('NombEspecialidad','NombEspecialidad');
     

                 $per= DB::table('Periodo')
                 ->where('Periodo.Vigente', '=',$valor)->first();
                $idperiodo=$per->id; 

                 $tipoCupo=DatosBasicos::where('UsuariosAspi.datos_socioEconomico', '=', $valor)
                ->where('DatosBasicos.Periodo_id', '=', $idperiodo)
                ->leftJoin('UsuariosAspi', 'DatosBasicos.user_id', '=', 'UsuariosAspi.id')
                ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
                ->leftJoin('Especialidad', 'DatosBasicos.Especialidad_a_cursar1_id', '=', 'Especialidad.id')
                ->leftJoin('ModoIngreso', 'DatosBasicos.ModoIngreso_id', '=', 'ModoIngreso.id')
                ->select(DB::raw('count(*) as total'),/* DB::raw('SUM(total) as m_total'),*/
                'DatosBasicos.Institutos_id','Especialidad.NombEspecialidad',
                'Institutos.NombInstituto','Institutos.CodSede','ModoIngreso.ModoIngreso')
                ->groupby('DatosBasicos.Institutos_id','Institutos.NombInstituto',
                'Institutos.CodSede','Especialidad.NombEspecialidad','ModoIngreso.ModoIngreso')
                ->NombInstituto($NombInstituto)
                ->NombEspecialidad($NombEspecialidad)           
                           
                    ->paginate(5);
      //  dd($tipoCupo);


                 

      // dd($aspi);
         return view('reporteChart.tipoCupo', compact('tipoCupo','sedeofertas','programas','especialidad'));
    }



    public function tipoCupoExport(Request $request)
    {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/

        $valor="1";

        $NombInstituto  = $request->get('NombInstituto');
        $NombEspecialidad  = $request->get('NombEspecialidad');
        
        $per= DB::table('Periodo')
        ->where('Periodo.Vigente', '=',$valor)->first();
       $idperiodo=$per->id; 

       $sedeofertas=DB::table('DatosBasicos')
       ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
       ->select('Institutos.NombInstituto','DatosBasicos.id','DatosBasicos.created_at')
       ->orderBy('NombInstituto', 'DESC')->pluck('NombInstituto','NombInstituto');
      
       $especialidad=DB::table('DatosBasicos')
       ->leftJoin('Especialidad', 'DatosBasicos.Especialidad_a_cursar1_id', '=', 'Especialidad.id')
        ->select('Especialidad.NombEspecialidad','DatosBasicos.id','DatosBasicos.created_at')
       ->orderBy('NombEspecialidad', 'DESC')->pluck('NombEspecialidad','NombEspecialidad');

        $tipoCupo=DatosBasicos::where('UsuariosAspi.datos_socioEconomico', '=', $valor)
        ->where('DatosBasicos.Periodo_id', '=', $idperiodo)
        ->leftJoin('UsuariosAspi', 'DatosBasicos.user_id', '=', 'UsuariosAspi.id')
        ->leftJoin('Institutos', 'DatosBasicos.Institutos_id', '=', 'Institutos.id')
        ->leftJoin('Especialidad', 'DatosBasicos.Especialidad_a_cursar1_id', '=', 'Especialidad.id')
        ->leftJoin('ModoIngreso', 'DatosBasicos.ModoIngreso_id', '=', 'ModoIngreso.id')
        ->select(DB::raw('count(*) as total'),/* DB::raw('SUM(total) as m_total'),*/
        'DatosBasicos.Institutos_id','Especialidad.NombEspecialidad',
        'Institutos.NombInstituto','Institutos.CodSede','ModoIngreso.ModoIngreso')
        ->groupby('DatosBasicos.Institutos_id','Institutos.NombInstituto',
        'Institutos.CodSede','Especialidad.NombEspecialidad','ModoIngreso.ModoIngreso')
        ->NombInstituto($NombInstituto)
        ->NombEspecialidad($NombEspecialidad)          
        ->whereIn('DatosBasicos.Institutos_id',  $request->preinscritos)          
            ->get();


   //dd($RegisAspDisca);



     $nameCampos[] = array('Código','Institutos','Especialidad','CódigoEsp','Género','Discapacidad','total');
     foreach($RegisAspDisca as $user)
     {
        
        
      $nameCampos[] = array(
        'Codigo' => $user->CodSede,
        'Institutos' => $user->NombInstituto,
        'Especialidad' => $user->NombEspecialidad,
        'CódigoEsp' => $user->CodEspecialidad,
        'Género' => $user->Genero,
        'Discapacidad' => $user->discapacidad,
        'Total' => $user->total,
      );
     
     }
     $nameCampos[] = array('','','','','                                                   TOTAL');

     //dd($customer_data);
     Excel::create('TotalDiscapacitados', function($excel) use ($nameCampos){
      $excel->setTitle('TotalDiscapacitados');
  
      $excel->sheet('TotalDiscapacitados', function($sheet) use ($nameCampos){
     
       $sheet->fromArray($nameCampos, null, 'A7', false, false);
       $sheet->setBorder('A7:g20', 'thin');
       $sheet->cells('A7:g7', function($cells)
       {
           $cells->setBorder('solid', 'none', 'none', 'solid');
           $cells->setbackground('#000000');
           $cells->setFontColor('#ffffff');
           $cells->setAlignment('center');
           $cells->setValignment('middle');
           
           $cells->setBorder(array(
    'top'   => array(
        'style' => 'solid'
    ),
));
          
       });




// Set borders with array



$sheet->mergeCells('A1:D1');
$sheet->row(1, array(
    'República Bolivariana de Venezuela'
  
));
$sheet->mergeCells('A2:E2');
$sheet->row(2, array(
    'Universidad Pedagógica Experimental Libertador'
  
));

$sheet->mergeCells('A3:E3');
$sheet->row(3, array(
    'Secretaria - Coordinación Nacional  de Admisión'
  
));




$sheet->mergeCells('A5:F5');
$sheet->row(5, array(
   
   ' Total Aspirantes Registrados Con Discapacidad'
));







$sheet->setHeight(array(//alto de la fila
    7     =>  15,
));




$sheet->setWidth(array(
    'A'     =>  10,
    'B'     =>  35,
    'C'     =>  36,
    'D'     =>  15,
    'E'     =>  10,
    'F'     =>  30,
    'G'     =>  10,
    'H'     =>  10,
    'I'     =>  10,
    'J'     =>  10,
    'K'     =>  10,
    'L'     =>  10,
    'M'     =>  10,
    'N'     =>  10,
    'O'     =>  10,
    'P'     =>  10, 
    'Q'     =>  10,
    'R'     =>  10,
));

#Agreg
         
    });
     })->download('xlsx');
    }





    }//final

