<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<fieldset style="border:4px">
	<table class="table" BGCOLOR= #FFFFFF  border="0" >
	
               <div class="box-header with-border">
            
        	{!!Form:: open(array('url'=>'Esperiencia', 'method'=>'POST', 'autocomplete'=> 'off')) !!}
			{{Form::token()}}
              <div class="box-body">
               	
<div class="col-md-6">
				 <div class="form-group{{ $errors->has('NombreInstitucion') ? ' has-error' : '' }}">
					{!! Form::label('NombreInstitucion', ' Institución donde Trabaja:')!!}
					{{ Form::select('NombreInstitucion', array('Nacional' => 'Nacional', 'Estatal' => 'Estatal','Municipal' => 'Municipal','Privada' => 'Privada'), null, ['class'=>'form-control','placeholder' => '--Seleccione--']) }}
					
						@if ($errors->has('NombreInstitucion'))
				                <span class="help-block">
				                    <strong>{{ $errors->first('NombreInstitucion') }}</strong>
				                </span>
				                @endif
					</div>
    


					<div class="form-group{{ $errors->has('AñoGraduado') ? ' has-error' : '' }}">
						{!!Form::label('AñoGraduado','Años de Graduado:')!!}
						{{ Form::select('AñoGraduado', array('1' => '1', '2' => '2','3' => '3','4' => '4','5' => '5','6' => '6','7' => '7','8' => '8','9' => '9','10' => '10'), null, ['class'=>'form-control','placeholder' => '--Seleccione--']) }}
						@if ($errors->has('AñoGraduado'))
						<span class="help-block">
								<strong>{{ $errors->first('AñoGraduado') }}</strong>
							</span>
						@endif
					</div>     

</div>


<div class="col-md-6">


	 <div class="form-group{{ $errors->has('AñoServicio') ? ' has-error' : '' }}">
     	{!!Form::label('AñoServicio','Años de Servicio:')!!}
  		{{ Form::select('AñoServicio', array('1' => '1', '2' => '2','3' => '3','4' => '4','5' => '5','6' => '6','7' => '7','8' => '8','9' => '9','10' => '10'), null, ['class'=>'form-control','placeholder' => '--Seleccione--']) }}
		@if ($errors->has('AñoServicio'))
           <span class="help-block">
                <strong>{{ $errors->first('AñoServicio') }}</strong>
            </span>
           @endif
      </div>     	


	  <div class="form-group{{ $errors->has('Estado_id') ? ' has-error' : '' }}">
                  {!!Form::label('Entidad Federal Plantel:')!!}
                  {{ Form::select('Estado_id', $estado, null, ['class'=>'form-control', 'placeholder' => '--Seleccione--']) }}

              @if ($errors->has('Estado_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('Estado_id') }}</strong>
                </span>
                @endif
              </div>


  </div>   
              <!-- /.box-body -->
              <div class="box-footer">
               <td colspan="2"><div class="form-group">
		<button class="btn btn-success pull-right" type="submit">Guardar</button></td>
		<td colspan="2"><a href="{{route('Esperiencia.index')}}" class="btn btn-danger ">Cancelar</a></td>
              </div>
              <!-- /.box-footer -->
           {!!Form::close()!!}
          
	</div>

	
</table>
</fieldset>

</div>

