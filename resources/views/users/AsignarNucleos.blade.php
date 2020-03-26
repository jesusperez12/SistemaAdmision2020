@extends ('layouts.diseño')
@section ('contenido')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     

     <div class="panel panel-info">
	<div class="panel-heading"><center><h5><strong>Asignación de Institutos</strong> </h5></center> </div>
  <div class="panel-body">

   
	{!!Form::model($user,['route'=>['nucleosAgsinados.update',$user->id],'method'=>'PUT'])!!}
 
	@include('users.fragment.formNucleos')

	{!!Form::close()!!}

</div>  
</div>
</div>
    

@endsection
</body>
</html>

@section ('scripts')      
<script type ="text/javascript">

    $(document).ready(function() {
    $('.select2').select2();
    });

             
$(function () { 
            $('#sede').change(function(){
                var valor = $(this).val();

            $("#nucle").empty();
            axios.get('{{ route("get-nucleos")}}',{
                params: {
                valor : valor
                
            }
        }).then(response =>{
                //alert(response.data);
                
                response.data.forEach(nucleo => {
                $('#nucle').append('<option value="'+nucleo.id+'">'+nucleo.NombInstituto+'</option>');
                
            });
        
            }); 
        });
    });      

</script>
@endsection