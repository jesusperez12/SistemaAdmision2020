
@extends ('layouts.diseño')
@section ('contenido')


<!-- start main1 -->
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-md-offset-2">

      
            <div class="panel panel-info">
             <div class="panel-heading"><center><h5><strong>Crear Oferta Académica</strong> </h5></center> </div>
             
       




                
                <div class="panel-body">

                   

                    {!!Form::open(['route'=>'ofertas.store'])!!}
                    
                @include('oferta.fragment.form') 

                  {!!Form::close()!!}
                  
                      
                </div>
            </div>

    @endsection

@section ('scripts')
<script type="text/javascript">

 $(document).ready(function() {


   $('select[name="ModoIngreso_Id"]').change(function(){
        var valor = $(this).val();
      $("#tipo_modal_ingreso").empty();
      axios.get('{{ route("get-cupos")}}',{
        params: {
        valor : valor
        
      }
    }).then(response =>{
      console.log(response.data);
        $('#tipo_modal_ingreso').append('<option>--Seleccione--</option>');
        response.data.forEach(municipio => {
        $('#tipo_modal_ingreso').append('<option value="'+municipio.id+'">'+municipio.Cupos+'</option>');
        
      });
      
      }); 
    });





    //JMT:acción que permite elegir la especialidad dependiendo de la sede seleccionada
   $('select[name="Institutos_id"]').on('change', function(){
   
       var sedeId = $(this).val();
      // console.log(sedeId);
       if(sedeId) {
           $.ajax({

              url: '/subprograma/'+sedeId,
               type:"GET",
               dataType:"json",
               beforeSend: function(){
                   $('#loader').css("visibility", "visible");
               },
              
               success:function(data) {

                $('select[name="Especialidad_id"]').empty();
               
             
                   console.log(data)
                              
                   $('select[name="Especialidad_id"]').append('<option value="'+ "0" +'">' + "--Seleccione--" + '</option>');
                  
                   $.each(data, function(key, value){
                    $('select[name="Especialidad_id"]').append('<option value="'+ key +'">' + value + '</option>');

                });
               },
               complete: function(){
                   $('#loader').css("visibility", "hidden");
               }
           });
          
       } else {
           $('select[name="Especialidad_id"]').empty();
       }

   })


     
 });

 /*$(function(){
  $('#cuposoferta').click(function(){
    console.log('El texto seleccionado es:',
      $('select[name="Cuposupel"] option:selected').text());

$percentage = 30;

$new_width = ($percentage / 100) * $totalWidth;


  });
});*/

$(function() {
  $("#cuposoferta").change(function() { //input on change
   
    var valor = parseFloat($("#cuposoferta").val());
   
    var total = Math.ceil(valor * 30) / 100;
    var otro = Math.ceil(total);
   // console.log(otro);
    $("#cuposopsu").val(otro); //shows value in "#rate"
  })
});

</script>
@endsection