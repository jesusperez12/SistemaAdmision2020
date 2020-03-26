@extends ('layouts.admin')
@section ('contenido')
	<center><h3 class="box-title" bgcolor="SteelBlue">MODIFICACIÓN DE COSTEO DEL POSTGRADO</h3></center>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	


	{!!Form::model($Costeo_Postgrado,['route'=>['CosteoPostgrado',$Costeo_Postgrado->id],'method'=>'PUT'])!!}

	@include('Aspidatos.GestorForm.EditCosteoPost')

	{!!Form::close()!!}


@endsection