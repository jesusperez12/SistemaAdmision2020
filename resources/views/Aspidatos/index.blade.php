@extends ('layouts.admin')
@section ('contenido')

  <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">

                       <center><h4>Datos Personales</h4></center>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 200px;">
                   
                  
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            @if($DatosAspirante->count())
            <div class="box-body table-responsive no-padding">
						
              <table class="table table-hover">
                <tr>
           <th><center>Cedula</center></th>  
          <th><center>Primer Nombre</center></th>
					<th><center>Segundo Nombre</center></th>
					<th><center>Primer Apellido</center></th>
					<th><center>Segundo Apellido</center></th>
					<th><center>Estado Civil</center></th>
					<th><center>Genero</center></th>
					<th><center>Dirección</center></th>
					<th><center>Edad</center></center></th> 
					<th><center>Fecha de Nacimiento</center></center></th> 
					<th><center>Telefono Movil</center></center></th> 
					<th><center>Telefono Local</center></center></th> 
					
					<th><center>Correo Electronico</center></center></th>


					 <th colspan="3"><center>Editar Registro</center></th>
					  <th colspan="3"></th>
                </tr>
                @foreach($DatosAspirante as $datos)
                           <tr>
         <td><center>{{$datos->Cedula}}</center></td>       
        <td><center>{{$datos->PrimerNombre}}</center></td>
				<td><center>{{$datos->SegundoNombre}}</center></td>
				<td><center>{{$datos->PrimerApellido}}</center></td>
				<td><center>{{$datos->SegundoApellido}}</center></td>
				<td><center>{{$datos->EstadoCivil}}</center></td>
				<td><center>{{$datos->Genero}}</center></td>
				<td><center>{{$datos->Direccion}}</center></td>
				<td><center>{{$datos->Edad}}</center></td>
				<td><center>{{$datos->FechaNacimiento}}</center></td>
				<td><center>{{$datos->TelefonoMovil}}</center></td>
				<td><center>{{$datos->TelefonoLocal}}</center></td>
				<td><center>{{$datos->Correo}}</center></td>
				
 
				<td width="20px"> <a href="{{ route('DatosAspirante.edit', $datos->id)}}" class="btn btn-block btn-info pull-right fa fa-pencil-square-o">Editar</a></td>
                </tr>
               @endforeach
              </table>
            </div>
          </div>
        </div>
      </div>
@else

      {!!Form::open(['route'=>'DatosAspirante.store'])!!}

  @include('Aspidatos.GestorForm.formDatpersonales')


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



  {!!Form::close()!!}

@endif
  
  
@endsection



