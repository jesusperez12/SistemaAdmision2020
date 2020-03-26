
@extends ('layouts.admin')
@section ('contenido')

               
               
  <div class="row">
        <div class="col-md-12 ">
          <div class="box">
            <div class="box-header">

                       <center><h4>Datos Socio Economico</h4></center>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 200px;">
                   
                  
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              @if($primerafase->count())  
                <div class="panel-body">
               
        <table class="table">

                        <thead>
                        <tr>
                
             
                        </tr>
                        </thead>
                        <tbody>


                 @foreach($socio as $soci) 
                <tr>   
              
               <td><strong>{!!$soci->Nombreindicador!!}</strong> </td>
               <td>{!!$soci->ContenidoSelect!!} </td>
               <td width="10px">
            <a  href="{{ route('editMadre', $soci->id)}}"class="btn btn-block btn-info  btn-sm" v-on:click.prevent="editKeep(keep)">&nbsp;EDITAR</a>
          </td>
               </tr>
                 
                  
         
          
    
               @endforeach




                @foreach($sociopadre as $padre) 
                <tr>   
              
               <td><strong>{!!$padre->Nombreindicador!!}</strong> </td>
               <td>{!!$padre->ContenidoSelect!!} </td>
               <td width="10px">
            <a  href="{{ route('corregir', $padre->id)}}" class="btn btn-block btn-info  btn-sm" v-on:click.prevent="editKeep(keep)">EDITAR</a>
          </td>
               </tr>
                 
                  
         
          
    
               @endforeach


              @foreach($ingresos as $ingre) 
                <tr>   
              
               <td><strong>{!!$ingre->Nombreindicador!!}</strong> </td>
               <td>{!!$ingre->ContenidoSelect!!} </td>
               <td width="10px">
            <a  href="{{ route('FuenteIngreso', $ingre->id)}}" class="btn btn-block btn-info  btn-sm" v-on:click.prevent="editKeep(keep)">EDITAR</a>
          </td>
               </tr>
                 
                  
         
          
    
               @endforeach


            @foreach($Nivel_ingreso as $nivel) 
                <tr>   
              
               <td><strong>{!!$nivel->Nombreindicador!!}</strong> </td>
               <td>{!!$nivel->ContenidoSelect!!} </td>
               <td width="10px">
            <a  href="{{ route('NivelIngreso', $nivel->id)}}" class="btn btn-block btn-info  btn-sm" v-on:click.prevent="editKeep(keep)">EDITAR</a>
          </td>
               </tr>
                 
                  
         
          
    
               @endforeach


            @foreach($Condiciones_alojamiento as $alojamiento) 
                <tr>   
              
               <td><strong>{!!$alojamiento->Nombreindicador!!}</strong> </td>
               <td>{!!$alojamiento->ContenidoSelect!!} </td>
               <td width="10px">
            <a  href="{{ route('Condicones', $alojamiento->id)}}" class="btn btn-block btn-info  btn-sm" v-on:click.prevent="editKeep(keep)">EDITAR</a>
          </td>
               </tr>
                 
                  
         
          
    
               @endforeach


            @foreach($Tiempo_Traslado as $tiempo) 
                <tr>   
              
               <td><strong>{!!$tiempo->Nombreindicador!!}</strong> </td>
               <td>{!!$tiempo->ContenidoSelect!!} </td>
               <td width="10px">
            <a  href="{{ route('Traslado', $tiempo->id)}}" class="btn btn-block btn-info  btn-sm" v-on:click.prevent="editKeep(keep)">EDITAR</a>
          </td>
               </tr>
                 
                  
         
          
    
               @endforeach


            @foreach($Costeo_Postgrado as $costeo) 
                <tr>   
              
               <td><strong>{!!$costeo->Nombreindicador!!}</strong> </td>
               <td>{!!$costeo->ContenidoSelect!!} </td>
               <td width="10px">
            <a  href="{{ route('CosteoPostgrado', $costeo->id)}}" class="btn btn-block btn-info  btn-sm" v-on:click.prevent="editKeep(keep)">EDITAR</a>
          </td>
               </tr>
                 
                  
         
          
    
               @endforeach


                @foreach($Numero_hijos as $hijos) 
                <tr>   
              
               <td><strong>{!!$hijos->Nombreindicador!!}</strong> </td>
               <td>{!!$hijos->ContenidoSelect!!} </td>
               <td width="10px">
            <a  href="{{ route('N°Hijos', $hijos->id)}}" class="btn btn-block btn-info  btn-sm" v-on:click.prevent="editKeep(keep)">EDITAR</a>
          </td>
               </tr>
                 
                  
         
          
    
               @endforeach
</tbody>

      </table>
    
              </table>  

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
     
      </div>

        <div class="row">
        <div class="col-md-12 ">
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table">             

          <tr>
                    @foreach($daso as $nu)
               <td><strong>Dedicacion al Postgrado: </strong></td>
           
               <td>{!!$nu->TiempoPost!!} </td>
               
               </tr>
                 <tr>
               <td><strong>Dinero Portado al Postgrado: </strong></td>
               <td>{!!$nu->CantDineroPost!!}</td>
               </tr>
                <tr>
               <td><strong>Poseé Computador?: </strong></td>
                <td>{!!$nu->Posee_Computador!!} </td>
                </tr>

                <tr>
               <td><strong>Poseé Internet?: </strong> </td>
               <td>{!!$nu->Posee_internet!!}</td>
               </tr>


                
               <td><strong>Tiempo en el Internet: </strong> </td>
               <td>{!!$nu->TiempoInternet   !!}</td>
               
                  <td width="10px">
            
          </td>
        

         <td>  <a href="{{ route('SocioEconomico.edit', $nu->id)}}" class="pull-right btn btn-info btn-sm" v-on:click.prevent="editKeep(keep)">EDITAR</a></td>
      
               @endforeach
               
</tbody>
    </table>


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
     
      </div>
   @else

  @include('Aspidatos.GestorForm.formSocioEconomico')



@endif  


@endsection
 

































