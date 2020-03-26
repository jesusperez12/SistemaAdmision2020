@extends ('layouts.admin')
@section ('contenido')

    <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">

                       <center><h4> Datos Académicos</h4></center>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 200px;">
                   
                  
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table no-padding">
                         @if($DatosAcademicos->count())
                  <table class="table table-hover">
                    <thead>
                    <tr >
          <th ><center>Sistema de Estudio</center></th>
          <th ><center>Nombre del Plantel</center></th>
          <th ><center>Dependencia del Plantel</center></th>
          <th ><center>Entidad Federal Plantel</center></th>
          <th ><center>Municipio Del Plantel</center></th>
          <th ><center>Rama de Educación Media</center></th>
          <th ><center>Promedio</th>
          <th ><center>Turno de Estudio</center></th>
         
         
          <th ><center>Número RNI (RUSNIES o CNU)</center></center></th> 
                        
                        <th colspan="3"><center>Acciones</center></th>
                        <th colspan="3"></th>
                      </tr>
                    </thead>
                   @foreach($DatosAcademicos as $datos)
                    <tbody>
                    <tr height="30">
          <td><center>{{$datos->sistemaEstudio}}</center></td>
          <td><center>{{$datos->namePlantel}}</center></td>
          <td><center>{{$datos->DependenciaPlantel}}</center></td>
          <td><center>{{$datos->Estado}}</center></td>
          <td><center>{{$datos->Municipio}}</center></td>
          <td><center>{{$datos->ramas}}</center></td>
          <td><center>{{$datos->Promedio}}</center></td>
          <td><center>{{$datos->TurnoEstudio}}</center></td>
          <td><center>{{$datos->NumeroRNI}}</center></td>  

<td width="20px"> <a href="{{ route('Academico.edit', $datos->id)}}" class="btn btn-block btn-info  pull-right fa fa-pencil-square-o  " bgcolor="SteelBlue">EDITAR</a></td>
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
           <a href="Academico/create" class="btn btn-block btn-success">AGREGAR +..</a>
        
            
            </div>
          </div>
      
        </div>
      </div>

@else



  {!!Form::open(['route'=>'Academico.store'])!!}

  @include('Aspidatos.GestorForm.AcademicoAspiCreate')

  {!!Form::close()!!}

@endif
          
  
@endsection

