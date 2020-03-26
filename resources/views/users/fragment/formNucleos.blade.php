
  <div class="col-md-6">
          <div class="form-group{{ $errors->has('cedula') ? ' has-error' : '' }}">              
       {!!Form::label('cedula','Cedula:')!!}
   
       {!!Form::text('cedula', null, [ 'disabled' => 'disabled', 'class' => 'form-control'])!!}  
              @if ($errors->has('sede_id'))
                <span class="help-block">
                <strong>{{ $errors->first('cedula') }}</strong>
                </span>
               @endif
       </div>   
 </div>


<div class="col-md-6">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"> 
              
            {!!Form::label('name','Nombres del usuario:')!!}  
            
           {!!Form::text('name', null, ['disabled' => 'disabled', 'class' => 'form-control'])!!} 
                @if ($errors->has('sede_id'))
                <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
                </span>
               @endif
       </div>  
   </div>


<div class="form-group col-md-12">
 {!!Form::label('Institutos/Extenciones')!!}
        <div class="form-group{{ $errors->has('sede_id') ? ' has-error' : '' }}">
         
          <select name="sede_id" class="form-control" id="sede">
                    @foreach($sed as $se)
                    <option value="">.:Seleccione:.</option>
                    <option value="{{$se->id_sede}}"> {{$se->NombSede}}</option>
                    @endforeach
         </select>

       @if ($errors->has('sede_id'))
                <span class="help-block">
                <strong>{{ $errors->first('sede_id') }}</strong>
                </span>
               @endif
       </div>    
</div>
                         <br>




   <div class="col-md-12">
     <label>Institutos</label>
                  <div class="form-group{{ $errors->has('nucleos') ? ' has-error' : '' }}">

        
        {{ Form::select('nucleos[]', array(),null, ['id' => 'nucle', 'class' => 'form-control select2', 'multiple' => 'multiple', 'data-placeholder' => '', 'style' => 'width: 100%;']) }}
      @if ($errors->has('nucleos'))
                <span class="help-block">
                <strong>{{ $errors->first('nucleos') }}</strong>
                </span>
               @endif
       </div>     
  </div>  
<div class="col-md-12">
<center>
   {!!Form::submit('GUARDAR', ['class' => 'btn btn-success'])!!} 
  
  &nbsp;&nbsp;<a href="{{ route('users.index') }}" class="btn btn-danger active">CANCELAR</a>
</center>
  </div>