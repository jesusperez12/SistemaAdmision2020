@extends ('layouts.diseño')
@section ('contenido')
	

<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading"><center><h4><strong>Modificar Indice</strong></h4></center></div>
                    
                <div class="panel-body">
  {!!Form::model($indices,['route'=>['indice.update',$indices->id],'method'=>'PUT'])!!}

	@include('IndiceAdmision.fornularios.editform')

	{!!Form::close()!!}
	</div>
</div>
</div> 
@endsection