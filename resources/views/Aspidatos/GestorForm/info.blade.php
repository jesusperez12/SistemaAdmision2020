@if(Session::has('info'))
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert">
		
		&times;
	</button>
	{{Session::get('info')}}
</div>

@endif
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<fieldset style="border:4px">
  <table border="0" align="center" cellspacing="0">

    

      @foreach($socio as $socios)
<tr><th colspan="10" height="30" width="10"><center><h3>DATOS SOCIO ECONOMICOS <a href="{{ route('SocioEconomico.edit', $socios->id)}}" class="btn btn-success pull-right fa fa-pencil-square-o"></a></h3></center> 
  <div class="box box-success"> 


    <tr height="30">
      <th width="200">Nivel de Instrucción de la Madre:</th>
      <td width="200">{{$socios->DetalleSocial_id}}</td>
      <th width="200">Nivel de Instrucción del Padre:</th>
      <td width="200">{{$socios->DetalleSocial_id}}</td>
      </tr><tr  bgcolor="LightCyan" >
      <th width="200">Fuente de Ingreso de la Familia:</th>
      <td width="200">{{$socios->DetalleSocial_id}}</td>
      <th width="200">Nivel de Ingreso de la Familia:</th>
      <td width="200">{{$socios->DetalleSocial_id}}</td>

    </tr>
    <tr height="30">
          <th>Condiciones de Alojamiento de la Familia:</th>
          <td width="200">{{$socios->DetalleSocial_id}}</td>
          <th>Tiempo de Traslado de la Residencia al Instituto:</th>
          <td width="200">{{$socios->DetalleSocial_id}}</td>
          </tr><tr  bgcolor="LightCyan" >
          <th>Costeo del Postgrado:</th>
          <td width="200">{{$socios->DetalleSocial_id}}</td>
          <th>Cantida de Hijos:</th>
          <td width="200">{{$socios->DetalleSocial_id}}</td>
        </tr>

        <tr height="30" >
          <th>Tiempo dedicación al Postgrado:</th>
          
          <th>Cantidad de dinero dedicado al Postgrado:</th>
          
          </tr><tr  bgcolor="LightCyan" >
          <th>Posee Computador:</th>
          
          <th>Posee Internet:</th>
          
        </tr >
        <tr height="30">
          <th>Tiempo estimado que usa Internet:</th>
          
        </tr>
        @endforeach
      
    </table>



      <h3>

      <a href="SocioEconomico/create"><button class="btn btn-success">Nuevo</button></a></h3>
  </fieldset>
  </div>