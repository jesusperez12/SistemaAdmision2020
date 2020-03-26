@extends ('layouts.diseño')
@section ('contenido')

<div class="main_bg1">
<div class="wrap">  
  <div class="main1">
  <center>
  <h4><strong>PERIODOS</strong></h4>
</center>
  <h4><a href="{{route('NewPeriodo.create')}}" class="btn btn-info Active info button  pull-right btn-sm"> &nbsp; Crear Periodo </a></h4><br> <br>
  </div>
</div>
</div>

	  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-md-offset-2">
    	  <div class="panel panel-success">
    	  		


                <div class="panel-body">
               	  @if($consultas->count())
               		<table class=" table table-hover">
               			<thead>
               				<tr bgcolor="#dff0d8">
               					
                        <th>Corte </th>
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

  <td width="20px"> <center>    
<a href="{{route('NewPeriodo.edit', $consulta->id)}}" class="btn btn-primary Active info button btn-sm">Editar</center></a> </td>
												 
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