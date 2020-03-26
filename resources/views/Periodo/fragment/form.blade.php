

 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
                   
                <div class="panel-body">

  <div class="col-md-6">
               
            {!!Form::label('NombrePeriodo','Cohorte')!!}    
           <div class="form-group{{ $errors->has('NombrePeriodo') ? ' has-error' : '' }}"> 
           {!!Form::text('NombrePeriodo', null, ['class' => 'form-control', 'id' => 'corte',])!!} 
           @if ($errors->has('NombrePeriodo'))
              <span class="help-block">
              <strong>{{ $errors->first('NombrePeriodo') }}</strong>
               </span>
          @endif
       </div>
   </div>

  <div class="col-md-6">
               
            {!!Form::label('Lapso','Periodo')!!}    
           <div class="form-group{{ $errors->has('Lapso') ? ' has-error' : '' }}"> 
           {!!Form::text('Lapso', null, ['class' => 'form-control', 'id' => 'periodo',])!!} 
           @if ($errors->has('Lapso'))
              <span class="help-block">
              <strong>{{ $errors->first('Lapso') }}</strong>
               </span>
          @endif
       </div>
   </div>



 <!--<div class="col-md-6">
               
            {!!Form::label('Resolucion','Resolucion')!!}    
           <div class="form-group{{ $errors->has('Resolucion') ? ' has-error' : '' }}"> 
           {!!Form::text('Resolucion', null, ['class' => 'form-control'])!!} 
           @if ($errors->has('Resolucion'))
              <span class="help-block">
              <strong>{{ $errors->first('Resolucion') }}</strong>
               </span>
          @endif
       </div>
   </div>-->

   <div class="col-md-6" > 
   

     {!!Form::label(' Estatus')!!}
   <div class="form-group{{ $errors->has('Vigente') ? ' has-error' : '' }}">
    {{ Form::select('Vigente', array('1' => 'Activo', '0' => 'Inactivo'), null, ['class'=>'form-control','placeholder' => '.:Seleccione:.']) }}
        @if ($errors->has('Vigente'))
                <span class="help-block">
                <strong>{{ $errors->first('Vigente') }}</strong>
                </span>
               @endif 
</div>
     </div>

</div>
<center>
<div class="form-group col-md-12">
<tr>
<th>        
{!!Form::submit('GUARDAR', ['class' => 'btn btn-success'])!!}
<a href="{{ route('periodo.index') }}" class="btn btn-danger  pull-center">CANCELAR</a>
</div>
</th>
</tr>
</center>
                {!!Form::close()!!}
 