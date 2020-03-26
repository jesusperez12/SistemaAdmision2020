@extends ('layouts.diseño')
@section ('contenido')
     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-md-offset-2">
<div class="main_bg1">
<div class="wrap">  
  <div class="main1">
  <center>
  <h4><strong>ESPECIALIDAD</strong></h4>
</center>
  <h4><a href="{{route('NuevaEspecialidad.create')}}" class="btn btn-info Active info button  pull-right btn-sm"> &nbsp; Crear Especialidad </a></h4><br> <br>
  </div>
</div>
</div>
<!--buscador-->


    	  <div class="panel panel-info">
    	  		


                <div class="panel-body">
    
               	  @if($consultas->count())
               		<table class=" table table-hover">

               			<thead>
               				<tr bgcolor="#d9edf7">
               					
                        <th>Código </th>
							  
								<th>Especialidad</th>
                
								<th ><center>Acciones</center></th>
                        <th ></th>
               				</tr>
               			</thead>
                     @foreach($consultas as $consulta)
                    <tbody>
                      <tr>
                  
                         <td>{{$consulta->CodEspecialidad}}</td>
            

                <td>{{$consulta->NombEspecialidad}} </td>

         

  <td width="20px"> <center>    
<a href="{{route('NuevaEspecialidad.edit', $consulta->id)}}" class="btn btn-primary Active info button btn-sm">Editar</center></a> </td>
@can('NuevaEspecialidad.destroy')
     <td width="10px">
    {!! Form::open(['route' => ['NuevaEspecialidad.destroy', $consulta->id], 
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

</div>
</div>
 </div>
@endsection
</body>
</html>