@extends ('layouts.diseño')
@section ('contenido')
	
	
<!-- start main -->
 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                <center><h5><strong>Asignar Especialidades</strong></h5></center></div>
  <div class="panel-body">    
            <form class="form-groub" method="POST" action="{{ route('Especialidad.store') }}">
                        {{ csrf_field() }}
           
                        @include('especialidad.fragment.form')
   

                        
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
     axios.get('{{ route("get-subprograma")}}',{
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
    $(document).ready(function() {
    $('.select2').select2();
    });
</script>
@endsection