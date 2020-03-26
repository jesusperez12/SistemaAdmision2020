@extends ('layouts.diseño')
@section ('contenido')

<div class="main_bg1">
<div class="wrap">  
  <div class="main1">
  <center>
  <h4><strong>PROGRAMAS</strong></h4>
</center>
  <h5><a href="{{route('especialidadAdmin.create')}}" class="btn btn-info Active info button  pull-right btn-sm"> &nbsp; Asignar Programas </a></h5><br> <br>
  </div>
</div>
</div>

		@include('especialidad.fragment.info')
    	  <div class="panel panel-success">
    	  		


                <div class="panel-body">
               	  @if($consultas->count())
               		<table class="table table-hover">
               			<thead>
               				<tr bgcolor="#dff0d8">
               					
                         <th>Institutos/Extenciones</th>
							    <th>Programa</th>
								<th>Sub Programa</th>
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
                         <td>{{$consulta->NombProgramas}}</td>
							 	<td>{{$consulta->NombEspecialidad}} </td>
								
								<td>{{$consulta->NombrePeriodo}}</td>

								<td>{{$consulta->Vigente}}</td>
               
								<td>{{$consulta->created_at}}</td>

			<td width="20px"> <center>		
<a href="{{route('especialidadAdmin.edit', $consulta->id)}}" class="btn btn-primary Active info button btn-sm">Editar</center></a>	</td>
								   <td>					 
								   @if (Auth::user()->rols_id=='1')
	
<td width="20px"> 
								   
   <form action="{{route('especialidadAdmin.destroy', $consulta->id)}}" method="POST">
   {{csrf_field()}}
<input type="hidden" name="_method" value="DELETE" >
   <button class="btn btn-danger Active info button btn-sm" onclick="
return confirm('Seguro de que desea eliminar la Especialidad??')" >Eliminar</button>
  
   </form>

	@endif
    </td>
               				</tr>
                      @endforeach
                 
               			</tbody>
               		</table>
                    </div>
                      </div>
               		<div class="pull-right">
    <?php


echo str_replace('/?', '?', $consultas->render() )  ;


?>
   </div>   
   @else
   <p> No hay datos cargados </p>
@endif          



</body>

@endsection
</html>



