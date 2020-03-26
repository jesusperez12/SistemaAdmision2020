@extends ('layouts.diseño')
@section ('contenido')

     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-md-offset-2">
            <div class="panel panel-success">
   <div class="panel-heading"><center><h4><strong>Editar Periodo</strong></h4></center></div>
                    
                <div class="panel-body">

     {!!Form::model($periodos,['route' => ['NewPeriodo.update', $periodos->id], 'method' => 'PUT'])!!}
          
            @include('Periodo.fragment.editformadmin')

          {!!Form::close()!!}
              
    </div>
</div>
</div> 
 @endsection 


@section ('scripts')
  <script type ="text/javascript">

$(document).ready(function(){
  $('#periodo').mask('0000-0');
   $('#corte').mask('0000');
});

</script>
@endsection