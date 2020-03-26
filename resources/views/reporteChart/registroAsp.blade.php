@extends ('layouts.diseño')
@section ('contenido')
<div class="box">

            <div class="box-header">
            <center>  <h3 class="box-title">Listado de Aspirantes Registrados</h3></center>
            </div>
      @if($datos->count())

            {{ Form::open(['route' => 'AspiranteRegistrados.index', 'method' => 'GET', 'class' => 'form-inline pull-left']) }}
              <div class="form-group">
 {{ Form::select('NombInstituto', $sedeofertas, null, ['class'=>'form-control', 'placeholder' => '.:Institutos:.']) }} 
       </div>         
               
                           <div class="form-group">
 {{ Form::select('NombEspecialidad', $especialidad, null, ['class'=>'form-control', 'placeholder' => '.:Especialidades:.']) }} 
       </div>     
                                <button type="submit" class="btn btn-default">
                                    <span class="fa fa-search"></span>
                                </button>
                           
                            </div>
            
                        {{ Form::close() }}
            <!-- /.box-header -->
        
          
            <div class="box-body">
            <form name="formulario" class="form-groub" method="get" action="{{ route('AspiranteRegistrados.export') }}" target="_blank">
            <td colspan="6"> 
     <label>
     <input type="checkbox" id="chec" onclick="marcar(this); btTutorial.disabled = !this.checked"/> Marcar/Desmarcar Todos
     </label>
      </td>
      <td colspan="6">
<button  class="btn btn-success btn-sm Active info button pull-right" onclick="return confirm('Seguro de que desea generarl en excel??')" name="btTutorial" disabled>Generar Excel</button>
</td>
            
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                <th></th>
                
                <th>Cedula</th>
            
                <th>Deposito </th>
                <th>Primer Apellido</th>
                <th>Primer Nombre</th>
                <th>Segundo Apellido</th>
                <th>Segundo Nombre</th>
                <th>Genero</th>
                <th>Tipo de Aspirante</th>
                <th>Fecha de Nacimiento</th>
                <th>Telefono</th>
                <!-- <th>Correo</th>-->
                <!--<th>Fecha nacimiento</th>
                <th>Estado Civil</th>-->
                </tr>
                </thead>
                 @foreach($datos as $user)
                <tbody>
                    
          
   
        <tr>
        <td> <input type="checkbox" value="{{$user->id}}" name="aspirante[]" onclick="btTutorial.disabled = !this.checked"></td>
        <td>{{ $user->Cedula}}</td>
        <td>{{ $user->NumDeposito}} </td>
        <td>{{ $user->PrimerApellido}} </td>
        <td>{{ $user->PrimerNombre}} </td>
        <td>{{ $user->SegundoApellido}} </td>
        <td>{{ $user->SegundoNombre}} </td>
        <td>{{ $user->Genero}}</td>
        <td>{{ $user->ModoIngreso}}</td>
        <td>{{ $user->FechaNacimiento}}</td>
        <td>{{ $user->TelefonoMovil}}</td>
         <!-- <td>{{ $user->email}}</td>-->
       
        </tr>
    @endforeach
     
                </tbody>
              </table>
          <div class="pull-right">
                   <?php


echo str_replace('/?', '?', $datos->render() )  ;


?>
</div>
@else
   <p> No hay datos cargados </p>
@endif 
            </div>
            <!-- /.box-body -->
          </div>


@endsection



      @section ('scripts')
 <script type="text/javascript">
 /*$(document).ready(function(){
        listProduct();
        //listincompleto();
    });

   

     $(document).on("click",".pagination li a",function(a) {
        a.preventDefault();
        var url = $(this).attr("href");
       // alert(url);

        $.ajax({
            type:'get',
            url:url,
            success: function(data){
              $('#list-product').empty().html(data);
             // $('#list-incomplet').empty().html(data);
            }
        });

       
    });


   




   /* var listProduct = function()
  {
      $.ajax({
          type:'get',
          url:'{{ url('listall')}}',
         
          success: function(data){
            console.log(data);
              $('#list-product').empty().html(data);
          }
      });
  }

  
  /*var listincompleto = function()
  {
      $.ajax({
          type:'get',
          url:'{{ url('Datos')}}',
         
          success: function(data){
            console.log(data);
              $('#list-incomplet').empty().html(data);
          }
      });
  }*/



  function marcar(source) 
	{
		checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
		for(i=0;i<checkboxes.length;i++) //recoremos todos los controles
		{
			if(checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
			{
				checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
			}
		}

  
   
	}
  $("#chec").on("click", function() {  
    $(".user").prop("checked", this.checked);  
});



  </script>


@endsection