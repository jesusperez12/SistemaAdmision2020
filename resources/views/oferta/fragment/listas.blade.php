@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		@include('oferta.fragment.info')
            <div class="panel panel-default">
			<h2>Especialidades</h2>

                <div class="panel-body">

               		@if($consultas->count())
                       
               		<table class="table table-hover">
               			<thead>
               				<tr>
               					<th>Código</th>
								<th>Nombre de la Especialidad</th>
								<th>Nombre de la Sede</th>
               				</tr>
               			</thead>
               			 @foreach($consultas as $consulta)
               			<tbody>
               				<tr>
							   <td>{{$consulta->CodOPSU}} </td>
               					<td>{{$consulta->NombEspecialidad}} </td>
								<td>{{$consulta->NombSede}} </td>
               				</tr>
                      @endforeach
               			</tbody>
               		</table>
@else
   <p> No hay datos cargados </p>
@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
