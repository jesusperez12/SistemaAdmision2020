@extends ('layouts.admin')
@section ('contenido')
	<center><h3 class="box-title" bgcolor="SteelBlue">MODIFICACIÓN DE TIEMPO DE TRASLADO</h3></center>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	


	{!!Form::model($Tiempo_Traslado,['route'=>['Traslado',$Tiempo_Traslado->id],'method'=>'PUT'])!!}

	@include('Aspidatos.GestorForm.EditTraslado')

	{!!Form::close()!!}


@endsection