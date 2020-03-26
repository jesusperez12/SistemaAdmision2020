@extends ('layouts.admin')
@section ('contenido')


    <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">

                       <center><h4> Datos Académico Docentes</h4></center>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 200px;">
                   
                  
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table no-padding">
                         @if($academico->count())
                  <table class="table table-hover">
                    <thead>
                    <tr >
                    <th ><center>Titulo</center></th>
          <th ><center>Universidad</center></th>
          <th ><center>Fecha de Inicio</center></th>
          <th ><center>Fecha de Culminacion</center></th>
          <th ><center>Fecha de Grado</center></th>
          <th ><center>Pais de Estudio</th>
          <th ><center>Tipo de Organización</center></th>
          <th ><center>Escala</center></th>
          <th ><center>Puesto de Promocion</center></th>
          <th ><center>Promedio</center></center></th> 
                        
                        <th colspan="3"><center>Acciones</center></th>
                        <th colspan="3"></th>
                      </tr>
                    </thead>
                   @foreach($academico as $datos)
                    <tbody>
                    <tr height="30">
                     <td><center>{{$datos->TiposTitulo}}</center></td>
          <td><center>{{$datos->Universidad}}</center></td>
          <td><center>{{$datos->FechaInicio}}</center></td>
          <td><center>{{$datos->fechaCulminacion}}</center></td>
          <td><center>{{$datos->FechaGrado}}</center></td>
          <td><center>{{$datos->Pais}}</center></td>
          <td><center>{{$datos->tipoOrganizacion}}</center></td>
          <td><center>{{$datos->Escala}}</center></td>
          <td><center>{{$datos->PuestoPromocion}}</center></td>
          <td><center>{{$datos->Promedio}}<center></td>
             

<td width="20px"> <a href="{{ route('DatosAcademicos.edit', $datos->id)}}" class="btn btn-block btn-info  pull-right fa fa-pencil-square-o">EDITAR</a></td>
                <td>
  
                
                      </tr>
                      @endforeach
                     
                    </tbody>
                  </table>
                    </div>
            <!-- /.box-body -->
          </div>
              <div class="col-md-6 ">     
                 <div class="col-md-6 col-md-offset-9">
            <tr>
            <th>        
           <a href="DatosAcademicos/create" class="btn btn-block btn-success">AGREGAR +..</a>
        
            
            </div>
          </div>
      
        </div>
      </div>

@else



  {!!Form::open(['route'=>'DatosAcademicos.store'])!!}

  @include('Aspidatos.GestorForm.formAcademico')

  {!!Form::close()!!}

@endif
          
  
@endsection


