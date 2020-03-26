@extends ('layouts.diseño')
@section ('contenido')


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
            <div class="panel panel-info">
            <div class="panel-heading"><center><h5><strong>OFERTAS PARA DESAPROBAR</strong></h5></center></div> 
 <!--
 @if (Auth::user()->rols_id == '2')
                <div class="panel-heading"> 
                <div class="panel-success">
                  <table class="table table-hover">
                    <thead>
                      <tr bgcolor="#dff0d8">
                        
                        <th>Bienvenido

Sistema de Admisión del @foreach($users as $user) {{$user->NombSede}} </th> 


                    @endforeach
                    </tr></thead></table>
</div> 
    </div>
 @endif-->



               

 
  <br>
  @if($aprobar->count())
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  
  {{ Form::open(['route' => 'ofertas.desAprobarindex', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
    
              <div class="form-group">
 {{ Form::text('NombEspecialidad', null, ['class' => 'form-control', 'placeholder' => 'Especialidad']) }}
       </div>             
                                <button type="submit" class="btn btn-default">
                                    <span class="fa fa-search"></span>
                                </button>
                           
                            </div>
            
                        {{ Form::close() }}

                <div class="panel-body">

               
<form name="formulario" class="form-groub" method="POST" action="{{ route('ofertas.desaprobar') }}">
{{Form::token()}} 
<table class="table">


      <tr>
      <th>Seleccion</th>
     <th>Instituto/ Extensión</th>
               <th> Especialidad</th>
            <th>Cupos Ofertas</th>
                <th>Cupos Opsu</th>
                <th>Número de Resolución</th>
                <th>Fecha</th>
 </tr>


            <tr>
     <td colspan="3"> 
     <label>
     <input type="checkbox" id="chec" onclick="marcar(this); btTutorial.disabled = !this.checked"/> Marcar/Desmarcar Todos
     </label>
      </td>
      <td colspan="5">
<button  class="btn btn-success btn-sm Active info button pull-right" onclick="return confirm('Seguro de que desea Desaprobar la Oferta??')" name="btTutorial" disabled>Desaprobar</button>
</td>
                  
   </tr>      
                  
                     @foreach($aprobar as $oferta)
                    
                      <tr>
                      
                  <td> <input type="checkbox" value="{{$oferta->id}}" name="aprobacion[]" onclick="btTutorial.disabled = !this.checked"></td>
                  <td>{{$oferta->NombInstituto}} </td>
               
                  <td>{{$oferta->NombEspecialidad}} </td>
                   <td >{{$oferta->Cuposofertas}} </td>
                  <td >{{$oferta->Cuposopsu}} </td>
              
                  <td >{{$oferta->nroresolucion}} </td>
                  <td >{{$oferta->created_at}} </td>
             
              
                 

             
                      @endforeach
                     

                  </table>
                 
   
       </form>
    
               <div class="pull-right">
                   <?php


echo str_replace('/?', '?', $aprobar->render() )  ;


?>
</div>

     @else
   <p> No hay datos cargados </p>
@endif
              
                    
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


 <script type ="text/javascript">

 $(document).ready(function() {
 $('.select2').select2();
 });
 </script>

</body>
</html>
@endsection