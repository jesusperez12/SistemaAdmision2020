<div class="box box-info">
            <div class="box-header with-border">
            
           

                    {{Form::token()}}
<div class="col-md-6">
      
           {{ Form::select('level_mother_id', $Nivel, null, ['disabled' => 'disabled','class'=>'form-control']) }}
                             
          
                   
        
                       
                  

</div> 
<div class="col-md-6">
      
                                
          
                   
          {{ Form::select('DetalleSocial_id', $Nivel_ingreso, null, ['class'=>'form-control', 'placeholder' => 'Seleccione una Opción...']) }}
                       
     



 </div>
</div>
     <div class="col-md-12">     
      <div class="col-md-6 col-md-offset-5">
      <tr>
   <th>        
 <button class="btn btn-success" type="submit" value="boton">GUARDAR</button>
        
 <a href="{{route('SocioEconomico.index')}}" class="btn btn-danger">CANCELAR</a>
   </div>
</div>
  
 </div>  
          
