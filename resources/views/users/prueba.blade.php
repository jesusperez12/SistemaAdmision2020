@include('layouts.diseño')

@section('contenido')

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-success">
				<div class="panel-heading">Registro</div>
				 <form class="form-groub" method="POST" action="{{ route('users.store') }}">
				{{ csrf_field() }}
                        @include('users.fragment.error')
					@include('users.fragment.prueba')
					</form>
				</div>
		</div>
	





		
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
                $('#nucle').append('<option>--Seleccione--</option>');
                response.data.forEach(nucleo => {
                $('#nucle').append('<option value="'+nucleo.id+'">'+nucleo.NombInstituto+'</option>');
                
            });
        
            }); 
        });
    });        
</script> 