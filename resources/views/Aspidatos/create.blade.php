@extends ('layouts.admin')
@section ('contenido')
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<center><h3 class="box-title" bgcolor="SteelBlue">REGISTRO PERSONAL</h3></center>


	{!!Form::open(['route'=>'DatosAspirante.store'])!!}

	@include('Aspidatos.GestorForm.formDatpersonales')

	{!!Form::close()!!}

</div>

@endsection


@section ('scripts')
	<script type ="text/javascript">

		$(function () { 
			$('#estado').change(function(){
				var valor = $(this).val();
			$("#Muni").empty();
			axios.get('{{ route("get-Municipios")}}',{
				params: {
				valor : valor
				
			}
		}).then(response =>{
				$('#Muni').append('<option>--Seleccione--</option>');
				response.data.forEach(municipio => {
				$('#Muni').append('<option value="'+municipio.id+'">'+municipio.Municipio+'</option>');
				
			});
	  	
			});	
		});

		$('#Muni').change(function(){
			var valor = $(this).val();
			$("#parroquia").empty();
			axios.get('{{ route("get-Parroquias")}}',{
				params: {
				valor : valor
			}
		}).then(response =>{
				$('#parroquia').append('<option>--Seleccione--</option>');
				response.data.forEach(parroquia => {
				$('#parroquia').append('<option value="'+parroquia.id+'">'+parroquia.Parroquias+'</option>');
			});		
		});	
	});	
});	
		//script para habilitar y deshabilitar cedula y pasaporte
/*$(document).ready(function(){

      $("#nacional").hide();

      $("#estado").hide();
      $("#estad").hide();

        $("#Muni").hide();
        $("#munii").hide();

        $("#parroquia").hide();
        $("#parroo").hide();
        $("#pais").hide();

        $("#extranjero").hide();
        $("#Origen").hide();

    });

    function nacional(event) {
       var dato = event.target.value;
      if(dato == 'venezolano'){

        $("#nacional").show();
        $("#estad").show();
        $("#estado").show();

        $("#Muni").show();
        $("#munii").show();

        $("#parroquia").show();
        $("#parroo").show()

        $("#pais").show();
          $("#extranjero").hide();
          $("#Origen").hide();
      }

      else if(dato == 'extranjero'){

        $("#nacional").hide();

        $("#estado").hide();
        $("#estad").hide();

        $("#Muni").hide();
        $("#munii").hide();

        $("#parroquia").hide();
        $("#parroo").hide();

        $("#pais").hide();

          $("#extranjero").show();
          $("#Origen").show();
      }

      else{

        $("#nacional").hide();

        $("#estado").hide();
        $("#estad").hide();

        $("#Muni").hide();
        $("#munii").hide();

        $("#parroquia").hide();
        $("#parroo").hide();

        $("#pais").hide();
        $("#Origen").hide();

          $("#extranjero").hide();

      }

    }

    
    $('.datepicker').datepicker({
        format: "dd/mm/yyyy",
        language: "es",
        autoclose: true
    });*/



$(document).ready(function(){
  $('#Fec_Nac').mask('00/00/0000');

  $('#tlfnMovil').mask('0000-0000000');
  $('#tlfnLocal').mask('0000-0000000');
  $('#tlfnOficina').mask('0000-0000000');

});


</script>
@endsection
