<section> 
<div id="main">
        
            <!-- /.box-header -->
            <!-- form start -->
              {!!Form:: open(array('url'=>'DatosAspirante', 'method'=>'POST', 'autocomplete'=> 'off')) !!}
        {{Form::token()}} 
    


        <div class="box box-primary">
        <div class="box-header with-border">
         
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
             <div class="form-group{{ $errors->has('Nacionalidad') ? ' has-error' : '' }} ">
               
                {!!Form::label('Nacionalidad','Nacionalidad:')!!}
                  
                     <select name ="Nacionalidad" class="form-control" onChange="nacional(event)">
                        <option value="false" >Seleccione</option>
                        <option value="venezolano" >Venezolano</option>
                        <option value="extranjero" >Extranjero</option>
                       </select>   
                         @if ($errors->has('Nacionalidad'))
                            <span class="help-block">
                            <strong>{{ $errors->first('Nacionalidad') }}</strong>
                            </span>
                        @endif
              </div>
            
              <div id="nacional">
              <div class="form-group{{ $errors->has('Cedula') ? ' has-error' : '' }}  " v-show="Vene" gender="Venezolano" id="prueba">
            {!! Form::label('Identificacion', 'Identificación:')!!}
            {!! Form::text('Cedula', null, ['class'=> 'form-control','id'=>'Cedula','placeholder'=>'Cedula']) !!} 
             @if ($errors->has('Cedula'))
                            <span class="help-block">
                            <strong>{{ $errors->first('Cedula') }}</strong>
                            </span>
                        @endif                  
            </div>
            </div>
            <div id="extranjero">          
            <div class="form-group" >
            {!! Form::label('pasaporte', 'Identificación:')!!}
            {!! Form::text('pasaporte', null, ['class'=> 'form-control','id'=>'pasaporte','placeholder'=>'Pasaporte']) !!} 
            </div>
          
             
          </div>
            
            <div class="form-group">
                   {!!Form::label('','Primer Nombre:')!!}
                  </div>           
             
                 <div class="form-group{{ $errors->has('PrimerNombre') ? ' has-error' : '' }}">
                  
          {!! Form::text('PrimerNombre', null,  ['class'=> 'form-control', 'id' => 'name','placeholder'=>'']) !!}  

          @if ($errors->has('PrimerNombre'))
                            <span class="help-block">
                            <strong>{{ $errors->first('PrimerNombre') }}</strong>
                            </span>
                        @endif        
          </div>
                  



          <div class="form-group">
          {!! Form::label('SegundoNombre', 'Segundo Nombre:')!!}
          </div>
            <div class="form-group{{ $errors->has('SegundoNombre') ? ' has-error' : '' }}">
          {!! Form::text('SegundoNombre', null, ['class'=> 'form-control', 'id' => 'namesegundo','placeholder'=>'']) !!}   
           @if ($errors->has('SegundoNombre'))
                            <span class="help-block">
                            <strong>{{ $errors->first('SegundoNombre') }}</strong>
                            </span>
                        @endif      
          </div>
          




                  <div class="form-group">
            {!! Form::label('PrimerApellido', 'Primer Apellido:')!!}
            </div>
            <div class="form-group {{ $errors->has('PrimerApellido') ? ' has-error' : '' }}">
            {!! Form::text('PrimerApellido', null, ['class'=> 'form-control','id' => 'apellido','placeholder'=>'']) !!}
            @if ($errors->has('PrimerApellido'))
                            <span class="help-block">
                            <strong>{{ $errors->first('PrimerApellido') }}</strong>
                            </span>
                        @endif
          </div>
          



            <div class="form-group">
  
            {!! Form::label('SegundoApellido', 'Segundo Apellido:')!!}
            </div>
            <div class="form-group{{ $errors->has('SegundoApellido') ? ' has-error' : '' }}">
            {!! Form::text('SegundoApellido', null, ['class'=> 'form-control','id' => 'apellidoDos','placeholder'=>'']) !!}
            @if ($errors->has('SegundoApellido'))
                            <span class="help-block">
                            <strong>{{ $errors->first('SegundoApellido') }}</strong>
                            </span>
                        @endif
 
            </div>
                       
           
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
          
            <div class="form-group{{ $errors->has('PaisNacimiento_id') ? ' has-error' : '' }}">
        {!!Form::label('País de Nacimiento:')!!}
        {{ Form::select('PaisNacimiento_id', $pais, null, ['class'=>'form-control', 'placeholder' => 'Seleccione una Opción...']) }}
             @if ($errors->has('PaisNacimiento_id'))
                            <span class="help-block">
                            <strong>{{ $errors->first('PaisNacimiento_id') }}</strong>
                            </span>
              @endif
       </div>
              


     {!!Form::label('Pais_id','País de Origen:')!!}
               <div class="form-group">
              {{ Form::select('PaisOrigen_id', $pais, null, ['class'=>'form-control', 'placeholder' => 'Seleccione una Opción...']) }}
              
            </div>
            
              <div class="form-group{{ $errors->has('Estados_id') ? ' has-error' : '' }}">
            {!!Form::label('Estado:')!!}
            
            {{ Form::select('Estados_id', $estado, null, ['class'=>'form-control','id'=>'estado', 'placeholder' => 'Seleccione una Opción...']) }}
          
                  @if ($errors->has('Estados_id'))
                            <span class="help-block">
                            <strong>{{ $errors->first('Estados_id') }}</strong>
                            </span>
              @endif
          </div>
               
               
          <div class="form-group{{ $errors->has('Municipios_id') ? ' has-error' : '' }}">
             <li id="munii">
             {!!Form::label('Municipio:')!!}
             </li>
              {{ Form::select('Municipios_id', $municipio, null, ['class'=>'form-control','id'=>'Muni', 'placeholder' => 'Seleccione una Opción...']) }}
                @if ($errors->has('Municipios_id'))
                            <span class="help-block">
                            <strong>{{ $errors->first('Municipios_id') }}</strong>
                            </span>
              @endif
              </div>

              
               <div class="form-group{{ $errors->has('Parroquias_id') ? ' has-error' : '' }}">
               <li id="parroo">
                 {!!Form::label('Parroquia:')!!}
                 </li>
              {{ Form::select('Parroquias_id',$parroquia, null, ['class'=>'form-control','id'=>'parroquia', 'placeholder' => 'Seleccione una Opción...']) }}
             
                 @if ($errors->has('Parroquias_id'))
                            <span class="help-block">
                            <strong>{{ $errors->first('Parroquias_id') }}</strong>
                            </span>
              @endif
              </div>
            
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
    
      </div>





 <div class="box box-primary">
        <div class="box-header with-border">
         
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">

              
            <div class="form-group">
        {!!Form::label('Discapacidad:')!!}
        </div>
    <div class="form-group {{ $errors->has('Genero') ? ' has-error' : '' }}"> 
      {{ Form::select('discapacidad_id', $discapacidad, null, ['class'=>'form-control','placeholder' => '--Seleccione--']) }}
     
           @if ($errors->has('Genero'))
                            <span class="help-block">
                            <strong>{{ $errors->first('Genero') }}</strong>
                            </span>
              @endif
    </div>

             
             <div class="form-group">
        {!!Form::label('Genero:')!!}
        </div>
    <div class="form-group {{ $errors->has('Genero') ? ' has-error' : '' }}"> 
      {{ Form::select('Genero', array('Masculino' => 'Masculino', 'Femenino' => 'Femenino'), null, ['class'=>'form-control','placeholder' => '--Seleccione--']) }}
     
           @if ($errors->has('Genero'))
                            <span class="help-block">
                            <strong>{{ $errors->first('Genero') }}</strong>
                            </span>
              @endif
    </div>

          <div class="form-group">
               {!!Form::label('Estado Civil:')!!}
               </div>
              <div class="form-group {{ $errors->has('EstadoCivil') ? ' has-error' : '' }}"> 
            {{ Form::select('EstadoCivil', array('Casado(a)' => 'Casado(a)', 'Soltero(a)' => 'Soltero(a)', 'Viudo(a)' => 'Viudo(a)', 'Divorciado(a)' => 'Divorciado(a)'), null, ['class'=>'form-control','placeholder' => '--Seleccione--']) }}
          
               @if ($errors->has('EstadoCivil'))
                                      <span class="help-block">
                                      <strong>{{ $errors->first('EstadoCivil') }}</strong>
                                      </span>
                        @endif                  
          </div>




                    <div class="form-group" >
               {!!Form::label('Etnias_id','Etnia:')!!}
               </div>
        <div class="form-group {{ $errors->has('Etnias_id') ? ' has-error' : '' }}"> 
          {{ Form::select('Etnias_id', $etnia, null, ['class'=>'form-control', 'placeholder' => 'Seleccione una Opción...']) }}
                
                       @if ($errors->has('Etnias_id'))
                            <span class="help-block">
                            <strong>{{ $errors->first('Etnias_id') }}</strong>
                            </span>
              @endif
            </div>


         
            <div class="form-group">
        {!! Form::label('FechaNacimiento', 'Fecha de Nacimiento:')!!}
         </div>
    <div class="form-group {{ $errors->has('FechaNacimiento') ? ' has-error' : '' }}">       

          <div class="input-group">
                  <input type="text" class="form-control datepicker" id="Fec_Nac" name="FechaNacimiento" placeholder="DIA/MES/AÑOS" value="{{$fechad}}">
                  <div class="input-group-addon">
                 <span class="glyphicon glyphicon-th"></span>
                  </div>
                </div> 
    
       @if ($errors->has('FechaNacimiento'))
                            <span class="help-block">
                            <strong>{{ $errors->first('FechaNacimiento') }}</strong>
                            </span>
              @endif
              
      </div>
     




 </div>
            <!-- /.col -->
            <div class="col-md-6">
          



      <div class="form-group">
        {!! Form::label('Peso', 'Peso:')!!}
        </div>
    <div class="form-group {{ $errors->has('Peso') ? ' has-error' : '' }}"> 
        {!! Form::text('Peso', null, ['class'=> 'form-control','placeholder'=>'Solo Cantidad']) !!}
         @if ($errors->has('Peso'))
                            <span class="help-block">
                            <strong>{{ $errors->first('Peso') }}</strong>
                            </span>
              @endif
      </div>

          <div class="form-group">
      {!! Form::label('Estatura', 'Estatura:')!!}
      </div>
     <div class="form-group {{ $errors->has('Estatura') ? ' has-error' : '' }}"> 
      {!! Form::text('Estatura', null, ['class'=> 'form-control','id'=>'estatura','placeholder'=>'Solo Cantidad']) !!}
        @if ($errors->has('Estatura'))
                            <span class="help-block">
                            <strong>{{ $errors->first('Estatura') }}</strong>
                            </span>
              @endif
   
        </div>

           <div class="form-group{{ $errors->has('TelefonoMovil') ? ' has-error' : '' }}">
  {!! Form::label('TelefonoMovil', 'Télefono Movil:')!!}
  
  {!! Form::text('TelefonoMovil', null, ['class'=> 'form-control','id'=> 'tlfnMovil']) !!}
  @if ($errors->has('TelefonoMovil'))
                            <span class="help-block">
                            <strong>{{ $errors->first('TelefonoMovil') }}</strong>
                            </span>
              @endif
  </div>


<div class="form-group{{ $errors->has('TelefonoLocal') ? ' has-error' : '' }}">
  {!! Form::label('TelefonoLocal', 'Télefono Local:')!!}
  
  {!! Form::text('TelefonoLocal', null, ['class'=> 'form-control','id'=> 'tlfnLocal']) !!}
  @if ($errors->has('TelefonoLocal'))
                            <span class="help-block">
                            <strong>{{ $errors->first('TelefonoLocal') }}</strong>
                            </span>
              @endif
  </div>
  
  <div class="form-group{{ $errors->has('TelefonOficina') ? ' has-error' : '' }}">
  {!! Form::label('TelefonOficina', 'Teléfono de Oficina:')!!}
  
  {!! Form::text('TelefonOficina', null, ['class'=> 'form-control','id'=> 'tlfnOficina']) !!}

  @if ($errors->has('TelefonOficina'))
                            <span class="help-block">
                            <strong>{{ $errors->first('TelefonOficina') }}</strong>
                            </span>
              @endif
  </div>

    
              <div class="form-group{{ $errors->has('Direccion') ? ' has-error' : '' }}">
              {!! Form::label('Direccion', 'Dirección:')!!}
              
              {!! Form::text('Direccion', null, ['class'=> 'form-control', 'id' => 'Direccion', 'placeholder'=>'Calle, Sector, Urbanizacion, N° de Casa']) !!}
            
              @if ($errors->has('Direccion'))
                            <span class="help-block">
                            <strong>{{ $errors->first('Direccion') }}</strong>
                            </span>
              @endif
          
           </div>




            
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
    
      </div>



      <div class="col-md-12">     
                 <div class="col-md-12 col-md-offset-5">
            <tr>
            <th>   
            {!!Form::submit('GUARDAR', ['class' => 'btn btn-success', 'id'=>'boton_enviar'])!!}      
     
        
            <a  href="{{route('DatosAspirante.index')}}" class="btn btn-danger pull-center">CANCELAR</a>
            </div>
          </div>





{!!Form::close()!!}

