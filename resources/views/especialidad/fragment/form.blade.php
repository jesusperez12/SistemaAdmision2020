

 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
                   
                <div class="panel-body">

            

         <div class="form-group col-md-12" >
          {!!Form::label('Institutos/Extensiones')!!}
   <div class="form-group{{ $errors->has('Institutos_id') ? ' has-error' : '' }}">

     
       {{ Form::select('Institutos_id', $sedes, null, ['class'=>'form-control','id'=>'sede', 'placeholder' => '.:Seleccione:.']) }}
              
          @if ($errors->has('Institutos_id'))
                <span class="help-block">
                <strong>{{ $errors->first('Institutos_id') }}</strong>
                </span>
               @endif   
               </div> 
</div>

 
<div class="form-group col-md-12">
{!!Form::label('Especialidades')!!}
   <div class="form-group{{ $errors->has('Especialidad_id') ? ' has-error' : '' }}">

   {{ Form::select('Especialidad_id[]',  $especialidades,null, ['id' => 'nucle', 'class' => 'form-control select2', 'multiple' => 'multiple', 'data-placeholder' => '', 'style' => 'width: 100%;']) }}
 
@if ($errors->has('Especialidad_id'))

                <span class="help-block">
                <strong>{{ $errors->first('Especialidad_id') }}</strong>
                </span>
               @endif   
</div>
</div>



<div class="form-group col-md-12">
 {!!Form::label('Periodo')!!}
   <div class="form-group{{ $errors->has('Periodo_id') ? ' has-error' : '' }}">
   
           {{ Form::select('Periodo_id', $per, null, ['class'=>'form-control','placeholder' => '.:Seleccione:.']) }}
              @if ($errors->has('Periodo_id'))
                <span class="help-block">
                <strong>{{ $errors->first('Periodo_id') }}</strong>
                </span>
               @endif   
</div>
</div>


 <div class="form-group col-md-12"> 
    {!!Form::label(' Vigente')!!}
   <div class="form-group{{ $errors->has('Vigente') ? ' has-error' : '' }}">
   
     {{ Form::select('Vigente', array('Activo' => 'Activo', 'No Activo' => 'No Activo'), null, ['class'=>'form-control','placeholder' => '.:Seleccione:.']) }}
       
        @if ($errors->has('Vigente'))
                <span class="help-block">
                <strong>{{ $errors->first('Vigente') }}</strong>
                </span>
               @endif
     </div>
</div></div>
<center>
<div class="form-group col-md-12">
<tr>
<th>        
{!!Form::submit('GUARDAR', ['class' => 'btn btn-success'])!!}
<a href="{{ route('Especialidad.index') }}" class="btn btn-danger  pull-center">CANCELAR</a>
</div>
</th>
</tr>
</center>
                {!!Form::close()!!}
 