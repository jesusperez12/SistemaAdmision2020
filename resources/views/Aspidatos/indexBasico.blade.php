
@extends ('layouts.admin')
@section ('contenido')


  <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">

                       <center><h4>Datos Básicos</h4></center>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 200px;">
                   
                  
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body  no-padding">
                        @if (count($Datos) && (count($deposito) ))
               
  <div class="row">
        <div class="col-md-12 ">
          <div class="box">
            <div class="box-header">

                       <center><h4>Depositos</h4></center>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 200px;">
                   
                  
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-condensed">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Banco</th>
                  <th>Numero de Deposito</th>
                  <th>Fecha de Deposito</th>
                  <th style="width: 40px">Corregir</th>
                </tr>
                <tr>
                  <td>1.</td>
                  <td>{!!$depositodatos->NombBanco!!}</td>
                  
                  <td>{!!$depositodatos->NumDeposito!!}</td>
                   
                 <td>{!!$depositodatos->FechaDeposito!!}</td>
                  <td width="20px"> <a href="{{ route('Datosbasicos.edit', $depositodatos->id)}}" class="btn btn-block btn-info  fa fa-pencil-square-o">EDITAR</a></td>
                </tr>
               
              </table>  

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
     
      </div>
</div>
        <div class="row">
        <div class="col-md-12 ">
          <div class="box">
            <div class="box-header">

                       <center><h4>Institutos</h4></center>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 200px;">
                   
                  
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-condensed">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Modalidad de Ingreso</th>
                  <th>Institucion/Extención:</th>
                  <th>Especialidad curso 1:</th>
                  <th>Especialidad curso 2:</th>
                  <th>Especialidad curso 3:</th>
                  <th style="width: 40px">Corregir</th>
                </tr>
                <tr>
                @foreach($DatosBasicos as $basic) 
                   <td>1.</td> 
                  <td>{!!$basic->ModoIngreso!!}</td>
                  <td>{!!$basic->NombInstituto!!}</td>
                  <td>{!!$basic->NombEspecialidad!!}</td>
                  <td>{!!$basic->curso2!!}</td>
                  <td>{!!$basic->curso3!!}</td>
                  <td width="20px"> <a href="{{ route('editDatBasicos', $basic->id)}}" class="btn btn-block btn-info  fa fa-pencil-square-o">EDITAR</a></td>
                </tr>
                @endforeach
              </table>  
          </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
     
      </div>
</div>


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
     
      </div>
@else

  @include('Aspidatos.GestorForm.formDatBasicos')

  @section ('scripts')
  <script type ="text/javascript">
  $(function () { 
      $('#modoingre').change(function(){
        var valor = $(this).val();
      $("#cuposdirigidos").empty();
      axios.get('{{ route("get-cursos")}}',{
        params: {
        valor : valor
        
      }
    }).then(response =>{
        $('#cuposdirigidos').append('<option>--Seleccione--</option>');
        response.data.forEach(cupos => {
        $('#cuposdirigidos').append('<option value="'+cupos.id+'">'+cupos.Cupos+'</option>');
        
      });
      
      }); 
    });


 

    $('#modoingre').on('change', function(){
       var sedeId = $(this).val();
      // console.log(sedeId);
       if(sedeId) {
           $.ajax({
               url: '/NuevoIngreso/'+sedeId,
               type:"GET",
               dataType:"json",
               beforeSend: function(){
                   $('#loader').css("visibility", "visible");
               },
               
               success:function(data) {

                $('select[name="Institutos_id"]').empty();
                
              
                 // console.log(data)
                              
                                                      
                   $('select[name="Institutos_id"]').append('<option value="'+ "0" +'">' + "--Seleccione--" + '</option>');
                   
                   $.each(data, function(key, value){
                    $('select[name="Institutos_id"]').append('<option value="'+ key +'">' + value + '</option>');

                });
               },
               complete: function(){
                   $('#loader').css("visibility", "hidden");
               }
           });
           
       } else {
           $('select[name="Institutos_id"]').empty();
       }

   })

   $('select[name="Institutos_id"]').on('change', function(){
       var intituto = $(this).val();
      // console.log(sedeId);
       if(intituto) {
           $.ajax({
               url: '/Especialidadescurso1/'+intituto,
               type:"GET",
               dataType:"json",
               beforeSend: function(){
                   $('#loader').css("visibility", "visible");
               },
               
               success:function(data) {

                $('#curso1').empty();
                
              
                  console.log(data)
                              
                                                      
                   $('#curso1').append('<option value="'+ "0" +'">' + "--Seleccione--" + '</option>');
                   
                   $.each(data, function(key, value){
                    $('#curso1').append('<option value="'+ key +'">' + value + '</option>');
                    
                });
               },
               complete: function(){
                   $('#loader').css("visibility", "hidden");
               }
           });
           
       } else {
           $('#curso1').empty();
       }

   })


   $('select[name="Institutos_id"]').on('change', function(){
       var intituto = $(this).val();
      // console.log(sedeId);
       if(intituto) {
           $.ajax({
               url: '/Especialidadescurso2/'+intituto,
               type:"GET",
               dataType:"json",
               beforeSend: function(){
                   $('#loader').css("visibility", "visible");
               },
               
               success:function(data) {

                $('#curso2').empty();
                
              
                  console.log(data)
                              
                                                      
                   $('#curso2').append('<option value="'+ "0" +'">' + "--Seleccione--" + '</option>');
                   
                   $.each(data, function(key, value){
                    $('#curso2').append('<option value="'+ key +'">' + value + '</option>');
                    
                });
               },
               complete: function(){
                   $('#loader').css("visibility", "hidden");
               }
           });
           
       } else {
           $('#curso2').empty();
       }

   })


   $('select[name="Institutos_id"]').on('change', function(){
       var intituto = $(this).val();
      // console.log(sedeId);
       if(intituto) {
           $.ajax({
               url: '/Especialidadescurso3/'+intituto,
               type:"GET",
               dataType:"json",
               beforeSend: function(){
                   $('#loader').css("visibility", "visible");
               },
               
               success:function(data) {

                $('#curso3').empty();
                
              
                  console.log(data)
                              
                                                      
                   $('#curso3').append('<option value="'+ "0" +'">' + "--Seleccione--" + '</option>');
                   
                   $.each(data, function(key, value){
                    $('#curso3').append('<option value="'+ key +'">' + value + '</option>');
                    
                });
               },
               complete: function(){
                   $('#loader').css("visibility", "hidden");
               }
           });
           
       } else {
           $('#curso3').empty();
       }

   })



  });



 $(document).ready(function(){

$("#nacional").hide();
$("#mostrar").hide();


});
 function nacional(event) {
       var dato = event.target.value;
      if(dato == '4' ){

        $("#nacional").show();
        $("#mostrar").hide();
      }

        else if(dato == '3'){

          $("#nacional").show();
          $("#mostrar").show();
        }

      else{

        $("#nacional").hide();
        $("#mostrar").hide();
        

      }

    }

   $('.datepicker').datepicker({
        format: "dd/mm/yyyy",
        language: "es",
        autoclose: true
    });


    
  



   /* $(document).ready(function(){

      $("#mostrar").hide();
      $("#depositoOcultar").hide();
		$("#modoingre").on( "click", function() {
			$('#mostrar').show(); //muestro mediante id
      $('#depositoOcultar').show();
     // $('#bloque_info').hide(); 
		//	$('.target').show(); //muestro mediante clase
		 });
		$("#ocultar").on( "click", function() {
			$('#tipo_modal_ingreso').hide(); //oculto mediante id
		//	$('.target').hide(); //muestro mediante clase
		});
	});*/

</script>
@endsection


@endif


@endsection
        
                        