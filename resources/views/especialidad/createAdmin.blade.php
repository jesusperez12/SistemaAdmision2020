@extends ('layouts.diseño')
@section ('contenido')
	<div class="main1">
		<h4>PROGRAMAS</h4>
	</div>
	
<!-- start main -->
 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Asignar Programas</div>
  <div class="panel-body">    
            <form class="form-groub" method="POST" action="{{ route('especialidadAdmin.store') }}">
                        {{ csrf_field() }}
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
                   
                <div class="panel-body">
  {!!Form:: open(array('url'=>'nucleo', 'method'=>'POST', 'autocomplete'=> 'off')) !!} 
            

         <div class="form-group col-md-12" >
          {!!Form::label('Institutos/Extensiones')!!}
   <div class="form-group{{ $errors->has('Institutos_id') ? ' has-error' : '' }}">

     
       {{ Form::select('Institutos_id', $sedes, null, ['class'=>'form-control','id'=>'sede', 'placeholder' => '.:Seleccione:.']) }}
              
          @if ($errors->has('Institutos_id'))
                <span class="help-block">
                <strong>{{ $errors->first('Institutos_id') }}</strong>
                </span>
               @endif   
               </div> 
</div>

 
<div class="form-group col-md-12">
{!!Form::label('Programas')!!}
   <div class="form-group{{ $errors->has('Programas_id') ? ' has-error' : '' }}">


      {{ Form::select('Programas_id', $programas, null, ['class'=>'form-control','id'=>'programa','placeholder' => '.:Seleccione:.']) }}
@if ($errors->has('Programas_id'))
                <span class="help-block">
                <strong>{{ $errors->first('Programas_id') }}</strong>
                </span>
               @endif   
</div>
</div>


 <div class="form-group col-md-12">  
 {!!Form::label('Sub-Programa')!!}
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
 {!!Form::label('Periodo')!!}
   <div class="form-group{{ $errors->has('Periodo_id') ? ' has-error' : '' }}">
   
           {{ Form::select('Periodo_id', $per, null, ['class'=>'form-control','placeholder' => '.:Seleccione:.']) }}
              @if ($errors->has('Periodo_id'))
                <span class="help-block">
                <strong>{{ $errors->first('Periodo_id') }}</strong>
                </span>
               @endif   
</div>
</div>


 <div class="form-group col-md-12"> 
    {!!Form::label(' Vigente')!!}
   <div class="form-group{{ $errors->has('Vigente') ? ' has-error' : '' }}">
   
     {{ Form::select('Vigente', array('Vigente' => 'Vigente', 'No Vigente' => 'No Vigente'), null, ['class'=>'form-control','placeholder' => '.:Seleccione:.']) }}
       
        @if ($errors->has('Vigente'))
                <span class="help-block">
                <strong>{{ $errors->first('Vigente') }}</strong>
                </span>
               @endif
     </div>
</div></div>
<center>
<div class="form-group col-md-12">
<tr>
<th>        
{!!Form::submit('GUARDAR', ['class' => 'btn btn-primary'])!!}
<a href="{{ route('especialidadAdmin.index') }}" class="btn btn-success  pull-center">CANCELAR</a>
</div>
</th>
</tr>
</center>
                {!!Form::close()!!}
 
   

                        
              </form>
                     

           </div>
       
            
	</div>

</div>		
<!-- start footer -->

@endsection

@section ('scripts')
 <script type="text/javascript">
 $(function () { 
    $('#programa').change(function(){
      var valor = $(this).val();
    $("#subprograma").empty();
     axios.get('{{ route("get-subprogramas")}}',{
     params: {
     valor : valor
                      
     }
    }).then(response =>{
   // alert(response.data);
  $('#subprograma').append('<option>--Seleccione--</option>');
  response.data.forEach(subprograma => {
  $('#subprograma').append('<option value="'+subprograma.id+'">'+subprograma.NombEspecialidad+'</option>');
              
    });
    });
   });  
 });  

 $(document).ready(function(){

      $("#instituto").hide();

        $("#nucleo").hide();
      

    });

   function nacional(event) {
       var dato = event.target.value;

      if(dato == 'Sede'){

        $("#instituto").show();
    
          $("#nucleo").hide();
      }

      else if(dato == 'Nucleo'){

        $("#instituto").hide();

          $("#nucleo").show();
    
      }

      else{

      $("#institutos").hide();

        $("#nucleos").hide();
  

      }

    }


</script>
@endsection