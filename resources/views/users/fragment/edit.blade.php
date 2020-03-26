       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-info">
                <div class="panel-heading"><center><h5><strong>Editar Usuario</strong> </h5></center> </div>
       <div class="panel-body">

   
              
             <table align="center" border="0">

                       
<div class="form-group col-md-12">
   
          {!!Form::label('Institutos/Extenciones')!!}
           <div class="form-group{{ $errors->has('sede_id') ? ' has-error' : '' }}">
          {{ Form::select('sede_id', $sed, null, [ 'class'=>'form-control','id'=>'sede', 'placeholder' => '.:Seleccione:.'] ) }}
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
          <div class="form-group{{ $errors->has('rols_id') ? ' has-error' : '' }}">
     
          <select name="role" class="form-control" required>
    <option value="{{ $user->getRolId() }}" selected>
        {{ $user->getRolNombre() }}
    </option>
    @foreach($roles as $role)
        <option value="{{ $role->id }}"
            @if (old('role') === $role->id){{ 'selected' }}@endif>
            {{ $role->name }}
        </option>
    @endforeach
</select>

          
         @if ($errors->has('rols_id'))
               <span class="help-block">
             <strong>{{ $errors->first('rols_id') }}</strong>
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

                                                       
  

                       

    </table>
                         
<center>

    <button type="submit" class="btn btn-success ">GUARDAR</button>
                
                <a href="{{ route('users.index') }}" class="btn btn-danger active">CANCELAR</a>
</center>
</div></div>
          {!!Form::close()!!}     


  
