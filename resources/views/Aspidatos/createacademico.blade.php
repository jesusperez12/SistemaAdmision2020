@extends ('layouts.admin')
@section ('contenido')
<center><h3 class="box-title" bgcolor="SteelBlue" >REGISTRO ACADEMICO</h3></center>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="box box-primary"><br>	
	@include('Aspidatos.GestorForm.error')
	{!!Form::open(['route'=>'DatosAcademicos.store'])!!}

	@include('Aspidatos.GestorForm.formAcademico')

	{!!Form::close()!!}
</div>

@endsection