<section>
<div class="row">
<div class="col-md-6 col-md-offset-3">    
         <div class="box box">
            
        <div class="box-body">
                
          <div class="form-group{{ $errors->has('ModoIngreso_Id') ? ' has-error' : '' }}">
                  {!!Form::label('Modalidad de Ingreso:')!!}
          
                  {{ Form::select('ModoIngreso_Id', $modingreso, null, ['class'=>'form-control', 'placeholder' => '.:Seleccione:.']) }}
    
                @if ($errors->has('ModoIngreso_Id'))
                <span class="help-block">
                    <strong>{{ $errors->first('ModoIngreso_Id') }}</strong>
                </span>
                @endif
              </div>

              <!-- /.form-group -->
              <div class="form-group{{ $errors->has('Institutos_id') ? ' has-error' : '' }}">
                  {!!Form::label('Institucion/Extención:')!!}
              {{ Form::select('Institutos_id', $sedeofertas, null, ['class'=>'form-control','id' =>'sede', 'placeholder' => '.:Seleccione:.']) }}    
          
               @if ($errors->has('Institutos_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('Institutos_id') }}</strong>
                </span>
                @endif
              </div>

  

        <div class="form-group{{ $errors->has('Especialidad_a_cursar1_id') ? ' has-error' : '' }}">
                  {!!Form::label('','Especialidad a Cursar 1')!!}
                 
                   {{ Form::select('Especialidad_a_cursar1_id', $especialidades, null, ['class'=>'form-control','id'=>'programa', 'placeholder' => '.:Seleccione:.']) }}
                   
                      
                    </select>
               
        
                 @if ($errors->has('Especialidad_a_cursar1_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('Especialidad_a_cursar1_id') }}</strong>
                </span>
                @endif  
              </div>

              <div class="form-group{{ $errors->has('Especialidad_a_cursar2_id') ? ' has-error' : '' }}">
                  {!!Form::label('','Especialidad a Cursar 2:')!!}
                 
                   {{ Form::select('Especialidad_a_cursar2_id', $especialidades, null, ['class'=>'form-control', 'id'=>'programa', 'placeholder' => '.:Seleccione:.']) }}
                   
                      
                    </select>
               
        
                 @if ($errors->has('Especialidad_a_cursar2_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('Especialidad_a_cursar2_id') }}</strong>
                </span>
                @endif  
              </div>

              <div class="form-group{{ $errors->has('Especialidad_a_cursar3_id') ? ' has-error' : '' }}">
                  {!!Form::label('','Especialidad a Cursar 3:')!!}
                   {{ Form::select('Especialidad_a_cursar3_id', $especialidades, null, ['class'=>'form-control','id'=>'programa', 'placeholder' => '.:Seleccione:.']) }}
                   
                      
                    </select>
               
        
                 @if ($errors->has('Especialidad_a_cursar3_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('Especialidad_a_cursar3_id') }}</strong>
                </span>
                @endif  
              </div>


                  <div class="col-md-6 col-md-offset-3">
              <button class="btn btn-success" type="submit" value="boton">Guardar</button>
        
            <a href="{{route('Datosbasicos.index')}}" class="btn btn-danger pull-center">CANCELAR</a>
              </div>


              </div>
          </div>

         </div>
      </div>
  </section>   

       {!!Form::close()!!}