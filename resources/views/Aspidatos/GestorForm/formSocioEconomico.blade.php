<link href="{{ asset('css/planilla.css') }}" rel="stylesheet">
<div class="table-responsive" width="50%">
        <div class="box-header with-border">  
            <fieldset style="border:4px">
                <table class="table" width="10%" BGCOLOR=#FFFFFF border="0">

                    {!!Form:: open(array('url'=>'SocioEconomico', 'method'=>'POST', 'autocomplete'=> 'off')) !!}
                    {{Form::token()}}
<div class="col-md-6">
            <tr>
           
                <td>
                {!! Form::label('NombreInstitucion', 'Nivel de Instrucciòn de la Madre:')!!}
                <li id="madre">
           {{ Form::select('level_mother_id', $indicadorsocial, null, ['class'=>'form-control']) }}  </li></td>
                           
            <td>
                           <div class="form-group{{ $errors->has('Nivel_madre') ? ' has-error' : '' }}">
              {{ Form::select('Nivel_madre', $detallesocial, null, ['class'=>'form-control', 'placeholder' => 'Seleccione una Opción...']) }}
                        
                        @if ($errors->has('Nivel_madre'))
                            <span class="help-block">
                            <strong>{{ $errors->first('Nivel_madre') }}</strong>
                            </span>
                        @endif
                   </td>
            </div>    
</tr>

 <tr>
    <td>
    {!! Form::label('NombreInstitucion', 'Nivel de Instrucciòn del Padre:')!!}
    <li id="padre">
            <select name="level_father_id" class="form-control" >

                @foreach($indicadorPadre as $indicadors)
                    <option value="{{$indicadors->id}}"> {{$indicadors->Nombreindicador}}</option>
                @endforeach
            </select>
            </li>
             </td>
                    
               
                     
                          <td>
                             <div class="form-group{{ $errors->has('Nivel_padre') ? ' has-error' : '' }}">
                            {{ Form::select('Nivel_padre', $detallesocial, null, ['class'=>'form-control', 'placeholder' => 'Seleccione una Opción...']) }}
                     
                            @if ($errors->has('Nivel_padre'))
                            <span class="help-block">
                                <strong>{{ $errors->first('Nivel_padre') }}</strong>
                            </span>
                            @endif                 
                          </div>    
                          </td>
</tr>


 <tr>
    <td>      
    {!! Form::label('family_income_id', 'Fuente de Ingreso de la Familia:')!!}
    <li id="fuenteingreso">
                     <select name="family_income_id" class="form-control" >
                    @foreach($indicadorfamilia1 as $indicadors)
                        <option value="{{$indicadors->id}}"> {{$indicadors->Nombreindicador}}</option>
                    @endforeach
                </select>
                </li>
         </td>


            
                
              <td> 
                <div class="form-group{{ $errors->has('Fuente_ingreso') ? ' has-error' : '' }}">
                {{ Form::select('Fuente_ingreso', $detallesocialfamilia1, null, ['class'=>'form-control', 'placeholder' => 'Seleccione una Opción...']) }}
                                             @if ($errors->has('Fuente_ingreso'))
                            <span class="help-block">
                                <strong>{{ $errors->first('Fuente_ingreso') }}</strong>
                            </span>
                            @endif
              </div>
               </td>  
</tr>

<tr>
            <td>
            {!! Form::label('level_family_income_id', 'Nivel de Ingreso de la Familia:')!!}
            <li id="nivelingreso">
                    <select name="level_family_income_id" class="form-control" >
                        @foreach($indicadorfamilia2 as $indicadors)
                            <option value="{{$indicadors->id}}"> {{$indicadors->Nombreindicador}}</option>
                        @endforeach
                    </select>
              </li>      
            </td>

             
                 <td> 
                  <div class="form-group{{ $errors->has('Nivel_ingreso') ? ' has-error' : '' }}">
                  {{ Form::select('Nivel_ingreso', $detallesocialfamilia2, null, ['class'=>'form-control', 'placeholder' => 'Seleccione una Opción...']) }}
                    @if ($errors->has('Nivel_ingreso'))
                            <span class="help-block">
                                <strong>{{ $errors->first('Nivel_ingreso') }}</strong>
                            </span>
                            @endif
               </div>
                  </td>    
     </tr>        
</div>

 <div class="col-md-6">
     <tr>
            <td>
            {!! Form::label('family_accommodation_id', 'Condiciones de alojamiento de la Familia:')!!}
            <li id="Condiciones">
                    <select name="family_accommodation_id" class="form-control" >
                        @foreach($indicadorAlojamientoF as $indicadors)
                            <option value="{{$indicadors->id}}"> {{$indicadors->Nombreindicador}}</option>
                        @endforeach
                    </select>
              </li>      
               </td>   
          
                    
                   <td> 
                      <div class="form-group{{ $errors->has('Condiciones_alojamiento') ? ' has-error' : '' }}">
                    {{ Form::select('Condiciones_alojamiento', $detallesocialAlojamientoF, null, ['class'=>'form-control', 'placeholder' => 'Seleccione una Opción...']) }}

                    @if ($errors->has('Condiciones_alojamiento'))
                            <span class="help-block">
                                <strong>{{ $errors->first('Condiciones_alojamiento') }}</strong>
                            </span>
                            @endif
                    </div>
                    </td>
    </tr>

    <tr>
            <td>
            {!! Form::label('transfer_time_id', 'Tiempo de Traslado de la Residencia al Instituto:')!!} 
            <li id="traslado">    
                    <select name="transfer_time_id" class="form-control" >
                        @foreach($indicadortraslado as $indicadors)
                            <option value="{{$indicadors->id}}"> {{$indicadors->Nombreindicador}}</option>
                        @endforeach
                    </select>
              </li>      
              </td>      

             
                   
                    <td> 
                         <div class="form-group{{ $errors->has('Tiempo_Traslado') ? ' has-error' : '' }}">
                      {{ Form::select('Tiempo_Traslado', $detallesocialtraslado, null, ['class'=>'form-control', 'placeholder' => 'Seleccione una Opción...']) }}
                     
                         @if ($errors->has('Tiempo_Traslado'))
                            <span class="help-block">
                                <strong>{{ $errors->first('Tiempo_Traslado') }}</strong>
                            </span>
                            @endif
                     </div>
                     </td>
     </tr>              


<tr>
            <td>
            {!! Form::label('graduate_cost_id', 'Costeo del Postgrado:')!!} 
            <li id="costeo"> 
                <select name="graduate_cost_id" class="form-control">
                    @foreach($indicadorCosteo as $indicadors)
                        <option value="{{$indicadors->id}}"> {{$indicadors->Nombreindicador}}</option>
                    @endforeach
                </select>
                </li>
            </td> 
   
          
                    
                   <td> 
                      <div class="form-group{{ $errors->has('Costeo_Postgrado') ? ' has-error' : '' }}">
                    {{ Form::select('Costeo_Postgrado', $detallesocialCosteoPost, null, ['class'=>'form-control', 'placeholder' => 'Seleccione una Opción...']) }}
                        @if ($errors->has('Costeo_Postgrado'))
                            <span class="help-block">
                                <strong>{{ $errors->first('Costeo_Postgrado') }}</strong>
                            </span>
                        @endif
              </div>
              </td>
      </tr>

      <tr>
            <td>    
            {!! Form::label('number_of_children_id', 'Nùmero de Hijos:')!!} 
            <li id="hijos"> 
                <select name="number_of_children_id" class="form-control">
                    @foreach($indicadorhijos as $indicadors)
                        <option value="{{$indicadors->id}}"> {{$indicadors->Nombreindicador}}</option>
                    @endforeach
                </select>
               </li> 
             </td>   
   
              
                    
                    <td>
                        <div class="form-group{{ $errors->has('Numero_hijos') ? ' has-error' : '' }}">
                      {{ Form::select('Numero_hijos', $detallesocialhijos, null, ['class'=>'form-control', 'placeholder' => 'Seleccione una Opción...']) }}
                   
                        @if ($errors->has('Numero_hijos'))
                            <span class="help-block">
                            <strong>{{ $errors->first('Numero_hijos') }}</strong>
                            </span>
                        @endif
                    
                </div>
                </td>
     </tr>

</div> 



<div class="col-md-6">

<tr>
            <td>
    <div class="form-group">
        {!! Form::label('TiempoPostgrado', ' Tiempo dedicación al Postgrado en horas/semanas:')!!}
    </div></td>
    
       <td>
       <div class="form-group{{ $errors->has('TiempoPost') ? ' has-error' : '' }}"> 
        {{ Form::select('TiempoPost', array('1' => '1', '2' => '2','3' => '3', '4' => '4','5' => '5', '6' => '6','7' => '7', '8' => '8','9' => '9', '10' => '10'), null, ['class'=>'form-control','placeholder' => '--Seleccione--']) }}
          @if ($errors->has('TiempoPost'))
                            <span class="help-block">
                            <strong>{{ $errors->first('TiempoPost') }}</strong>
                            </span>
                        @endif
                         </div>
       </td>
    
</tr>

<tr>
  <td>
     <div class="form-group">
        {!! Form::label('DineroPost', ' Cantidad de dinero dedicado al Postgrado:')!!}
    </div></td>
   
       <td> 
        <div class="form-group{{ $errors->has('CantDineroPost') ? ' has-error' : '' }}">
        {!! Form::text('CantDineroPost', null, ['class'=> 'form-control']) !!}

          @if ($errors->has('CantDineroPost'))
                            <span class="help-block">
                            <strong>{{ $errors->first('CantDineroPost') }}</strong>
                            </span>
                        @endif
          </div>

       </td>
   
</tr>
    </div>

    <div class="col-md-6">

  <tr>
     <td>  

    <div class="form-group">
        {!! Form::label('INternet', 'Tiempo estimado que usa Internet:')!!}
    </div></td>
   
        <td>
            <div class="form-group{{ $errors->has('TiempoInternet') ? ' has-error' : '' }}">
         {{ Form::select('TiempoInternet', array('1 Hora' => '1 Hora', '2 Hora' => '2 Hora','3 Hora' => '3 Hora', '4 Hora' => '4 Hora','5 Hora' => '5 Hora', '6 Hora' => '6 Hora','7 Hora' => '7 Hora', '8 Hora' => '8 Hora','9 Hora' => '9 Hora', '10 Hora' => '10 Hora'), null, ['class'=>'form-control','placeholder' => '--Seleccione--']) }}

            @if ($errors->has('TiempoInternet'))
                            <span class="help-block">
                            <strong>{{ $errors->first('TiempoInternet') }}</strong>
                            </span>
                        @endif
          </div>

        </td>
    
</tr>

<tr>
     <td>
   
                    {!! Form::label('Posee_Computadora', ' Posee Computador:')!!}</td>

                     <td>
                       <div class="form-group{{ $errors->has('Posee_Computador') ? ' has-error' : '' }}">
                      {{ Form::select('Posee_Computador', array('SI' => 'SI', 'NO' => 'NO'), null, ['class'=>'form-control','placeholder' => '--Seleccione--']) }}
                   

                
                 @if ($errors->has('Posee_Computador'))
                <span class="help-block">
                    <strong>{{ $errors->first('Posee_Computador') }}</strong>
                </span>
                @endif

     </div>
       </td>

</tr>
<tr>
            <td>
    
                    {!! Form::label('Posees_internet', ' Posee Internet:')!!}</td>

                    <td> 

                       <div class="form-group{{ $errors->has('Posee_internet') ? ' has-error' : '' }}">
                         {{ Form::select('Posee_internet', array('SI' => 'SI', 'NO' => 'NO'), null, ['class'=>'form-control','placeholder' => '--Seleccione--']) }}
                  
                    
                 @if ($errors->has('Posee_internet'))
                <span class="help-block">
                    <strong>{{ $errors->first('Posee_internet') }}</strong>
                </span>
                @endif
     </div>
     </td>
</tr>

   
</div>


</table>
</fieldset>
</div>
</div>
   <div class="col-md-12">     
                 <div class="col-md-5 col-md-offset-5">
            <tr>
            <th>   
            {!!Form::submit('GUARDAR', ['class' => 'btn btn-success', 'id'=>'boton_enviar'])!!}      
     
        
           <a href="{{route('SocioEconomico.index')}}" class="btn btn-danger ">Cancelar</a></td>
            </div>
          </div>


{!!Form::close()!!}

       
       @section ('scripts')
<script type ="text/javascript">  

$(document).ready(function(){

$("#madre").hide();

$("#padre").hide();
$("#fuenteingreso").hide();
$("#nivelingreso").hide();
$("#Condiciones").hide();
$("#traslado").hide();
$("#costeo").hide();
$("#hijos").hide();

});

</script>
@endsection