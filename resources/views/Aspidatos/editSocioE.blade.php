@extends ('layouts.admin')
@section ('contenido')
	<center><h3 class="box-title" bgcolor="SteelBlue">MODIFICAR DATOS SOCIO ECONOMICOS</h3></center>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="box box-info"><br>	




{!!Form::model($SegundosDATOSOCIO,['route'=>['SocioEconomico.update',$SegundosDATOSOCIO->id],'method'=>'PUT'])!!}

	@include('Aspidatos.GestorForm.editEconomicofase2')

	{!!Form::close()!!}
   

	
</div>

@endsection