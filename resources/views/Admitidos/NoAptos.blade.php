

@extends ('layouts.diseño')

@section ('contenido')

​

​

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <div class="panel panel-info">

        <div class="panel-heading">

            <center>

                <h5><strong>Aspirantes Aptos pero en Cola</strong></h5>

            </center>

        </div>

        <br>

        @if($admitidos->count())

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            {{ Form::open(['route' => 'Admitidos.index', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
            <div class="form-group">
 {{ Form::select('NombInstituto', $sedeofertas, null, ['class'=>'form-control', 'placeholder' => '.:Institutos:.']) }} 
       </div> 

            <div class="form-group">

                {!!Form::label('NombEspecialidad','Especialidad:')!!}

                {{ Form::select('NombEspecialidad', $especialidad, null, ['class'=>'form-control', 'placeholder' => '.:Seleccione:.']) }}

            </div>

            <button type="submit" class="btn btn-default">

                <span class="fa fa-search"></span>

            </button>

            {{ Form::close() }}

        </div>

​

        <div class="panel-body">

            <form name="formulario" class="form-groub" method="POST" action="{{ route('no_Aptos.store') }}">

                {{Form::token()}}

                <table class="table">

                    <tr>

                        <th style="width: 40px"></th>

                        <th style="width: 40px">Cedula</th>

                        <th>Nombres</th>

                        <th>Apellidos</th>

                        <th>Especialidades</th>

                        <th>Correo</th>

​

                    </tr>

                    <tr>

                        <td colspan="3">

                            <label>

                                <input type="checkbox" id="chec"

                                    onclick="marcar(this); btTutorial.disabled = !this.checked" /> Marcar/Desmarcar

                                Todos

                            </label>

                        </td>

                        <td colspan="5">

                            <button class="btn btn-success btn-sm Active info button pull-right" name="btTutorial"

                                data-target="#myModal" data-toggle="modal" type="button" disabled>Aprobar</button>

                        </td>

                    </tr>

                    @foreach($admitidos as $consulta)

                    <tr>

                        <td> <input type="checkbox" value="{{$consulta->id}}" name="aprobacion[]"

                                onclick="btTutorial.disabled = !this.checked"></td>

                        <td>{!!$consulta->Cedula!!}</td>

                        <td>{!!$consulta->PrimerNombre!!}&nbsp;&nbsp; {!!$consulta->SegundoNombre!!}</td>

                        <td>{!!$consulta->PrimerApellido!!}&nbsp;&nbsp;{!!$consulta->SegundoApellido!!}</td>

                        <td>{!!$consulta->NombEspecialidad!!}</td>

                        <td>{!!$consulta->Correo!!}</td>

                    </tr>

                    @endforeach

                </table>

                <!-- Aqui esta el modal -->

                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

                    <div class="modal-dialog" role="document">

                      <div class="modal-content">

                        <div class="modal-header">

                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                          <h4 class="modal-title" id="myModalLabel">Motivo</h4>

                        </div>

                        <div class="modal-body">

                          <textarea name="motivo" id="motivo" cols="70" rows="5"></textarea>

                        </div>

                        

                        <div class="modal-footer">

                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                          <button type="submit" class="btn btn-primary">Save changes</button>

                        </div>

                      </div>

                    </div>

                  </div>

            </form>

            <div class="pull-right">

                <?php

                        echo str_replace('/?', '?', $admitidos->render() )  ;

                    ?>

            </div>

        </div>

        @else

        <p> No hay datos cargados </p>

        @endif

    </div>

</div>

​

<script type="text/javascript">

    function marcar(source) {

        checkboxes = document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input

        for (i = 0; i < checkboxes.length; i++) //recoremos todos los controles

        {

            if (checkboxes[i].type == "checkbox") //solo si es un checkbox entramos

            {

                checkboxes[i].checked = source.checked;

                //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)

            }

        }

    }

    $("#chec").on("click", function () {

        $(".consulta").prop("checked", this.checked);

    });

</script>

<script type="text/javascript">

    $(document).ready(function () {

        $('.select2').select2();

    });

</script>

​

</body>

​

</html>

@endsection

