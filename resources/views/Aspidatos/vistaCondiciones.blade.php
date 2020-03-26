@extends ('layouts.admin')
@section ('contenido')
	<center><h3 class="box-title" bgcolor="SteelBlue">MODIFICACIÓN DE CONDICIOONES DE ALOJAMIENTO</h3></center>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">



	{!!Form::model($Condiciones_alojamiento,['route'=>['Condicones',$Condiciones_alojamiento->id],'method'=>'PUT'])!!}

	@include('Aspidatos.GestorForm.EditCondicionesAloja')

	{!!Form::close()!!}


@endsection