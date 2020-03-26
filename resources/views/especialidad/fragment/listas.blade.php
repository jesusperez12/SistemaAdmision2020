@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
		@include('especialidad.fragment.info')
            <div class="panel panel-default">
			<h2>Especialidades</h2>

                <div class="panel-body">

               		@if($especialidades->count())
                       
               		<table class="table table-hover">
               			<thead>
               				<tr>
               					<th>Código</th>
								<th>Nombre de la Especialidad</th>
               				</tr>
               			</thead>
               			 @foreach($especialidades as $especialidad)
               			<tbody>
               				<tr>
               					<td>{{$especialidad->CodEspecialidad}} </td>
								<td>{{$especialidad->NombEspecialidad}} </td>
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