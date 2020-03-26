
 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
                   
                <div class="panel-body">

<div class="form-group col-md-12">
{!!Form::label('Programas')!!}
   <div class="form-group{{ $errors->has('Programas_id') ? ' has-error' : '' }}">


      {{ Form::select('Programas_id', $programas, null, ['class'=>'form-control','id'=>'programa','placeholder' => '.:Seleccione:.']) }}
@if ($errors->has('Programas_id'))
                <span class="help-block">
                <strong>{{ $errors->first('Programas_id') }}</strong>
                </span>
               @endif   
</div>
</div>

  <div class="col-md-6">
               
            {!!Form::label('codigo','Codigo')!!}    
           <div class="form-group{{ $errors->has('CodEspecialidad') ? ' has-error' : '' }}"> 
           {!!Form::text('CodEspecialidad', null, ['class' => 'form-control', 'id' => 'input',])!!} 
           @if ($errors->has('CodEspecialidad'))
              <span class="help-block">
              <strong>{{ $errors->first('CodEspecialidad') }}</strong>
               </span>
          @endif
       </div>
   </div>
 <div class="col-md-6">
               
            {!!Form::label('NombEspecialidad','SubPrograma')!!}    
           <div class="form-group{{ $errors->has('NombEspecialidad') ? ' has-error' : '' }}"> 
           {!!Form::text('NombEspecialidad', null, ['class' => 'form-control'])!!} 
           @if ($errors->has('NombEspecialidad'))
              <span class="help-block">
              <strong>{{ $errors->first('NombEspecialidad') }}</strong>
               </span>
          @endif
       </div>
   </div>

  

</div>
<center>
<div class="form-group col-md-12">
<tr>
<th>        
{!!Form::submit('GUARDAR', ['class' => 'btn btn-success'])!!}
<a href="{{ route('EspecialidadNew.index') }}" class="btn btn-danger  pull-center">CANCELAR</a>
</div>
</th>
</tr>
</center>
                {!!Form::close()!!}
 