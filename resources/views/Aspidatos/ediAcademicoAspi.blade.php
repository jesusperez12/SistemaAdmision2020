@extends ('layouts.admin')
@section ('contenido')
	<center><h3 class="box-title" bgcolor="SteelBlue">Modificación de Datos Academicos</h3></center>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

	@include('Aspidatos.GestorForm.error')
	{!!Form::model($DatosAcademicos,['route'=>['Academico.update',$DatosAcademicos->id],'method'=>'PUT'])!!}

	@include('Aspidatos.GestorForm.EditAcademicosAspi')

	{!!Form::close()!!}


@endsection