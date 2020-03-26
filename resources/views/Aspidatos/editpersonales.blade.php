@extends ('layouts.admin')
@section ('contenido')
<center><h3 class="box-title" bgcolor="SteelBlue">Modificación de Datos Personales</h3></center>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

@include('Aspidatos.GestorForm.error')

	{!!Form::model($Datos,['route'=>['DatosAspirante.update',$Datos->id],'method'=>'PUT'])!!}

	@include('Aspidatos.GestorForm.formEditDatpersonales')

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

$(document).ready(function(){

$('#estatura').mask('0.00');
});
//script para habilitar y deshabilitar Cedula y pasaporte
$(document).ready(function(){

$("#nacional").show();

  $("#extranjero").hide();

});

function nacional(event) {
 var dato = event.target.value;
if(dato == 'venezolano'){

  $("#nacional").show();
  $("#extranjero").hide();

}

else if(dato == 'extranjero'){

  $("#extranjero").show();
  $("#nacional").hide();

  
}

else{


    $("#nacional").hide();

}

}


$('.datepicker').datepicker({
  format: "dd/mm/yyyy",
  language: "es",
  autoclose: true
});



$(document).ready(function(){
$('#Fec_Nac').mask('00/00/0000');
$('#tlfnMovil').mask('0000-0000000');
$('#tlfnLocal').mask('0000-0000000');
$('#tlfnOficina').mask('0000-0000000');
$('#Cedula').mask('00000000');
});

$(document).ready( function () {
$("#name").on("keypress", function () {
$PrimerNombre=$(this);
setTimeout(function () {
 $PrimerNombre.val($PrimerNombre.val().toUpperCase());
},50);
})

  $("#namesegundo").on("keypress", function () {
$SegundoNombre=$(this);
setTimeout(function () {
 $SegundoNombre.val($SegundoNombre.val().toUpperCase());
},50);
})

  $("#apellido").on("keypress", function () {
$PrimerApellido=$(this);
setTimeout(function () {
 $PrimerApellido.val($PrimerApellido.val().toUpperCase());
},50);
})

  $("#apellidoDos").on("keypress", function () {
$SegundoApellido=$(this);
setTimeout(function () {
 $SegundoApellido.val($SegundoApellido.val().toUpperCase());
},50);
})

   $("#Direccion").on("keypress", function () {
$Direccion=$(this);
setTimeout(function () {
 $Direccion.val($Direccion.val().toUpperCase());
},50);
})

})



</script>
@endsection

