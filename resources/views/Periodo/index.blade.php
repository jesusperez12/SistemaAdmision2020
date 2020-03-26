@extends ('layouts.diseño')
@section ('contenido')

<div class="main_bg1">
<div class="wrap">  
  <div class="main1">
  <center>
  <h4><strong>PERIODOS</strong></h4>
</center>
@can('perido.create')
  <h4><a href="{{route('periodo.create')}}" class="btn btn-info Active info button  pull-right btn-sm"> &nbsp; Crear Periodo </a></h4><br> <br>
  @endcan
  </div>
</div>
</div>

	  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-md-offset-2">
    	  
        <div class="panel panel-info">
    	  		


                <div class="panel-body">
               	  @if($consultas->count())
               		<table class=" table table-hover">
               			<thead>
               				<tr bgcolor="#d9edf7">
               					
                        <th>Cohorte </th>
							    <th>Periodo</th>
						
               <th>Estatus</th> 
                
								<th colspan="3"><center>Acciones</center></th>
                        <th colspan="3"></th>
               				</tr>
               			</thead>
                     @foreach($consultas as $consulta)
                    <tbody>
                      <tr>
                  
                         <td>{{$consulta->NombrePeriodo}}</td>
            
                <td>{{$consulta->Lapso}}</td>
               
                <td>{{$consulta->Vigente}}</td>
 @can('periodo.edit')
  <td width="20px"> <center>    
<a href="{{route('periodo.edit', $consulta->id)}}" class="btn btn-primary Active info button btn-sm">Editar</center></a> </td>
@endcan
@can('periodo.destroy')
     <td width="10px">
    {!! Form::open(['route' => ['periodo.destroy', $consulta->id], 
    'method' => 'DELETE']) !!}
      <button class="btn btn-sm btn-danger "  onclick="
return confirm('Seguro de que desea eliminar el periodo??')">
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
@endsection
</body>
</html>