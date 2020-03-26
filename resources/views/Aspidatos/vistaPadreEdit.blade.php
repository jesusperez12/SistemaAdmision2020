@extends ('layouts.admin')
@section ('contenido')
	<center><h3 class="box-title" bgcolor="SteelBlue">MODIFICACIÓN DE NIVEL DE PADRE</h3></center>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">



	{!!Form::model($sociopadre,['route'=>['PadreUpdate',$sociopadre->id],'method'=>'PUT'])!!}

	@include('Aspidatos.GestorForm.EditPadre')

	{!!Form::close()!!}


@endsection