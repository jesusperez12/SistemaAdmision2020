<section class="content">
    

    {{Form::token()}}

 <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <tr>
            <td>
    <div class="form-group">
        {!! Form::label('TiempoPostgrado', ' Tiempo dedicación al Postgrado en horas/semanas:')!!}
    </div></td>
    <div class="form-group ">
       <td>{{ Form::select('TiempoPost', array('1' => '1', '2' => '2','3' => '3', '4' => '4','5' => '5', '6' => '6','7' => '7', '8' => '8','9' => '9', '10' => '10'), null, ['class'=>'form-control','placeholder' => '--Seleccione--']) }}</td>
    </div>
</tr>

<tr>
  <td>
     <div class="form-group{{ $errors->has('CantDineroPost') ? ' has-error' : '' }}">
        {!! Form::label('DineroPost', ' Cantidad de dinero dedicado al Postgrado:')!!}
   </td>
   
       <td> {!! Form::text('CantDineroPost', null, ['class'=> 'form-control']) !!}</td>
                 @if ($errors->has('CantDineroPost'))
                <span class="help-block">
                    <strong>{{ $errors->first('CantDineroPost') }}</strong>
                </span>
                @endif
    </div>
</tr>
    </div>

    <div class="col-md-6">

  <tr>
     <td>  

    <div class="form-group">
        {!! Form::label('INternet', 'Tiempo estimado que usa Internet:')!!}
    </div></td>
    <div class="form-group ">
        <td> {{ Form::select('TiempoInternet', array('1 Hora' => '1 Hora', '2 Hora' => '2 Hora','3 Hora' => '3 Hora', '4 Hora' => '4 Hora','5 Hora' => '5 Hora', '6 Hora' => '6 Hora','7 Hora' => '7 Hora', '8 Hora' => '8 Hora','9 Hora' => '9 Hora', '10 Hora' => '10 Hora'), null, ['class'=>'form-control','placeholder' => '--Seleccione--']) }}</td>
    </div>
</tr>

<tr>
     <td>
    <div class="form-group{{ $errors->has('Posee_Computador') ? ' has-error' : '' }}">
                    {!! Form::label('Posee_Computadora', ' Posee Computador:')!!}</td>

                     <td>  {{ Form::select('Posee_Computador', array('SI' => 'SI', 'NO' => 'NO'), null, ['class'=>'form-control','placeholder' => '--Seleccione--']) }}</td>
                
                 @if ($errors->has('Posee_Computador'))
                <span class="help-block">
                    <strong>{{ $errors->first('Posee_Computador') }}</strong>
                </span>
                @endif

     </div>

</tr>
<tr>
            <td>
     <div class="form-group{{ $errors->has('Posee_internet') ? ' has-error' : '' }}">
                    {!! Form::label('Posees_internet', ' Posee Internet:')!!}</td>

                    <td>   {{ Form::select('Posee_internet', array('SI' => 'SI', 'NO' => 'NO'), null, ['class'=>'form-control','placeholder' => '--Seleccione--']) }}</td>
                
                 @if ($errors->has('Posee_internet'))
                <span class="help-block">
                    <strong>{{ $errors->first('Posee_internet') }}</strong>
                </span>
                @endif

     </div>
</tr>
</div>
                 <div class="col-md-12">     
                 <div class="col-md-12 col-md-offset-5">
            <tr>
            <th>        
            <button class="btn btn-success" type="submit" value="boton">GUARDAR</button>
        
            <a  href="{{route('SocioEconomico.index')}}" class="btn btn-danger pull-center">CANCELAR</a>
            </div>
          </div>

                 </div>

             </div>

            


           
         </div>  

    </div>
</div>
       
        

    
</section>


