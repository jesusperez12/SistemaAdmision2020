@extends ('layouts.admin')
@section ('contenido')
	<center><h3 class="box-title" bgcolor="SteelBlue">EXPERIENCIA LABORAL</h3></center>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="box-header with-border">

	@include('Aspidatos.GestorForm.error')

	{!!Form::model($Esperiencia,['route'=>['Esperiencia.update',$Esperiencia->id],'method'=>'PUT'])!!}

	@include('Aspidatos.GestorForm.formEditEsperiencia')

	{!!Form::close()!!}
</div>
</div></div>
	
@endsection