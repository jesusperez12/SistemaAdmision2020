<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::resource('Admitidos', 'AspirantesAdmitidosController');
Route::get('Admitidos', 'AspirantesAdmitidosController@index')->name('Admitidos.index');
Route::POST('Admitidos', 'AspirantesAdmitidosController@AdmitidosStore')->name('Admitidos.store');
Route::get('no_Aptos', 'AspirantesAdmitidosController@noAptos')->name('no_Aptos');
Route::POST('no_Aptos', 'AspirantesAdmitidosController@noAptosStore')->name('no_Aptos.store');


Route::middleware(['auth'])->group(function () {
	//Roles
	Route::post('roles/store', 'RoleController@store')->name('roles.store')
		->middleware('permission:roles.create');

	Route::get('roles', 'RoleController@index')->name('roles.index')
		->middleware('permission:roles.index');

	Route::get('roles/create', 'RoleController@create')->name('roles.create')
		->middleware('permission:roles.create');

	Route::put('roles/{role}', 'RoleController@update')->name('roles.update')
		->middleware('permission:roles.edit');

	Route::get('roles/{role}', 'RoleController@show')->name('roles.show')
		->middleware('permission:roles.show');

	Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')
		->middleware('permission:roles.destroy');

	Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit')
		->middleware('permission:roles.edit');
	//Users
	Route::resource('users', 'UserController');
	Route::resource('nucleosAgsinados', 'AgsinarNucleoController');
	Route::get('get-nucleos','UserController@getnucleos')->name('get-nucleos');
	

	//Ofertas
	Route::resource('ofertas', 'OfertaController');
	Route::get('get-cupos','OfertaController@getTipoIngreso')->name('get-cupos');	
	Route::get('especialidades/{id}','OfertaController@getprogramas');
	Route::get('subprograma/{id}','OfertaController@getsubprogramas');
	//Route::POST('/store', 'OfertaController@checkbox')->name('store');
	Route::get('oferta/Consulta', 'OfertaController@consultaAprobacion')->name('ofertas.consultaAprobacion')
		->middleware('permission:ofertas.consultaAprobacion');

	Route::POST('oferta/aprobar', 'OfertaController@Aprobar')->name('ofertas.aprobar');
		
	Route::get('oferta/desaprobar', 'OfertaController@ofertasdesaprobadas')->name('ofertas.desAprobarindex');
		
	Route::POST('oferta/desaprobar', 'OfertaController@desAprobar')->name('ofertas.desaprobar');
	
	//INdice Admision
	Route::resource('indice', 'IndiceAdmisionController');


	//Especialidad
	Route::resource('Especialidad', 'EspecialidadController');
	Route::get('get-subprograma','EspecialidadController@getsubprogramas')->name('get-subprograma');
	Route::get('programa/{id}','EspecialidadController@getprograma');
	
	Route::resource('NuevaEspecialidad','CrearEspecialidadController');
	
//Periodo

	Route::resource('periodo','PeriodoController');

//Reportes Charts
	Route::resource('charts','DeshboardController');
	route::get('listall/{page?}','DeshboardController@listall')->name('listall');
	route::get('Datos/{page?}','DeshboardController@datosIncompleto')->name('Datos');
// Reporte Excel

Route::get('ReporteExcel', function()
{
	return (new UsersExports)->download('products.xlsx');
});



});
Route::get('consulta', 'ExcelController@index')->name('consulta.index');

Route::get('consulta/export', 'ExcelController@excel')->name('consulta.export');

Route::get('AspiranteRegistrados', 'ExcelController@ListAspRegis')->name('AspiranteRegistrados.index');

Route::get('AspiranteRegistrados/export', 'ExcelController@ListAspRegisExport')->name('AspiranteRegistrados.export');


Route::get('AspPreinscritos', 'ExcelController@AspPreinscritos')->name('AspPreinscritos.index');

Route::get('AspPreinscritos/export', 'ExcelController@AspPreinscritosExport')->name('AspPreinscritos.export');

Route::get('Inscritos/Discapacidad', 'ExcelController@AspRegisDisca')->name('AspRegisDisca.index');

Route::get('Inscritos/Discapacidad/export', 'ExcelController@AspRegisDiscaExport')->name('AspRegisDisca.export');

Route::get('tipoCupo', 'ExcelController@tipoCupo')->name('tipoCupo.index');

Route::get('tipoCupo/export', 'ExcelController@tipoCupoExport')->name('tipoCupo.export');



Route::prefix('Aspirante')->group(function(){ 

	Route::get('/login', 'Auth\AspiranteLoginController@showLoginForm')->name('Aspirante.login');
	
	Route::get('/listas', 'Auth\AspiranteLoginController@viewlistasOfertas')->name('Aspirante.lista');
	
	Route::post('/login', 'Auth\AspiranteLoginController@login')->name('Aspirante.login.submit');
	Route::get('/register','Auth\AspiranteRegisterController@showRegistrationForm')->name('Aspirante.registrar');
	
	
	Route::post('/register','Auth\AspiranteRegisterController@register')->name('Aspirante.registrar');
	
	Route::get('/register/verify/{code}', 'Auth\AspiranteRegisterController@verify');	
	//Route::get('/Aspirante', 'DatosAspiranteController@index')->name('Aspirante');
	//PASSWORD RESET
	Route::post('/password/email','Auth\AspiranteForgotPasswordController@sendResetLinkEmail')->name('Aspirante.password.email');
	
	Route::get('/password/reset','Auth\AspiranteForgotPasswordController@showLinkRequestForm')->name('Aspirante.password.request');
	
	Route::post('/password/reset','Auth\AspiranteResetPasswordController@reset');
	
	Route::get('/password/reset/{token}','Auth\AspiranteResetPasswordController@showResetForm')->name('Aspirante.password.reset');
	
		Route::get('/Perfil', 'AvatarAspiranteController@profile');
	Route::post('/Perfil', 'AvatarAspiranteController@update_avatar');
	
		
	
	});


Route::resource('DatosAspirante','DatosAspiranteController');

Route::resource('Datosbasicos','DepositoController');
Route::get('editDatBasicos/{id}','DepositoController@geteditDatBasicos')->name('editDatBasicos');
Route::put('datosBasicos/{id}','DepositoController@getUpdateDatBasicos')->name('datosBasicos');

//Route::resource('listas', 'OfertaAprobadasController');

Route::resource('DatosAcademicos','AcademicoController');

Route::resource('Academico','DatosAcademicosController');
Route::get('get-Estado','DatosAcademicosController@getEstado')->name('get-Estad');
Route::get('get-Muni','DatosAcademicosController@getMunicipios')->name('get-Muni');


Route::resource('Esperiencia','ExpeLaboralController');

Route::resource('Diagnostico','diagnosticoController');

Route::get('vocacional/{id}','diagnosticoController@getresolver')->name('vocacional');



Route::resource('SocioEconomico','SocioEconomicoController');
Route::get('editMadre/{id}','SocioEconomicoController@getEditMadre')->name('editMadre');
Route::put('Economico/{id}','SocioEconomicoController@getEditUpdate')->name('Economico');

Route::get('corregir/{padre}','SocioEconomicoController@getEditPadre')->name('corregir');
Route::put('PadreUpdate/{id}','SocioEconomicoController@getUpdatePadre')->name('PadreUpdate');

Route::get('FuenteIngreso/{id}','SocioEconomicoController@getEditFuenteI')->name('FuenteIngreso');
Route::put('IngresoUpdate/{id}','SocioEconomicoController@getUpdateFuenteI')->name('IngresoUpdate');

Route::get('NivelIngreso/{id}','SocioEconomicoController@getEditNivelI')->name('NivelIngreso');
Route::put('NivelIngreso/{id}','SocioEconomicoController@getUpdateNivelI')->name('NivelIngreso');

Route::get('Condicones/{id}','SocioEconomicoController@getEditCondiciones')->name('Condicones');
Route::put('Condicones/{id}','SocioEconomicoController@getUpdateCondiciones')->name('Condicones');

Route::get('Traslado/{id}','SocioEconomicoController@getEditTraslado')->name('Traslado');
Route::put('Traslado/{id}','SocioEconomicoController@getUpdateTraslado')->name('Traslado');

Route::get('N°Hijos/{id}','SocioEconomicoController@getEditHijos')->name('N°Hijos');
Route::put('N°Hijos/{id}','SocioEconomicoController@getUpdaHijos')->name('N°Hijos');

Route::get('CosteoPostgrado/{id}','SocioEconomicoController@getEditCosteoPost')->name('CosteoPostgrado');
Route::put('CosteoPostgrado/{id}','SocioEconomicoController@getUpdaCosteoPost')->name('CosteoPostgrado');

//Route::get('get-sede','DepositoController@getsede')->name('get-sede');
//Route::get('programas/{id}','DepositoController@getprogramas');
Route::get('Especialidadescurso1/{id}','DepositoController@getEspecialidadcurso1');
Route::get('Especialidadescurso2/{id}','DepositoController@getEspecialidadcurso2');
Route::get('Especialidadescurso3/{id}','DepositoController@getEspecialidadcurso3');
Route::get('get-cursos','DepositoController@getTipoIngreso')->name('get-cursos');
Route::get('NuevoIngreso/{id}','DepositoController@getNuevoIngreso');
//Route::get('get-cuposDirigidor','DepositoController@getcuposDirigidor')->name('get-cuposDirigidor');

//Route::get('get-especialidad','DepositoController@getEspecialidad')->name('get-especialidad');
//Route::get('get-programas','DepositoController@getProgramas')->name('get-programas');
Route::get('get-Estado','DatosAspiranteController@getEstado')->name('get-Estado');

Route::get('get-Parroquias','DatosAspiranteController@getParroquias')->name('get-Parroquias');

Route::get('get-Municipios','DatosAspiranteController@getMunicipios')->name('get-Municipios');



Route::get('Reporte','PDFController@index');
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('veReporte',array(
    'as'=>'veReporte',
    'uses'=>'PDFController@veReporte'
));

Route::get('reporte',array(
    'as'=>'vistaHTMLPDF',
    'uses'=>'PDFController@vistaHTMLPDF'
));


Route::get('planilla/Admitidos', 'PDFController@pdf')->name('reporte.pdf');

Route::get('planillaAdmitido',array(
    'as'=>'planillaAdmitido',
    'uses'=>'PDFController@veReporteAdmitido'
));