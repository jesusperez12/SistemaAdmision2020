<section>
<div class="row">
<div class="col-md-6 col-md-offset-3">    
         {!!Form:: open(array('url'=>'DatosAspirante', 'method'=>'POST', 'autocomplete'=> 'off')) !!}
        {{Form::token()}} 
        <div class="box-body">
                
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
                  
                    <div class="form-group">
                            <label for="date">Fecha de Nacimiento</label>
                            <div class="form-group-addon">
                                <input type="text" name="FechaDeposito" id="fechadeposito" value="{{ $fechad}}">
                                
                                    <span class="glyphicon glyphicon-th"></span>
                               
                            </div>
                        </div>
                               
                        


                 @if ($errors->has('FechaDeposito'))
                <span class="help-block">
                    <strong>{{ $errors->first('FechaDeposito') }}</strong>
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
      
  </section>  
 {!!Form::close()!!}
  @section ('scripts')    
<script type ="text/javascript">
    $('#fechadeposito').datepicker({
        format: "dd/mm/yyyy",
        language: "es",
        autoclose: true
    });

      $(document).ready(function(){
  $('#fechadeposito').mask('00/00/0000');

  });

</script>

@endsection