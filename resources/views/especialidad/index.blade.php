@extends ('layouts.diseño')
@section ('contenido')

<div class="main_bg1">
<div class="wrap">  
  <div class="main1">
  <center>
  <h4><strong>ASIGNAR ESPECIALIDAD</strong></h4>
</center>
@can('Especialidad.create')
  <h4><a href="{{route('Especialidad.create')}}" class="btn btn-info Active info button  pull-right btn-sm"> &nbsp; Asignar Especialidad </a></h4><br> <br>
  @endcan
  </div>
</div>
</div>

		@include('especialidad.fragment.info')
    	  <div class="panel panel-info">
    	  		


                <div class="panel-body">
               	  @if($consultas->count())
               		<table class="table table-hover">
               			<thead>
               				<tr bgcolor="#d9edf7">
               					
                        <th>Institutos/Extensiones</th>
							  
								<th>Especialidad</th>
                
								<th>Periodo</th>
								<th>Vigente</th>
               
								<th>Fecha</th>
								<th colspan="3"><center>Acciones</center></th>
                        <th colspan="3"></th>
               				</tr>
               			</thead>
               			 @foreach($consultas as $consulta)
               			<tbody>
               				<tr>
               		
                         <td>{{$consulta->NombInstituto}}</td>
							 
								
								<td>{{$consulta->NombEspecialidad}} </td>
								<td>{{$consulta->Lapso}}</td>

								<td>{{$consulta->Vigente}}</td>
               
								<td>{{$consulta->created_at}}</td>

			<td width="20px"> <center>
@can('Especialidad.edit')		
<a href="{{route('Especialidad.edit', $consulta->id)}}" class="btn btn-primary Active info button btn-sm">Editar</center></a>	</td>
@endcan								 	

@can('Especialidad.destroy')
     <td width="10px">
    {!! Form::open(['route' => ['Especialidad.destroy', $consulta->id], 
    'method' => 'DELETE']) !!}
      <button class="btn btn-sm btn-danger "  onclick="
return confirm('Seguro de que desea eliminar la Especialidad??')">
          Eliminar
       </button>
      {!! Form::close() !!}
     </td>
   @endcan									   			 

               				</tr>
                      @endforeach
               			</tbody>
               		</table>
               		<div class="pull-right">
    <?php


echo str_replace('/?', '?', $consultas->render() )  ;


?>
   </div>   
   @else
   <p> No hay datos cargados </p>
@endif          

@endsection
</body>
</html>