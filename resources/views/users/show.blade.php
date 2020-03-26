@extends ('layouts.diseño')
@section ('contenido')
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-md-offset-2">
            <div class="panel panel-info">
            <div class="panel-heading"><center><h5><strong>Listado de Institutos Asignados</strong><a href="{{ route('users.index') }}" class="btn btn-success pull-right btn-sm">Regresar</h5></a></center></div>

  
                <div class="panel-body">
                  @if($nucleo->count())
                    <table class="table" border="0">

                    <thead>
                    <tr>
             
                    </tr>
                    </thead>
                    <tbody>

                <tr>
               <td><strong>Nombres </strong></td>
               <td>{!!$user->name!!} </td>
               </tr>
                 <tr>
               <td><strong>Apellidos</strong></td>
               <td>{!!$user->Apellidos!!} </td>
               </tr>
                <tr>
               <td><strong>Cédula </strong></td>
                <td>{!!$user->cedula!!} </td>
                </tr>

                <tr>
               <td><strong>Correo</strong> </td>
               <td>{!!$user->email!!}</td>
               </tr>


                <tr>
               <td><strong>Institutos/Extenciones</strong> </td>
                @foreach($sede as $se)
               <td>{!!$se->NombSede!!} </td>
               @endforeach
               </tr>
             
<tr>
          <td></td>
        </tr>  
<tr>
<td class="pull-left" colspan="2"><strong> Nucleos </strong> </td>
</tr>
@foreach($nucleo as $nu)
         
           <tr>
               <td> </td>
              <td>{{$nu->NombInstituto}}</td>
  <td>
   <form action="{{route('nucleosAgsinados.destroy', $nu->id)}}" method="POST">
   {{csrf_field()}}
   <input type="hidden" name="_method" value="DELETE" >
   <button class="btn fa fa-trash btn-danger" onclick="
return confirm('Seguro de que desea eliminar al usuario?')" >&nbsp;Eliminar</button>
   </form>
    </td>
        
               </tr>

                @endforeach
</thead>

    </table>
                    


              
                 
                  
                     
                    </tbody>
                  </table>
@else

   <p> No hay Nucleos cargados </p>
@endif
</div>
  </div>
@endsection
</body>
</html>
