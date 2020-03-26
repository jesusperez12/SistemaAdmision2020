@extends ('layouts.admin')
@section ('contenido')
  <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">

                       <center><h4>Resultados Diagnostico</h4></center>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 200px;">
                   
                  
                </div>
              </div>
            </div>
    @if($dato->count())

     <div class="box-body table-responsive no-padding">
						
              <table class="table table-hover">
                <tr>
           <th><center>Resultado de Prueba</center></th>   
           <th><center>Estatus</center></th>   
         
					  <th colspan="3"></th>
                </tr>
                @foreach($dato as $resultadoPrueba)
                           <tr>
         <td><center >{{$resultadoPrueba->TotVocacional}}</center></td>
         @if (count($admitidos) > 0)
         <td><center>Admitido</center></td>
         @else
         <td><center>En Processo</center></td>
          @endif
 
                </tr>
               @endforeach
              </table>
            </div>
          </div>
        </div>
      </div>
@else

      {!!Form::open(['route'=>'Diagnostico.store'])!!}

  @include('Aspidatos.diagnostico')

  {!!Form::close()!!}

@endif

@endsection