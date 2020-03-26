
       <div class="form-group col-md-12" >
   <div class="form-group{{ $errors->has('sede_id') ? ' has-error' : '' }}">

      {!!Form::label('Institutos/Extensiones')!!}
       {{ Form::select('Institutos_id', $sedes, null, ['class'=>'form-control']) }}
              
          @if ($errors->has('sede_id'))
                <span class="help-block">
                <strong>{{ $errors->first('sede_id') }}</strong>
                </span>
               @endif   
               </div> 
</div>


<div class="form-group col-md-12">
{!!Form::label('Especialidades')!!}
{{  Form::select('Especialidad_id', $especialidades, null, ['class'=>'form-control']) }}

      
</div>


<div class="form-group col-md-12">
{!!Form::label('Periodo')!!}
{{ Form::select('Periodo_id', $per, null, ['class'=>'form-control']) }}

</div>



 <div class="form-group col-md-12" > 
     {!!Form::label(' Vigente')!!}
      {{ Form::select('Vigente', array('Activo' => 'Activo', 'No Activo' => 'No Activo'), null, ['class'=>'form-control']) }}

    
       
     </div>
<center>
<div class="form-group col-md-12">
{!!Form::submit('GUARDAR', ['class' => 'btn btn-success'])!!}
<a href="{{ route('Especialidad.index') }}" class="btn btn-danger pull-center">CANCELAR</a>
</div>
</center>
<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2();
    });

</script>

