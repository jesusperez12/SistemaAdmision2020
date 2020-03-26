@extends ('layouts.diseño')
@section ('contenido')


<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-md-offset-3">
            <div class="panel panel-info">
              <div class="panel-heading"><center><h5><strong>Oferta Académica</strong><a href="{{ route('ofertas.index') }}" class="btn btn-success pull-right btn-sm">Regresar</h5></a></center></div>
            
           

<center>
      		<table class="table">
  <thead>
     <tr>
      <td><strong> Institutos/Extensiones</strong></td>
      <td>{!!$oferta->NombInstituto!!}</td>
    </tr>
    <tr>
<tr>
      <td><strong>Especialidad</strong></td>
      <td>{!!$oferta->NombEspecialidad!!}</td>
    </tr>
     <tr>
      <td><strong> Modalidad de Ingreso</strong></td>
      <td>{!!$oferta->ModoIngreso!!}</td>
    </tr>
 
    </tr>
  </thead>
  <tbody>
    
    <tr>
      <td><strong> Vigente</strong> </td>
      <td>{!!$oferta->Vigente!!}</td>
    </tr>
 
   <tr>
      <td><strong> N° De Resolución</strong></td>
      <td>{!!$oferta->nroresolucion!!}</td>
    </tr>
  <tr>
      <td><strong> Cupos Ofertas</strong></td>
      <td>{!!$oferta->Cuposofertas!!}</td>
    </tr>



	<tr>
      <td><strong> Cupos Opsu</strong></td>
      <td>{!!$oferta->Cuposopsu!!}</td>
    </tr>


      <tr>
      <td><strong> Acta Convenio</strong></td>
      <td>{!!$oferta->ActaConv!!}</td>
    </tr>



<tr>
      <td><strong> Periodo</strong></td>
      <td>{!!$oferta->Lapso!!}</td>
    </tr>

  


  </tbody>
         </table>

              
  
       <br><br>      
</center>



                </div>
                <div class="panel-body">
            </div>
        </div>
    </div>
</div>
	</div>
</div>
</div>	
@endsection   
</body>
</html>

