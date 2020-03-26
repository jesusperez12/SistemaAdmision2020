@extends ('layouts.admin')
@section ('contenido')

  <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">

                       <center><h4>Experiencias Laborales</h4></center>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 200px;">
                   
                  
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
    @if($Esperiencia->count())
          
            
                  <table class="table table-hover">
   
                    <thead>
               
                      <tr>
                     <th >Institución Donde Trabaja</center></th>
                      <th >Años de Graduado</center></th>
                      <th >Años de Servicio</center></th>
                      <th >Entidad Federal Plantel</center></th>
                      <th >Correcion</center></th>

                      </tr>
                    </thead>
                  @foreach($Esperiencia as $Expe)
                    <tbody>
                      <tr>
                     <td><center>{{$Expe->NombreInstitucion}}</center></td>
                      <td>{{$Expe->AñoGraduado}}</td>
                      <td>{{$Expe->AñoServicio}}</td>
                      <td>{{$Expe->Estado}}</td>
             

<td width="20px"> <a href="{{ route('Esperiencia.edit', $Expe->id)}}" class="btn btn-block btn-info   pull-right fa fa-pencil-square-o">EDITAR</a></td>
                <td>
  
                
                      </tr>
                      @endforeach
                     
                    </tbody>
                   
                  </table>
   </div>
            <!-- /.box-body -->
          </div>
              <div class="col-md-6 ">     
                 <div class="col-md-3 col-md-offset-10">
            <tr>
            <th>        
            <a href="Esperiencia/create" class="btn btn-block btn-success">AGREGAR +..</a>
        
            
            </div>
          </div>
       
        </div>
      </div>

@else

{!!Form::open(['route'=>'Esperiencia.store'])!!}

  @include('Aspidatos.GestorForm.form')

  {!!Form::close()!!}@endif
         
  
@endsection
