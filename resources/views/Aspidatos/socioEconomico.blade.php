@extends ('layouts.admin')
@section ('contenido')
	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<center><h3 class="box-title" bgcolor="SteelBlue">DATOS SOCIO ECONOMICOS</h3></center>
	<div class="box box-info">
		



	{!!Form::open(['route'=>'SocioEconomico.store'])!!}

	@include('Aspidatos.GestorForm.formSocioEconomico')

	{!!Form::close()!!}
</div></div>

@endsection

@section('scripst')
	
@endsection