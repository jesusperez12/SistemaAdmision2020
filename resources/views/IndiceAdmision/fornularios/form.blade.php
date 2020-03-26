<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">



  {!!Form::label('Indice Admision')!!}
     <div class="form-group{{ $errors->has('IDA') ? ' has-error' : '' }}">
     {!!Form::text('IDA', null, ['class' => 'form-control','id'=>'IDA'])!!} 
@if ($errors->has('IDA'))
               <span class="help-block">
               <strong>{{ $errors->first('IDA') }}</strong>
               </span>
              @endif 
</div>



 
  
        {!!Form::label('Especialidad')!!}
        <div class="form-group{{ $errors->has('Especialidad_id') ? ' has-error' : '' }}">
        {{ Form::select('Especialidad_id', $especialidades, null, ['class'=>'form-control','id' => 'especialidad', 'placeholder' => '.:Seleccione:.']) }}

 @if ($errors->has('Especialidad_id'))
               <span class="help-block">
               <strong>{{ $errors->first('Especialidad_id') }}</strong>
               </span>
              @endif 
</div>
   



</div>



<br><br><br><br><br>
<br><br><br><br>


<center>
<div class="form-group">
{!!Form::submit('GUARDAR', ['class' => 'btn btn-success'])!!} 
<a href="{{ route('ofertas.index') }}"  class="btn btn-danger pull-center">CANCELAR</a>
</div>
</center>



@section ('scripts')    
<script type ="text/javascript">


    $(document).ready(function(){

   $('#IDA').mask('00.00');
  });




</script>

@endsection