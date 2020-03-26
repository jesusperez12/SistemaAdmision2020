@extends ('layouts.admin')
@section ('contenido')
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<center><h3 class="box-title" bgcolor="SteelBlue">EXPERIENCIA LABORAL</h3></center><br>
	<div class="box box-primary">
		

	@include('Aspidatos.GestorForm.error')
	
	{!!Form::open(['route'=>'Esperiencia.store'])!!}

	@include('Aspidatos.GestorForm.form')

	{!!Form::close()!!}

</div></div>

	
@endsection

