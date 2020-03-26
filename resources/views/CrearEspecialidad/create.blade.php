@extends ('layouts.diseño')
@section ('contenido')
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-md-offset-2">
            <div class="panel panel-info">
 <div class="panel-heading"><center><h4><strong>Nuevo Programa</strong></center></div>

                    
                <div class="panel-body">
       {!!Form::open(['route' => 'NuevaEspecialidad.store'])!!}
            @include('CrearEspecialidad.fragment.form')

          {!!Form::close()!!}               
    </div>
</div>
</div> 
 @endsection 

  @section ('scripts')
<script type="text/javascript">

     $(document).ready( function () {
      $("#input").on("keypress", function () {
       $CodEspecialidad=$(this);
       setTimeout(function () {
        $CodEspecialidad.val($CodEspecialidad.val().toUpperCase());
       },50);
      })
     })
    </script>
    @endsection

   