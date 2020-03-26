@extends ('layouts.admin')
@section ('contenido')
	<center><h3 class="box-title" bgcolor="SteelBlue">MODIFICAR DATOS BASICOS</h3></center>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="box box-success"><br>	
	
  {!!Form::model($Datos,['route'=>['datosBasicos',$Datos->id],'method'=>'PUT'])!!}

	@include('Aspidatos.GestorForm.editDatBasicos')

	{!!Form::close()!!}
</div>
@endsection

	@section ('scripts')
  <script type ="text/javascript">

 
 $(document).ready(function() {
    //JMT:acción que permite elegir la especialidad dependiendo de la sede seleccionada
   $('select[name="Institutos_id"]').on('change', function(){
       var sedeId = $(this).val();
       console.log(sedeId);
       if(sedeId) {
           $.ajax({
               url: '/programas/'+sedeId,
               type:"GET",
               dataType:"json",
               beforeSend: function(){
                   $('#loader').css("visibility", "visible");
               },
               
               success:function(data) {

                $('select[name="Programas_id"]').empty();
                
              
                   console.log(data)
                              
                                                      
                   $('select[name="Programas_id"]').append('<option value="'+ "0" +'">' + "--Seleccione--" + '</option>');
                   
                   $.each(data, function(key, value){
                    $('select[name="Programas_id"]').append('<option value="'+ key +'">' + value + '</option>');

                });
               },
               complete: function(){
                   $('#loader').css("visibility", "hidden");
               }
           });
           
       } else {
           $('select[name="Programas_id"]').empty();
       }

   })

     $('select[name="Programas_id"]').on('change', function(){
       var sedeId = $(this).val();
       console.log(sedeId);
       if(sedeId) {
           $.ajax({
               url: '/subprogramas/'+sedeId,
               type:"GET",
               dataType:"json",
               beforeSend: function(){
                   $('#loader').css("visibility", "visible");
               },
               
               success:function(data) {

                $('select[name="Especialidad_Id"]').empty();
                
              
                   console.log(data)
                              
                                                      
                   $('select[name="Especialidad_Id"]').append('<option value="'+ "0" +'">' + "--Seleccione--" + '</option>');
                   
                   $.each(data, function(key, value){
                    $('select[name="Especialidad_Id"]').append('<option value="'+ key +'">' + value + '</option>');

                });
               },
               complete: function(){
                   $('#loader').css("visibility", "hidden");
               }
           });
           
       } else {
           $('select[name="Especialidad_Id"]').empty();
       }

   })


 });

</script>
@endsection