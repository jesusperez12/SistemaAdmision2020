@extends ('layouts.admin')
@section ('contenido')
	<center><h3 class="box-title" bgcolor="SteelBlue">MODIFICACIÓN DE  NIVEL DE MADRE</h3></center>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


	{!!Form::model($edit,['route'=>['Economico',$edit->id],'method'=>'PUT'])!!}

	@include('Aspidatos.GestorForm.editEconomico')

	{!!Form::close()!!}


@endsection