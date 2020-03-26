@extends ('layouts.diseño')
@section ('contenido')
<div class="main_bg1">
<div class="wrap">  
    <div class="main1">
        <h4>PROGRAMAS</h4>
    </div>
</div>
</div> 
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Editar Especialidad</div>
                    
                <div class="panel-body">
            {!!Form::model($especialidad,['route' => ['especialidadAdmin.update', $especialidad->id], 'method' => 'PUT'])!!}
           <div class="form-group col-md-12" >
   <div class="form-group{{ $errors->has('sede_id') ? ' has-error' : '' }}">

      {!!Form::label('Institutos/Extensiones')!!}
       {{ Form::select('Institutos_id', $sedes, null, ['class'=>'form-control']) }}
              
          @if ($errors->has('sede_id'))
                <span class="help-block">
                <strong>{{ $errors->first('sede_id') }}</strong>
                </span>
               @endif   
               </div> 
</div>


<div class="form-group col-md-12">
{!!Form::label('Programas')!!}
{{ Form::select('Programas_id', $programas, null, ['class'=>'form-control','id'=>'programa']) }}
      
</div>


<div class="form-group col-md-12">
{!!Form::label('Sub Programas')!!}
{{ Form::select('Especialidad_id', $especialidades, null, ['class'=>'form-control','id'=>'subprograma']) }}

 </div>

<div class="form-group col-md-12">
{!!Form::label('Periodo')!!}
{{ Form::select('Periodo_id', $per, null, ['class'=>'form-control']) }}

</div>



 <div class="form-group col-md-12" > 
     {!!Form::label(' Vigente')!!}
   
     {{ Form::select('Vigente', array('Vigente' => 'Vigente', 'No Vigente' => 'No Vigente'), null, ['class'=>'form-control']) }}
       
     </div>
<center>
<div class="form-group col-md-12">
{!!Form::submit('GUARDAR', ['class' => 'btn btn-success'])!!}
<a href="{{ route('especialidadAdmin.index') }}" class="btn btn-primary pull-center">CANCELAR</a>
</div>
</center>

                

          {!!Form::close()!!}
              
    </div>
</div>
</div> 
@endsection
</body>
</html>




@section ('scripts')
<script type="text/javascript">
            $(document).ready(function() {
    $('.select2').select2().append('<option>--Seleccione--</option>');
    });

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

</script>
@endsection