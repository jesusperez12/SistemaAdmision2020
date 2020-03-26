@extends ('layouts.diseño')
@section ('contenido')

<div class="main_bg1">
<div class="wrap">  
  <div class="main1">
  <center>
  <h4><strong>Indices Admision</strong></h4>
</center>
@can('indice.create')
  <h4><a href="{{route('indice.create')}}" class="btn btn-info Active info button  pull-right btn-sm"> &nbsp; Asignar Indice Admision </a></h4><br> <br>
  @endcan
  </div>
</div>
</div>

    	  <div class="panel panel-info">
    	  		


                <div class="panel-body">
               	  @if($indice->count())
               		<table class="table table-hover">
               			<thead>
               				<tr bgcolor="#d9edf7">
               		
                        <th>Indice</th>
                        <th>Especialidad</th>
								<th >Acciones</th>
                        <th colspan="3"></th>
               				</tr>
               			</thead>
                           @foreach($indice as $ida)
               			<tbody>
               				<tr>
                         <td>{{$ida->IDA}} </td>
                    
                        <td>{{$ida->NombEspecialidad}} </td>

			<td width="20px"> <center>
								 	
			@can('indice.edit')		
<a href="{{route('indice.edit', $ida->id)}}" class="btn btn-primary Active info button btn-sm">Editar</center></a>	</td>
@endcan					   			 

               				</tr>
                      @endforeach
               			</tbody>
                   </table>

               		<div class="pull-right">
   
   </div>   
   @else
   <p> No hay datos cargados </p>
@endif          

@endsection

