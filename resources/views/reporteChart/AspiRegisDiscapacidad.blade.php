@extends ('layouts.diseño')
@section ('contenido')
<div class="box">
            <div class="box-header">
            <center>  <h3 class="box-title">Aspirantes con Discapacidad</h3></center>
            </div>
            {{ Form::open(['route' => 'AspRegisDisca.index', 'method' => 'GET', 'class' => 'form-inline pull-left']) }}
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
            @if($RegisAspDisca->count())
            <div class="box-body">
            <form name="formulario" class="form-groub" method="get" action="{{ route('AspRegisDisca.export') }}" target="_blank">
            
     
            
            <table  class="table table-bordered table-hover" border="100">
            <label>
            <td colspan="7"> 
     <input type="checkbox" id="chec" onclick="marcar(this); btTutorial.disabled = !this.checked"/> Marcar/Desmarcar Todos
     </label>
      
<button  class="btn btn-success btn-sm Active info button pull-right" onclick="return confirm('Seguro de que desea generarl en excel??')" name="btTutorial" disabled>Generar Excel</button>
</td>
                <thead>
                <tr>
                <th>Seleccione</th>
                
                <th>Codigo</th>
            
                <th>Institutos </th>
                 <th>CódigoEsp</th>
                <th>Especialidad</th>
               
                <th>Género</th>
                <th>Discapacidad</th>
                </tr>
                </thead>
                <tbody>
                </tr>      
          
    @foreach($RegisAspDisca as $user)
        <tr>
        <td> <input type="checkbox" value="{{$user->Institutos_id}}" name="preinscritos[]" onclick="btTutorial.disabled = !this.checked"></td>
        <td>{{ $user->CodSede}}</td>
         <td>{{ $user->NombInstituto}} </td>
         <td>{{ $user->CodEspecialidad}} </td>
         <td>{{ $user->NombEspecialidad}} </td>
         
         <td>{{ $user->Genero}} </td>
         <td>{{ $user->discapacidad}} </td>
         <!-- <td>{{ $user->email}}</td>-->
       
        </tr>
    @endforeach
   
                </tbody>
              </table>
               <div class="pull-right">
                   <?php


echo str_replace('/?', '?', $RegisAspDisca->render() )  ;


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