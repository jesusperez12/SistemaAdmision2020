<section class="content">
	
 <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('TiposTitulos_id') ? ' has-error' : '' }}">
                	{!!Form::label('TiposTitulos_id','Título:')!!}

            {{ Form::select('TiposTitulos_id', $titulo, null, ['class'=>'form-control', 'placeholder' => 'Seleccione...']) }}
             	     @if ($errors->has('TiposTitulos_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('TiposTitulos_id') }}</strong>
                </span>
                @endif
              </div>

               <div class="form-group{{ $errors->has('TituloCarrera') ? ' has-error' : '' }}">
                  {!! Form::label('TituloCarrera', 'Título de Carrera')!!}

          {!! Form::text('TituloCarrera', null, ['class'=> 'form-control']) !!}
          @if ($errors->has('TituloCarrera'))
                <span class="help-block">
                    <strong>{{ $errors->first('TituloCarrera') }}</strong>
                </span>
                @endif
              </div>



              <!-- /.form-group -->
              <div class="form-group{{ $errors->has('Universidad') ? ' has-error' : '' }}">
                	{!! Form::label('Universidad', 'Universidad')!!}

					{!! Form::text('Universidad', null, ['class'=> 'form-control']) !!}
					@if ($errors->has('Universidad'))
                <span class="help-block">
                    <strong>{{ $errors->first('Universidad') }}</strong>
                </span>
                @endif
              </div>

              <div class="form-group{{ $errors->has('FechaInicio') ? ' has-error' : '' }}">
                	{!! Form::label('FechaInicio', 'Fecha de Inicio')!!}

                <div class="input-group">
                  <input type="text" class="form-control datepicker" name="FechaInicio" value="{{ $fechaini}}">
                  <div class="input-group-addon">
                 <span class="glyphicon glyphicon-th"></span>
                  </div>
                </div>



	
				

					@if ($errors->has('FechaInicio'))
                <span class="help-block">
                    <strong>{{ $errors->first('FechaInicio') }}</strong>
                </span>
                @endif
              </div>



              <div class="form-group{{ $errors->has('fechaCulminacion') ? ' has-error' : '' }}">
	
				{!! Form::label('fechaCulminacion', 'Fecha de Culminación')!!}
          <div class="input-group">
                  <input type="text" class="form-control datepicker" name="fechaCulminacion" value="{{ $fechacul}}">
                  <div class="input-group-addon">
                 <span class="glyphicon glyphicon-th"></span>
                  </div>
                </div>


		
				@if ($errors->has('fechaCulminacion'))
                <span class="help-block">
                    <strong>{{ $errors->first('fechaCulminacion') }}</strong>
                </span>
                @endif
				</div>

         <div class="form-group{{ $errors->has('FechaGrado') ? ' has-error' : '' }}">
  
        {!! Form::label('FechaGrado', 'Fecha de Grado')!!}
           <div class="input-group">
                  <input type="text" class="form-control datepicker" name="FechaGrado" value="{{ $fechagra}}">
                  <div class="input-group-addon">
                 <span class="glyphicon glyphicon-th"></span>
                  </div>
                </div>
                
    
        @if ($errors->has('FechaGrado'))
                <span class="help-block">
                    <strong>{{ $errors->first('FechaGrado') }}</strong>
                </span>
                @endif
        </div>


            </div>


            <!-- /.col -->
            <div class="col-md-6">
           
                      
      <div class="form-group{{ $errors->has('PaisEstudio_id') ? ' has-error' : '' }}">
                  {!!Form::label('País de Estudio:')!!}
                  {{ Form::select('PaisEstudio_id', $pais, null, ['class'=>'form-control', 'placeholder' => '--Seleccione--']) }}

              @if ($errors->has('PaisEstudio_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('PaisEstudio_id') }}</strong>
                </span>
                @endif
              </div>

              
          <div class="form-group{{ $errors->has('tipoOrganizacion') ? ' has-error' : '' }}">
            {!!Form::label('tipoOrganizacion','Tipo de Organización:')!!}

         {{ Form::select('tipoOrganizacion', array('Pública' => 'Pública', 'Privada' => 'Privada'), null, ['class'=>'form-control','placeholder' => '--Seleccione--']) }}
                @if ($errors->has('tipoOrganizacion'))
                <span class="help-block">
                    <strong>{{ $errors->first('tipoOrganizacion') }}</strong>
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



              <div class="form-group{{ $errors->has('Escala') ? ' has-error' : '' }}">
	              {!!Form::label('Escala:')!!}
               {{ Form::select('Escala', array('1-4' => '1-4', '1-9' => '1-9', '1-10' => '1-10', '1-20' => '1-20'), null, ['class'=>'form-control','placeholder' => '--Seleccione--']) }} 

                @if ($errors->has('Escala'))
                <span class="help-block">
                    <strong>{{ $errors->first('Escala') }}</strong>
                </span>
                @endif
             </div>

        	  <div class="form-group{{ $errors->has('PuestoPromocion') ? ' has-error' : '' }}">
	        	{!! Form::label('PuestoPromocion', 'Puesto de Promoción')!!}
				{!! Form::text('PuestoPromocion', null, ['class'=> 'form-control']) !!}		
        	 	
        	 	@if ($errors->has('PuestoPromocion'))
                <span class="help-block">
                    <strong>{{ $errors->first('PuestoPromocion') }}</strong>
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
            <button class="btn btn-success" type="submit" value="boton">Guardar</button>
        
            <a href="{{route('DatosAcademicos.index')}}" class="btn btn-danger pull-center">CANCELAR</a>
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
  $('.datepicker').mask('00/00/0000');
  $('.datepicker').mask('00/00/0000');
   $('.datepicker').mask('00/00/0000');

  });

  $(document).ready(function(){

$('#promedio').mask('00.00');
});

</script>

@endsection