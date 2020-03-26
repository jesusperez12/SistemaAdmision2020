@extends ('layouts.diseño')
@section ('contenido')

      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading"><center><h4><strong>Editar Especialidad</strong></h4></center></div>
                    
                <div class="panel-body">
            {!!Form::model($especialidad,['route' => ['Especialidad.update', $especialidad->id], 'method' => 'PUT'])!!}
            @include('especialidad.fragment.editform')

          {!!Form::close()!!}
              
    </div>
</div>
</div> 
@endsection

@section ('scripts')
 <script type="text/javascript">

 
 $(function () { 
    $('#programa').change(function(){
      var valor = $(this).val();
    $("#subprograma").empty();
     axios.get('{{ route("get-subprograma")}}',{
     params: {
     valor : valor
                      
     }
    }).then(response =>{
   // alert(response.data);
  $('#subprograma').append('<option>--Seleccione--</option>');
  response.data.forEach(subprograma => {
    var id = {{ $subprograma }};

if (id == 'subprograma'.id) {

$('#subprograma').append('<option value="'+subprograma.id+'" disabled>'+subprograma.NombEspecialidad+'</option>');
}
else{

$('#subprograma').append('<option value="'+subprograma.id+'">'+subprograma.NombEspecialidad+'</option>');
}

              
    });
    });

   });  
 });  


 $(document).ready(function() {
    $('.select2').select2();
    });

</script>
@endsection
