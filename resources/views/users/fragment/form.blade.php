  <table align="center" border="1">

                       
<div class="form-group col-md-12">
          {!!Form::label('Institutos/Extenciones')!!}
   <div class="form-group{{ $errors->has('sede_id') ? ' has-error' : '' }}">
          
          {{ Form::select('sede_id', $sed, null, ['class'=>'form-control','id'=>'sede', 'placeholder' => '.:Seleccione:.']) }}
              @if ($errors->has('sede_id'))
                <span class="help-block">
                <strong>{{ $errors->first('sede_id') }}</strong>
                </span>
               @endif
       </div>
</div>
                         <br>



 <div class="form-group col-md-12">
   {!!Form::label('Roles')!!}
        <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
        @role('admin')
    {{ Form::select('roles[]', $rols, null, ['class'=>'form-control','placeholder' => '.:Seleccione:.']) }}
    @endrole
    
    @role('secretaria')
    {{ Form::select('roles[]', $roli, null, ['class'=>'form-control','placeholder' => '.:Seleccione:.']) }}
    @endrole
            </select>
             @if ($errors->has('role_id'))
               <span class="help-block">
             <strong>{{ $errors->first('role_id') }}</strong>
                </span>
           @endif
      </div>   

    </div>



            
               
    <div class="col-md-6">
               
            {!!Form::label('name','Nombres del usuario')!!}    
           <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"> 
           {!!Form::text('name', null, ['class' => 'form-control'])!!} 
           @if ($errors->has('name'))
              <span class="help-block">
              <strong>{{ $errors->first('name') }}</strong>
               </span>
          @endif
       </div>
   </div>

 <div class="col-md-6">
                       
      
       {!!Form::label('Apellidos','Apellidos del usuario')!!}
       <div class="form-group{{ $errors->has('Apellidos') ? ' has-error' : '' }}"> 
      {!!Form::text('Apellidos', null, ['class' => 'form-control'])!!}
          @if ($errors->has('Apellidos'))
               <span class="help-block">
             <strong>{{ $errors->first('Apellidos') }}</strong>
                </span>
           @endif
                            </div>
                        </div>

   <div class="col-md-6">
                        
       {!!Form::label('cedula','Cedula')!!}
       <div class="form-group{{ $errors->has('cedula') ? ' has-error' : '' }}"> 
       {!!Form::text('cedula', null, ['class' => 'form-control'])!!}     
                   @if ($errors->has('cedula'))
               <span class="help-block">
             <strong>{{ $errors->first('cedula') }}</strong>
                </span>
           @endif
                            </div>
                        </div>

   <div class="col-md-6">
       {!!Form::label('email','E-Mail')!!}                                 
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
       {!!Form::email('email', null, ['class' => 'form-control'])!!}                     
        @if ($errors->has('email'))
               <span class="help-block">
             <strong>{{ $errors->first('email') }}</strong>
                </span>
           @endif
                            </div>
                        </div>

                                                       
  
                        <div class="col-md-6">
                       
                                 {!!Form::label('password','Password')!!}   
 <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            
                                <input id="password" type="password" class="form-control" name="password" >

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="col-md-6">
                        <div class="form-group">
                          {!!Form::label('password-confirm','Confirmar Password')!!}  

                           
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                            </div>
                        </div>

                       

               
                             </table>
                         <center>
                           
                      {!!Form::submit('GUARDAR', ['class' => 'btn btn-success'])!!} 
                         &nbsp;&nbsp;<a href="{{ route('users.index') }}" class="btn btn-danger active">CANCELAR</a>
                          </center>
                          <br>


   
