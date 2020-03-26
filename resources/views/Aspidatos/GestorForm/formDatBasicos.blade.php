
	{!!Form:: open(array('route'=>'Datosbasicos.store', 'method'=>'POST', 'autocomplete'=> 'off')) !!}
	{{Form::token()}}

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">

            <div class="form-group{{ $errors->has('ModoIngreso_Id') ? ' has-error' : '' }}">
                	{!!Form::label('Modalidad de Ingreso:')!!}
  				
                <!--  {{ Form::select('ModoIngreso_Id', $modingreso, null, ['class'=>'form-control', 'id'=>'modoingre', 'placeholder' => '.:Seleccione:.']) }}
                 -->

                 <select name ="ModoIngreso_Id" class="form-control" id="modoingre"; placeholder="Seleccione";  onChange="nacional(event)">
                        <option value="false"  >Seleccione</option>
                        <option value="1" >Nuevo Ingreso Regular</option>
                        <option value="2" >Docente en Servicio No graduado</option>
                        <option value="4" >Equivalencia</option>
                        <option value="3" >Graduado Universitario</option>
                       </select>   
                @if ($errors->has('ModoIngreso_Id'))
                <span class="help-block">
                    <strong>{{ $errors->first('ModoIngreso_Id') }}</strong>
                </span>
                @endif
              </div>


              <div class="form-group has-error" id="mostrar">
             <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i><strong><big> Los aspirantes a ingresar en la modalidad de Egresado Universitario, 
             se les notifica que la Universidad sólo garantiza equivalencia a los títulos que son afines con la
             especialidad que seleccione</big></strong></label>
                </div>


  <div id="nacional">
              <div class="form-group{{ $errors->has('Banco_id') ? ' has-error' : '' }}">
                	{!!Form::label('Banco:')!!}
                  
                  {{ Form::select('Banco_id', $banco, null, ['class'=>'form-control', 'placeholder' => '.:Seleccione:.']) }}
  				       
              @if ($errors->has('Banco_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('Banco_id') }}</strong>
                </span>
                @endif
              </div>

              
              <!-- /.form-group -->
              <div class="form-group{{ $errors->has('NumDeposito') ? ' has-error' : '' }}">
                	{!! Form::label('NumDeposito', 'Numero de Deposito:')!!}
	
					{!! Form::text('NumDeposito', null, ['class'=> 'form-control']) !!}
          
              @if ($errors->has('NumDeposito'))
                <span class="help-block">
                    <strong>{{ $errors->first('NumDeposito') }}</strong>
                </span>
                @endif

              </div>

              <div class="form-group{{ $errors->has('deposito_confirm') ? ' has-error' : '' }}">
                	{!! Form::label('deposito_confirm', 'Comfirmar Numero de Deposito:')!!}
	
					{!! Form::text('deposito_confirm', null, ['class'=> 'form-control']) !!}
          
              @if ($errors->has('deposito_confirm'))
                <span class="help-block">
                    <strong>{{ $errors->first('deposito_confirm') }}</strong>
                </span>
                @endif

              </div>



              <div class="form-group{{ $errors->has('FechaDeposito') ? ' has-error' : '' }}">
                	{!! Form::label('FechaDeposito', 'Fecha de Deposito:')!!}

					           
                    <div class="form-group">

                            <div class="input-group">
                                {!! Form::text('FechaDeposito', null, ['id' => 'fechadeposito','class'=> 'form-control datepicker', 'placeholder' => 'DIA/MES/AÑOS...']) !!}
                               
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                        </div>

                
                 @if ($errors->has('FechaDeposito'))
                <span class="help-block">
                    <strong>{{ $errors->first('FechaDeposito') }}</strong>
                </span>
                @endif
            
              </div>

  </div>

            </div>

           

            <!-- /.col -->
            <div class="col-md-6">
             
              
              <div class="form-group{{ $errors->has('cupos_dirigidos_id') ? ' has-error' : '' }}">
                	{!!Form::label('',' Cupos Dirigidos a:')!!}
                  {{ Form::select('cupos_dirigidos_id', array(), null, ['class'=>'form-control','id'=>'cuposdirigidos', 'placeholder' => '.:Seleccione:.']) }}
  			
                 @if ($errors->has('cupos_dirigidos_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('cupos_dirigidos_id') }}</strong>
                </span>
                @endif  
              </div>
             
            



              <!-- /.form-group -->
              <div class="form-group{{ $errors->has('Institutos_id') ? ' has-error' : '' }}">
                	{!!Form::label('Institucion/Extención:')!!}
              {{ Form::select('Institutos_id', array(), null, ['class'=>'form-control','id' =>'sede', 'placeholder' => '.:Seleccione:.']) }}    
  				
               @if ($errors->has('Institutos_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('Institutos_id') }}</strong>
                </span>
                @endif
              </div>

              <div class="form-group{{ $errors->has('Especialidad_a_cursar1_id') ? ' has-error' : '' }}">
                  {!!Form::label('Especialidad a cursar 1 opción:')!!}
                  <!-- {{ Form::select('Especialidad_a_cursar1_id', array(), null, ['class'=>'form-control','id'=>'curso1', 'placeholder' => 'Seleccione:']) }}-->
                  <select name="Especialidad_a_cursar1_id" id="curso1" class="form-control" placeholder="Seleccione:" >
                  <option value="">Seleccione</option>
                  </select>

                  @if ($errors->has('Especialidad_a_cursar1_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('Especialidad_a_cursar1_id') }}</strong>
                </span>
                @endif
              </div>

              <div class="form-group{{ $errors->has('Especialidad_a_cursar2_id') ? ' has-error' : '' }}">
                  {!!Form::label(' Especialidad a cursar 2 opción:')!!}
                 <!--  {{ Form::select('Especialidad_a_cursar2_id', array(), null, ['class'=>'form-control','id'=>'curso2', 'placeholder' => '.:Seleccione:.']) }} -->
                  <select name="Especialidad_a_cursar2_id" id="curso2" class="form-control" placeholder="Seleccione:" >
                  <option value="">Seleccione</option>
                  </select>
               @if ($errors->has('Especialidad_a_cursar2_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('Especialidad_a_cursar2_id') }}</strong>
                </span>
                @endif
              </div>
  

        <div class="form-group{{ $errors->has('Especialidad_a_cursar3_id') ? ' has-error' : '' }}">
                	{!!Form::label('',' Especialidad a cursar 3 opción:')!!}
                 <!--  {{ Form::select('Especialidad_a_cursar3_id', array(), null, ['class'=>'form-control','id'=>'curso3', 'placeholder' => '.:Seleccione:.']) }} -->
                  <select name="Especialidad_a_cursar3_id" id="curso3" class="form-control" placeholder="Seleccione:" >
                  <option value="">Seleccione</option>
                  </select>
                 @if ($errors->has('Especialidad_a_cursar3_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('Especialidad_a_cursar3_id') }}</strong>
                </span>
                @endif  
              </div>

               

              		 
            </div>
            	 
             </div>
            	
          </div>

           <div class="col-md-12">     
                 <div class="col-md-12 col-md-offset-5">
            <tr>
            <th>        
            <button class="btn btn-success" type="submit" value="boton">GUARDAR</button>
        
            <a href="{{route('Datosbasicos.index')}}" class="btn btn-danger pull-center">CANCELAR</a>
            </div>
          </div>
       {!!Form::close()!!}
     
 
