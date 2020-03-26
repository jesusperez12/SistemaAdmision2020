@extends ('layouts.admin')
@section ('contenido')
	<center><h3 class="box-title" bgcolor="SteelBlue">MODIFICACIÓN DE NUMEROS DE HIJOS</h3></center>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


	{!!Form::model($Hijos_num,['route'=>['N°Hijos',$Hijos_num->id],'method'=>'PUT'])!!}

	@include('Aspidatos.GestorForm.EditHijos')

	{!!Form::close()!!}


@endsection