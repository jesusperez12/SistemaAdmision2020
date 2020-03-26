
@extends ('layouts.diseño')
@section ('contenido')


<div class="main_bg1">
<div class="wrap">  
  <div class="main1">
  <center>
  <h4><strong>USUARIOS</strong> </h4>
</center>
@can('users.create')
  <h5><a href="{{route('users.create')}}" class="btn btn-info Active info button btn-sm pull-right "> &nbsp; Crear Usuarios</a></h5><br>  <br>
@endcan                    
  </div>
</div>
</div>



         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
           <div class="panel panel-info">
    	
       <div class="panel-body">
               		@if($users->count())
                    <table id="tabla1" class="table table-hover">
             
               			<thead>
               				<tr bgcolor="#d9edf7">
                      <th>Nombres</th>
               			  <th>Apellidos</th>
                      <th>Cedula</th>
                      <th>Institutos / Extenciones</th>
                      <th>Rol</th>
                      

                        
                        <th colspan="3"><center>Acciones</center></th>
                        <th colspan="3"></th>
                      </tr>
                    </thead>
                    
                     @foreach($users as $user)
                    <tbody>
                      <tr>
                     <td>{{$user->name}} </td>
                     
                      <td>{{$user->Apellidos}} </td>
                      <td>{{$user->cedula}} </td>
                      <td>{{$user->getSede()}} </td>
                      <td>{{$user->getRolNombre()}} </td>
                    
                
               			
@can('users.edit')
@if ($user->institutos_count > 0)
  <td width="5px"> <button class="btn btn-warning btn-sm" title="Para editar este registro, primero debe eliminar los núcleos Asignados" disabled>Editar</button></td>
@else
  <td width="5px"> <a href="{{route('users.edit', $user->id)}}" onClick="valor(this.value);" class="btn btn-warning Active info button btn-sm ">Editar</a></td>

  @endif
@endcan

@can('users.asignar')
<td width="5px"> <a href="{{route('nucleosAgsinados.edit', $user->id)}}" value="Agsinar" onClick="valor(this.value)" class="btn btn-primary Active info button btn-sm " >Asignar</a></td>
@endcan

@can('users.show')
<td width="5px"> <a href="{{route('nucleosAgsinados.show', $user->id)}}" value="VerNucleos" onClick="valor(this.value)" class="btn btn-success Active info button btn-sm">Consultar</a></td>
@endcan

 @can('users.destroy')
     <td width="10px">
    {!! Form::open(['route' => ['users.destroy', $user->id], 
    'method' => 'DELETE']) !!}
      <button class="btn btn-sm btn-danger "  onclick="
return confirm('Seguro de que desea eliminar el Usuario??')">
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


echo str_replace('/?', '?', $users->render() )  ;


?>
</div>
@else
   <p> No hay datos cargados </p>
@endif
</div>
</div>
</div>
</div>


<!-- start footer -->

<!--<script type="text/javascript">
$(document).ready(function() {
$('#tabla1').stacktable();
});
</script>-->

@endsection 

</body>
</html>



<!--@section ('scripts')
  <script type ="text/javascript">

$(document).ready(function(){

     // $("#agsinar").hide();
      $("#vernucleos").hide();
      

    });

    function valor(dato){

      if(dato == 'Agsinar'){

        $("#vernucleos").show();
          //$("#extranjero").hide();
          //$("#Origen").hide();
      }

      else if(dato == 'VerNucleos'){

      
      }

      else{

        $("#vernucleos").hide();

    

      }

    }



</script>
@endsection-->