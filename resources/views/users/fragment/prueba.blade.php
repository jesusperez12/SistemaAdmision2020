

                      <table align="center" border="1">

                       
              <div class="form-group col-md-12">
                      
                        {!!Form::label('Sedes')!!}
                        <select name ="sede_id" id="sede" class="form-control">
                         <option>--Seleccione--</option>
                        @foreach($sed as $sede)

                         <option value="{{$sede->id_sede}}">{{$sede->NombSede}}</option>
                        @endforeach
                        </select>
                        
                        </div>
                         <br>

                         <div class="form-group col-md-12">
                             <label>Núcleos</label>
                            <select id="nucle" class="form-control select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" name="nucleos[]">
                
                            </select>
                            </div>                        
                <div class="col-md-6">
                <div class="form-group{{ $errors->has('rols_id') ? ' has-error' : '' }}">
                        <label>Roles</label>
                        <select  name ="rols_id" class="form-control">

                        <option value="">--Seleccione--</option>
                          @if (Auth::user()->rols_id == '1')
                <option value="1">Super Administrador</option>
                 <option value="2">Administrador</option>
                <option value="3">Cordinador</option>
                @endif

                 @if (Auth::user()->rols_id == '2')
                <option value="2">Administrador</option>
                <option value="3">Cordinador</option>
             @endif
              </select>
                 </div>   </div>



            
               
               <div class="col-md-6">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-6 control-label">Nombres del usuario</label>
                            
                           
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif 
                            </div>
                        </div>

                          <div class="col-md-6">
                         <div class="form-group{{ $errors->has('Apellidos') ? ' has-error' : '' }}">
                            <label for="Apellidos" class="col-md-6 control-label">Apellidos del usuario</label>
                                
                          
                                <input id="name" type="text" class="form-control" name="Apellidos" value="{{ old('Apellidos') }}" required autofocus>

                                @if ($errors->has('Apellidos'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Apellidos') }}</strong>
                                    </span>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group{{ $errors->has('cedula') ? ' has-error' : '' }}">
                            <label for="cedula" class="col-md-6 control-label">Cédula</label>

                            
                                <input id="cedula" type="text" class="form-control" name="cedula" value="{{ old('cedula') }}" required autofocus>

                                @if ($errors->has('cedula'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cedula') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-6 control-label">E-Mail</label>

                            
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                                  

                        
                      
                      
                        <div class="col-md-6">
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-6 control-label">Password</label>

                            
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="col-md-6">
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-6 control-label">Confirm Password</label>

                           
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                       

               
                             </table>
                         <center>
                           
                      <button class="btn btn-primary" type="submit">Guardar</button>
                         &nbsp;&nbsp;<a href="{{ route('users.index') }}" class="btn btn-primary active">CANCELAR</a>
                          </center>




    