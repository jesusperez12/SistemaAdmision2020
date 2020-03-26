@extends('layouts.admin')

@section('contenido')
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-success">
                <div class="panel-heading">Usuario</div>
               
                <center>
         <table class="table table-hover">
                        <thead>
                        <tr>
                                <th>Indicadores</th>
                                <th>Detalles SocioEconomico</th>
                                <th colspan="3">&nbsp;</th>

                            </tr>
                        </thead>
                        
         @foreach($Editar as $socios)
          <tr>
             <td>{{ $socios->TiempoPost }}</td>
             
                                                                
                            </tr>
                      @endforeach
                        </tbody>
                    </table>
               
        
                 <a href="{{ route('Usuarios.index') }}" class="btn btn-primary active pull-center">CANCELAR</a>&nbsp;&nbsp;<a href="{{route('Usuarios.edit', $user->id)}}" class="btn btn-success  active">EDITAR "{!!$user->name!!}"</a>
                
                	


                </center>

    <div class="copy">
      <p class="link"> <strong> <center> Universidad Pedagógica Experimental Libertador</strong> | Dirección de Informática. </center></a></p>
    </div>
        </div>
      </div>
@endsection