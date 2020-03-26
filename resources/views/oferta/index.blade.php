@extends ('layouts.diseño')
@section ('contenido')



<!-- start main1 -->
  <div class="main_bg1">
<div class="wrap">  
  <div class="main1">
 <center>
  <h4><strong>OFERTAS</strong> </h4>
</center>
@can('ofertas.create')
<h5><a href="{{route('ofertas.create')}}" class="btn btn-info btn-sm Active info button pull-right "> &nbsp; Crear Ofertas</a></h5><br>  <br>
@endcan                  
  </div>
</div>
</div>
<!-- start main -->

     
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
      
                <div class="panel-body">
                  @if($ofertas->count())
                  <table class="table table-hover">
                    <thead>
                      <tr bgcolor="#d9edf7">
                      <th>Institutos/Extensiones</th>
                  <th>Especialidad</th>
                 
         
              <th>Tipo Aspirante</th>
              <th colspan="3"><center>Acciones</center></th>
              
                      </tr>
                    </thead>
                     @foreach($ofertas as $oferta)
                    <tbody>
                      <tr>

                      <td>{{$oferta->NombInstituto}} </td>
                    
                      <td>{{$oferta->NombEspecialidad}} </td>
                  
              
              <td>{{$oferta->ModoIngreso}} </td>
 @can('ofertas.show')            
     <td width="10px"> <a href="{{route('ofertas.show', $oferta->id)}}" class="btn btn-sm Active info button btn-success">Consultar</a></td>
     @endcan	

@can('ofertas.edit') 
@if($oferta->Aprobacion == 1)

<td width="10px"> <a class="btn btn-sm btn-primary Active info button" title="¡¡Esta Oferta ya ha sido Aprobada!! por lo tanto no se puede Editar" disabled>Editar</a></td> 

@else
  <td width="10px"> <a href="{{route('ofertas.edit', $oferta->id)}}" class="btn btn-sm btn-primary Active info button">Editar</a></td> 
@endif
@endcan	

@can('ofertas.destroy')
     <td width="10px">
    {!! Form::open(['route' => ['ofertas.destroy', $oferta->id], 
    'method' => 'DELETE']) !!}
      <button class="btn btn-sm btn-danger "  onclick="
return confirm('Seguro de que desea eliminar la oferta??')">
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


echo str_replace('/?', '?', $ofertas->render() )  ;


?>
</div>
@else
   <p> No hay datos cargados </p>
@endif

@endsection
</body>
</html>



