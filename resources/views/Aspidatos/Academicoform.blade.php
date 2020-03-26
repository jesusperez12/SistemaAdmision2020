@extends ('layouts.admin')
@section ('contenido')
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<center><h4> Datos Académicos</h4></center>


	
	@include('Aspidatos.GestorForm.error')

	
	{!!Form::open(['route'=>'Academico.store'])!!}

		@include('Aspidatos.GestorForm.AcademicoAspiCreate')

		{!!Form::close()!!}

</div>

@endsection