<section class="content">
	
	{{Form::token()}}

 <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('sistemaEstudio') ? ' has-error' : '' }}">
                	{!!Form::label('sistemaEstudio','Sistema de Estudio:')!!}

                    {{ Form::select('sistemaEstudio', array('Regular' => 'Regular', 'EducacionAdultos' => 'Educaciòn Adultos', 'Otros' => 'Otros'), null, ['class'=>'form-control','placeholder' => '--Seleccione--']) }}
             	     @if ($errors->has('sistemaEstudio'))
                <span class="help-block">
                    <strong>{{ $errors->first('sistemaEstudio') }}</strong>
                </span>
                @endif
              </div>

                
          <div class="form-group{{ $errors->has('DependenciaPlantel') ? ' has-error' : '' }}">
            {!!Form::label('DependenciaPlantel','Dependencia del Plantel:')!!}

         {{ Form::select('DependenciaPlantel', array('Pública' => 'Pública', 'Privada' => 'Privada'), null, ['class'=>'form-control','placeholder' => '--Seleccione--']) }}
                @if ($errors->has('DependenciaPlantel'))
                <span class="help-block">
                    <strong>{{ $errors->first('DependenciaPlantel') }}</strong>
                </span>
                @endif
              </div>


        
                  
                      
      <div class="form-group{{ $errors->has('Municipio_id') ? ' has-error' : '' }}">
                  {!!Form::label('Municipio del Plantel:')!!}
                  {{ Form::select('Municipio_id', $municipio, null, ['class'=>'form-control', 'placeholder' => '--Seleccione--']) }}

              @if ($errors->has('Municipio_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('Municipio_id') }}</strong>
                </span>
                @endif
              </div>


              <div class="form-group{{ $errors->has('RamasEducacion_id') ? ' has-error' : '' }}">
            {!!Form::label('RamasEducacion_id',' Rama de Educación Media:')!!}

         {{ Form::select('RamasEducacion_id',$RamasMedia, null, ['class'=>'form-control','placeholder' => '--Seleccione--']) }}
                @if ($errors->has('RamasEducacion_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('RamasEducacion_id') }}</strong>
                </span>
                @endif
              </div>

              <div class="form-group{{ $errors->has('Promedio') ? ' has-error' : '' }}">
		            {!! Form::label('Promedio', ' Promedio')!!}
                {!! Form::text('Promedio', null, ['class'=> 'form-control', 'id'=> 'promedio']) !!}
                 

		          @if ($errors->has('Promedio'))
                <span class="help-block">
                    <strong>{{ $errors->first('Promedio') }}</strong>
                </span>
                @endif
              </div>



            </div>


            <!-- /.col -->
            <div class="col-md-6">
       
            



            <div class="form-group{{ $errors->has('TurnoEstudio') ? ' has-error' : '' }}">
                  {!! Form::label('TurnoEstudio', 'Turno de Estudio:')!!}

                  {{ Form::select('TurnoEstudio', array('Diurno' => 'Diurno', 'Nocturno'=>'Nocturno'), null, ['class'=>'form-control','placeholder' => '--Seleccione--']) }}
            
          @if ($errors->has('TurnoEstudio'))
                <span class="help-block">
                    <strong>{{ $errors->first('TurnoEstudio') }}</strong>
                </span>
                @endif
              </div>

              <div class="form-group{{ $errors->has('Estados_id') ? ' has-error' : '' }}">
                  {!!Form::label('Entidad Federal Plantel:')!!}
                  {{ Form::select('Estados_id', $estado, null, ['class'=>'form-control', 'placeholder' => '--Seleccione--']) }}

              @if ($errors->has('Estados_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('Estados_id') }}</strong>
                </span>
                @endif
              </div>

              <!-- /.form-group -->
              <div class="form-group{{ $errors->has('namePlantel') ? ' has-error' : '' }}">
                	{!! Form::label('namePlantel', 'Nombre del Plantel')!!}

					{!! Form::text('namePlantel', null, ['class'=> 'form-control']) !!}
					@if ($errors->has('namePlantel'))
                <span class="help-block">
                    <strong>{{ $errors->first('namePlantel') }}</strong>
                </span>
                @endif
              </div>



        	  <div class="form-group{{ $errors->has('NumeroRNI') ? ' has-error' : '' }}">
	        	{!! Form::label('NumeroRNI', 'Número RNI (RUSNIES o CNU):')!!}
				{!! Form::text('NumeroRNI', null, ['class'=> 'form-control']) !!}		
        	 	
        	 	@if ($errors->has('NumeroRNI'))
                <span class="help-block">
                    <strong>{{ $errors->first('NumeroRNI') }}</strong>
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
        
            <a href="{{route('Academico.index')}}" class="btn btn-danger pull-center">CANCELAR</a>
            </div>
          </div>

	
</section>

@section ('scripts')    
<script type ="text/javascript">

    $('.datepicker').datepicker({
        format: "dd/mm/yyyy",
        language: "es",
        autoclose: true
    });

    $(document).ready(function(){

   $('#promedio').mask('00.00');
  });

</script>

@endsection