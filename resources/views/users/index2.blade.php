@extends ('layouts.diseño')
@section ('contenido')

         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	  <div class="panel panel-success">
    	  <div class="panel-heading">  

<center><h4> Listado000 de Asignación de Nucleos <a href="{{route('Usuarios.create')}}" class="btn fa fa-user-plus pull-right btn-default"></a> </h4></center>

    </div>
			<h2></h2>
                <div class="panel-body">
               		@if($nucleo->count())
               			<table class="table">

                		<thead>
                		<tr>
                
               <td><strong>Rol de Usuario: </strong></td>
                <td>{!!$user->descripcion!!}</td>
                		</tr>
                		</thead>
                		<tbody>

                <tr>
               <td><strong>Nombres: </strong></td>
               <td>{!!$user->name!!} </td>
               </tr>
                 <tr>
               <td><strong>Apellidos: </strong></td>
               <td>{!!$user->Apellidos!!} </td>
               </tr>
               	<tr>
               <td><strong>Cédula: </strong></td>
                <td>{!!$user->cedula!!} </td>
                </tr>

                <tr>
               <td><strong>Correo: </strong> </td>
               <td>{!!$user->email!!}</td>
               </tr>


                <tr>
               <td><strong>Sede: </strong> </td>
               <td>{!!$user->NombSede!!} </td>
               </tr>
              
              <tr>
               <td><strong>Nucleos: </strong> </td>
                @foreach($nucleos as $nu)
               <td>{{$nu->NombInstituto}}</td>
               @endforeach
               </tr>
</tbody>

    </table>
               			


								<td>
								  @if (Auth::user()->role_id  =='1')
   <form action="{{route('Usuarios.destroy', $user->id)}}" method="POST">
   {{csrf_field()}}
   <input type="hidden" name="_method" value="DELETE" >
   <button class="btn fa fa-trash btn-danger" onclick="
return confirm('Seguro de que desea eliminar al usuario?')" ></button>
   </form>
    </td>
				@endif					
               				</tr>
                      @endforeach
               			</tbody>
               		</table>
@else
   <p> No hay Nucleos cargados </p>
@endif
</div>
</div>
</div>
</div>
  
@endsection
</body>
</html>
