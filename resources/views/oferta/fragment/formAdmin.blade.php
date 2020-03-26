
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">



 <div class="col-md-12">

 <input type = "hidden" name = "id_user" value = "{{Auth::user()->id}}">

 {!!Form::label('Tipo de Aspirante')!!}
    <div class="form-group{{ $errors->has('ModoIngreso_Id') ? ' has-error' : '' }}">
  {{ Form::select('ModoIngreso_Id', $aspirantes, null, ['class'=>'form-control', 'placeholder' => '.:Seleccione:.']) }}
 @if ($errors->has('ModoIngreso_Id'))
                <span class="help-block">
                <strong>{{ $errors->first('ModoIngreso_Id') }}</strong>
                </span>
               @endif   
            
</div>
</div>

 <div class="col-md-12">


   {!!Form::label('Institutos/Extensiones')!!}
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


   {!!Form::label('Programa')!!}
   <div class="form-group{{ $errors->has('Programas_id') ? ' has-error' : '' }}">
<select name="Programas_id" class="form-control" id="programa">
              </select>
     
@if ($errors->has('Programas_id'))
                <span class="help-block">
                <strong>{{ $errors->first('Programas_id') }}</strong>
                </span>
               @endif 
</div>
     </div>


   <div class="col-md-12">  
   
         {!!Form::label('subPrograma')!!}
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
    
   {!!Form::label('Cupos Convenio')!!}
   <div class="form-group{{ $errors->has('ConvDeAr') ? ' has-error' : '' }}">

 {{ Form::select('ConvDeAr', array('7'=> '7','10' => '10','15' => '15','20' => '20','25' => '25','40' => '40','45' => '45','50' => '50','55' => '55','60' => '60','65' => '65','70' => '70','75' => '75'), null, ['class'=>'form-control','placeholder' => '.:Seleccione:.']) }}
    @if ($errors->has('ConvDeAr'))
                <span class="help-block">
                <strong>{{ $errors->first('ConvDeAr') }}</strong>
                </span>
               @endif 

      </div>
              </div>

 <br> <br> <br>  <br>

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
   <div class="col-md-6" >
  
   {!!Form::label('Cupos UPEL')!!}
     <div class="form-group{{ $errors->has('Cuposupel') ? ' has-error' : '' }}">
 {{ Form::select('Cuposupel', array('7'=> '7','10' => '10','15' => '15','20' => '20','25' => '25','40' => '40','45' => '45','50' => '50','55' => '55','60' => '60','65' => '65','70' => '70','75' => '75'), null, ['class'=>'form-control','placeholder' => '.:Seleccione:.']) }}
         @if ($errors->has('Cuposupel'))
                <span class="help-block">
                <strong>{{ $errors->first('Cuposupel') }}</strong>
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
<a href="{{ route('ofertasAdmin.index') }}"  class="btn btn-primary pull-center">CANCELAR</a>
</div>
</center>


