@extends ('layouts.diseño')
@section ('contenido')


<div class="main_bg1">
<div class="wrap">  




  <div class="main1">
  <center>
  <h4><strong>Reporte Ofertas</strong> </h4>
</center>


                   
  </div>

</div>
</div>
@if($consultas->count())
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  
  {{ Form::open(['route' => 'consulta.index', 'method' => 'GET', 'class' => 'form-inline pull-left']) }}
              <div class="form-group">
 {{ Form::select('NombInstituto', $sedeofertas, null, ['class'=>'form-control', 'placeholder' => '.:Seleccione:.']) }} 
       </div>             
                                <button type="submit" class="btn btn-default">
                                    <span class="fa fa-search"></span>
                                </button>
                           
                            </div>
            
                        {{ Form::close() }}
                        <br><br>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
           <div class="panel panel-info">
 <div class="panel-body">
 <form name="formulario" class="form-groub" method="get" action="{{ route('consulta.export') }}" target="_blank">
<table id="tabla1" class="table table-hover">
    <thead>
    <tr>
        <th>Extencion/Instituto</th>
        <th>Modo de Ingreso</th>
        <th>Especialidad</th>
        <th>Cupos Upel</th>
        <th>Cupos Convenio</th>

   
    </tr>
    </thead>
    
    <tbody>
    <td colspan="3"> 
     <label>
     <input type="checkbox" id="chec" onclick="marcar(this); btTutorial.disabled = !this.checked"/> Marcar/Desmarcar Todos
     </label>
      </td>
      <td colspan="5">
<button  class="btn btn-success btn-sm Active info button pull-right" onclick="return confirm('Seguro de que desea generarl en excel??')" name="btTutorial" disabled>Generar Excel</button>
</td>
                  
   </tr>      
          
    @foreach($consultas as $oferta)
        <tr>
        <td> <input type="checkbox" value="{{$oferta->id}}" name="aprobacion[]" onclick="btTutorial.disabled = !this.checked"></td>
         <td>{{ $oferta->NombInstituto}}</td>
        <td>{{ $oferta->ModoIngreso}}</td>
         <td>{{ $oferta->NombEspecialidad}}</td>
        <td>{{ $oferta->Cuposupel}}</td>
         <td>{{ $oferta->ConvDeAr}}</td>
        
       
        </tr>
    @endforeach
    @else
   <p> No hay datos cargados </p>
@endif
    </tbody>
</table>
</form>
</div>
</div>
</div>

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
    $(".oferta").prop("checked", this.checked);  
});
 
    
 
</script>


@endsection