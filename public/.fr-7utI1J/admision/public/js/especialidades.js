$(function() {
  $('#sede').on('change',onSelectProjectChange );

    function onSelectProjectChange(){
   var sede_id= $(this).val();

   $.ajax({
               url: '/sede/'+sede_id,
               type:"GET",
               dataType:"json",
               beforeSend: function(){
                   $('#loader').css("visibility", "visible");
               },
});

   




/*$(document).ready(function() {
    //JMT:acción que permite elegir la especialidad dependiendo de la sede seleccionada
   $('select[name="sedes"]').on('change', function(){
       var sedeId = $(this).val();
       console.log(sedeId);
       if(sedeId) {
           $.ajax({
               url: '/especialidades/'+sedeId,
               type:"GET",
               dataType:"json",
               beforeSend: function(){
                   $('#loader').css("visibility", "visible");
               },
               
               success:function(data) {

                $('select[name="especialidades"]').empty();
                
              
                   console.log(data)
                              
                                                      
                   $('select[name="especialidades"]').append('<option value="'+ "0" +'">' + "--Seleccione--" + '</option>');
                   
                   $.each(data, function(key, value){
                    $('select[name="especialidades"]').append('<option value="'+ key +'">' + value + '</option>');

                });
               },
               complete: function(){
                   $('#loader').css("visibility", "hidden");
               }
           });
           
       } else {
           $('select[name="especialidades"]').empty();
       }

   })
 });