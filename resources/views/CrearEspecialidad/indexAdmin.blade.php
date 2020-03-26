@extends ('layouts.diseño')
@section ('contenido')

<div class="main_bg1">
<div class="wrap">  
  <div class="main1">
  <center>
  <h4><strong>PROGRAMAS</strong></h4>
</center>
  <h4><a href="{{route('EspecialidadNew.create')}}" class="btn btn-info Active info button  pull-right btn-sm"> &nbsp; Crear Programas </a></h4><br> <br>
  </div>
</div>
</div>
<!--buscador-->
<div class="container">
 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  {{ Form::open(['route' => 'EspecialidadNew.index', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
       <div class="form-group">
 {{ Form::text('CodEspecialidad', null, ['class' => 'form-control', 'placeholder' => 'Código']) }}
       </div>                     
   <div class="form-group">
 {{ Form::text('NombProgramas', null, ['class' => 'form-control', 'placeholder' => 'Programa']) }}
 </div>
              <div class="form-group">
 {{ Form::text('NombEspecialidad', null, ['class' => 'form-control', 'placeholder' => 'Sub Programas']) }}
       </div>             
                                <button type="submit" class="btn btn-default">
                                    <span class="fa fa-search"></span>
                                </button>
                            </div>
                        {{ Form::close() }}
  <!--fin del buscador-->
        <div class="panel panel-success">
            


                <div class="panel-body">
                  @if($consultas->count())
                  <table class=" table table-hover">
                    <thead>
                      <tr bgcolor="#dff0d8">
                        
                        <th>Código </th>
                  <th>Programa</th>
                <th>Sub Programa</th>
                
                <th colspan="3"><center>Acciones</center></th>
                        <th colspan="3"></th>
                      </tr>
                    </thead>
                     @foreach($consultas as $consulta)
                    <tbody>
                      <tr>
                  
                         <td>{{$consulta->CodEspecialidad}}</td>
            
                <td>{{$consulta->NombProgramas}}</td>
                <td>{{$consulta->NombEspecialidad}} </td>

         

  <td width="20px"> <center>    
<a href="{{route('EspecialidadNew.edit', $consulta->id)}}" class="btn btn-primary Active info button btn-sm">Editar</center></a> </td>
                         
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
 
@endsection
</body>
</html>