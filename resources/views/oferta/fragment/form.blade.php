
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

 <div class="col-md-12">


   {!!Form::label('Institutos /Extensiones')!!}
      <div class="form-group{{ $errors->has('Institutos_id') ? ' has-error' : '' }}">
   {{ Form::select('Institutos_id', $sedeofertas, null, ['class'=>'form-control', 'placeholder' => '.:Seleccione:.']) }}
@if ($errors->has('Institutos_id'))
                <span class="help-block">
                <strong>{{ $errors->first('Institutos_id') }}</strong>
                </span>
               @endif 
</div>
</div>

 <br> <br> <br>  <br>





   <div class="col-md-12">  
   
         {!!Form::label('Especialidad')!!}
         <div class="form-group{{ $errors->has('Especialidad_id') ? ' has-error' : '' }}">
  <select name="Especialidad_id" class="form-control" id="subprograma">
  </select>
  @if ($errors->has('Especialidad_id'))
                <span class="help-block">
                <strong>{{ $errors->first('Especialidad_id') }}</strong>
                </span>
               @endif 
</div>
     </div>



 <div class="form-group col-md-12">
          {!!Form::label('','Modalidad de Ingreso')!!}
            <div class="form-group{{ $errors->has('ModoIngreso_Id') ? ' has-error' : '' }}">
          {{ Form::select('ModoIngreso_Id', $aspirantes, null, ['class'=>'form-control', 'placeholder' => '.:Seleccione:.']) }}


      
             @if ($errors->has('ModoIngreso_Id'))
                <span class="help-block">
                    <strong>{{ $errors->first('ModoIngreso_Id') }}</strong>
                </span>
                @endif  
              </div>   

    </div>
    
  





 <div class="col-md-6" > 
   

     {!!Form::label(' Vigente')!!}
   <div class="form-group{{ $errors->has('Vigente') ? ' has-error' : '' }}">
    {{ Form::select('Vigente', array('Vigente' => 'Activo', 'No Vigente' => 'Inactivo'), null, ['class'=>'form-control','placeholder' => '.:Seleccione:.']) }}
        @if ($errors->has('Vigente'))
                <span class="help-block">
                <strong>{{ $errors->first('Vigente') }}</strong>
                </span>
               @endif 
</div>
     </div>

    
 <br> <br> <br>  <br>
     <div class="col-md-6" > 



        {!!Form::label('nroresolucion', 'N° de Resolución')!!}
           <div class="form-group{{ $errors->has('nroresolucion') ? ' has-error' : '' }}">
  {!!Form::text('nroresolucion', null, ['class' => 'form-control'])!!} 
      @if ($errors->has('nroresolucion'))
                <span class="help-block">
                <strong>{{ $errors->first('nroresolucion') }}</strong>
                </span>
               @endif 
</div>
  </div>
     
    <!--   <div class="col-md-6" > 
   

     {!!Form::label('Acta Vigente')!!}
   <div class="form-group{{ $errors->has('VigenteAct') ? ' has-error' : '' }}">
     {{ Form::select('VigenteAct', array('Vigente' => 'Vigente', 'No Vigente' => 'No Vigente'), null, ['class'=>'form-control','placeholder' => '.:Seleccione:.']) }}
          @if ($errors->has('VigenteAct'))
                <span class="help-block">
                <strong>{{ $errors->first('VigenteAct') }}</strong>
                </span>
               @endif 
</div>
     </div>-->






     <div class="col-md-6" > 
    
   {!!Form::label('Cupos Ofertas')!!}
   <div class="form-group{{ $errors->has('Cuposofertas') ? ' has-error' : '' }}">
{{ Form::select('Cuposofertas', $cupos, null, ['class'=>'form-control','id' => 'cuposoferta', 'placeholder' => '.:Seleccione:.']) }}

    @if ($errors->has('Cuposofertas'))
                <span class="help-block">
                <strong>{{ $errors->first('Cuposofertas') }}</strong>
                </span>
               @endif 

      </div>
              </div>

 <br> <br> <br>  <br>

 
   <div class="col-md-6" >
  
   {!!Form::label('Cupos Opsu')!!}
     <div class="form-group{{ $errors->has('Cuposopsu') ? ' has-error' : '' }}">
       {!!Form::text('Cuposopsu', null, ['class' => 'form-control', 'id' => 'cuposopsu'])!!} 

         @if ($errors->has('Cuposopsu'))
                <span class="help-block">
                <strong>{{ $errors->first('Cuposopsu') }}</strong>
                </span>
               @endif 

      </div>
              </div>
 <div class="col-md-6" > 


{!!Form::label('ActaConv', 'Acta Convenio N°')!!}
    <div class="form-group{{ $errors->has('ActaConv') ? ' has-error' : '' }}">
  {!!Form::text('ActaConv', null, ['class' => 'form-control'])!!}  
   @if ($errors->has('ActaConv'))
                <span class="help-block">
                <strong>{{ $errors->first('ActaConv') }}</strong>
                </span>
               @endif 

      </div>
</div>
 <div class="col-md-6">
    

   {!!Form::label('Periodo')!!}
   <div class="form-group{{ $errors->has('Periodo_id') ? ' has-error' : '' }}">
   {{ Form::select('Periodo_id', $per, null, ['class'=>'form-control', 'placeholder' => '--Seleccione--']) }}
    @if ($errors->has('Periodo_id'))
                <span class="help-block">
                <strong>{{ $errors->first('Periodo_id') }}</strong>
                </span>
               @endif 

      </div>
</div>



  

<input type = "hidden" name = "Aprobacion" value = "0">


</div>



<br><br><br><br><br>
<br><br><br><br><br>
<br><br><br><br><br>
<br><br> <br> <br> <br>  <br>


<center>
<div class="form-group">
{!!Form::submit('GUARDAR', ['class' => 'btn btn-success'])!!} 
<a href="{{ route('ofertas.index') }}"  class="btn btn-danger pull-center">CANCELAR</a>
</div>
</center>



