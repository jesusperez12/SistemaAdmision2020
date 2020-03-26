@extends ('layouts.admin')
@section ('contenido')
	<center><h3 class="box-title" bgcolor="SteelBlue">MODIFICACIÓN DE FUENTES DE INGRESOS</h3></center>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">



	{!!Form::model($fuenteingreso,['route'=>['IngresoUpdate',$fuenteingreso->id],'method'=>'PUT'])!!}

	@include('Aspidatos.GestorForm.EditFuenteIngreso')

	{!!Form::close()!!}


@endsection