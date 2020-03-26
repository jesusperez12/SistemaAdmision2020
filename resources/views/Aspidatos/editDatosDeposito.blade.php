@extends ('layouts.admin')
@section ('contenido')
	<center><h3 class="box-title" bgcolor="SteelBlue">MODIFICAR DEPOSITO</h3></center>

	
  {!!Form::model($deposito,['route'=>['Datosbasicos.update',$deposito->id],'method'=>'PUT'])!!}

	@include('Aspidatos.GestorForm.editDatDepositos')

	{!!Form::close()!!}

@endsection
