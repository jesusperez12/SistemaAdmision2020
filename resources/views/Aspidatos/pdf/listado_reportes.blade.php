<!DOCTYPE html>
<html>
 <head>
  
  <title>Pregrado</title>
  
   

<body>
<table width="100%" border="0" bgborder="#000000">
<tr>
 <th>
        
        <img src="img/upel.png" width="50px"></th>
  
     <th height="50" valign="top"> <font SIZE=2><div align="left">República Bolivariana de Venezuela <br>Universidad Pedagógica Experimental Libertador <br> Secretaria - Coordinación Nacional  de Admisión</div></font></th>
      <th><nav>
        <a><font SIZE=2>Proceso Nacional de Admisión 2019</font></a>
        <br>
        <a><font SIZE=2> {{ $fechas }}</font></a>
      </nav></th></tr>

    <tr><th colspan="3">
    <h4><center>Copiaa Planilla Registro de Datos Pregrado</center></h4></th></tr>
  </table>



<div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-5">
    <table class="table table-hover table-striped" border="0" cellpadding="4" width="73%">

 @foreach($aspirantes as $datos)
    <tr> <th colspan="10" height="2" width="" bgcolor="#6491EC"  ><font SIZE="2" class="page-header">Datos Personales</font>  
 </tr>

        <tr >
                    <th>
                    <font SIZE="1" >Nombres:</font></th>
                    <td >
                    <font SIZE=1>{{$datos->PrimerNombre}} {{$datos->SegundoNombre}}</font></td>
              <td></td>
                    <th><font SIZE=1>Apellidos:</font></th>
                    <td ><font SIZE=1 >{{$datos->PrimerApellido}} {{$datos->SegundoApellido}}</font></td>

                </tr>



              <tr >
                    <th><font SIZE=1>Cedula:</font></th>
                    <td ><font SIZE=1>{{$datos->Cedula}}</font></td>
                    <td></td>
                     <th><font SIZE=1>País de origin:</font></th>
              <td ><font SIZE=1>{{$datos->paisOrigin}}</font></td>
            
              </tr>


              <tr>
                   
                    <th><font SIZE=1>Estado Civil:</font></th>
                    <td ><font SIZE=1>{{$datos->EstadoCivil}}</font></td>
                   <td></td>
                   <th><font SIZE=1>Genero:</font></th>
                    <td ><font SIZE=1>{{$datos->Genero}}</font></td>
          
                </tr >


                <tr>
                    <th><font SIZE=1>Telefono Movil:</font></th>
                    <td ><font SIZE=1>{{$datos->TelefonoMovil}}</font></td>
                    <td></td>
                    <th><font SIZE=1>Telefono Local:</font></th>
                    <td ><font SIZE=1>{{$datos->TelefonoLocal}}</font></td>
                    </tr><tr >
                    <th><font SIZE=1>Telefono de Oficina:</font></th>
                    <td ><font SIZE=1>{{$datos->TelefonOficina}}</font></td><td></td>
                    <th><font SIZE=1>Correo Electronico:</font></th>
                    <td ><font SIZE=1>{{$datos->Correo}}</font></td>
                    
                </tr>
              <tr>
                 <th><font SIZE=1>Dirección:</font></th>
                    <td colspan="4" ><font SIZE=1>{{$datos->Direccion}}</font></td>
                    </tr>
              
                  <tr>
            <th colspan="10" height="2" width="2"  ></th>
          </tr>
                @endforeach


@foreach($deposito as $depo)
    <tr> <th colspan="10" height="2" width="1" bgcolor="#6491EC"  ><font SIZE=2>Datos Basicoss</font></th> 
 </tr>
          <tr>
                    @foreach($aspirantes as $datos)
                    <th><font SIZE=1>Nacionalidad:</font></th>
                    <td ><font SIZE=1>{{$datos->Nacionalidad}}</font></td>
                   <td></td>
                    <th><font SIZE=1>Pasaporte:</font></th>
                    <td ><font SIZE=1>{{$datos->NumPasaporte}}</font></td>
                  @endforeach
                </tr >

 <tr>
                   
                    <th><font SIZE=1>Numero De Deposito:</font></th>
                    <td ><font SIZE=1>{{$depo->NumDeposito}}</font></td>
                   <td></td>
                    <th><font SIZE=1>Fecha de Deposito:</font></th>
                    <td ><font SIZE=1>{{$depo->FechaDeposito}}</font></td>
          
                </tr >
                @endforeach
                @foreach($Basicos as $basic) 
                <tr>
                    <th><font SIZE=1>Etnia:</font></th>
                    <td ><font SIZE=1>{{$datos->NombEtnia}}</font></td><td></td>
                  
                    <th><font SIZE=1>Instituto Pedagógica:</font></th>
                    <td >
                    <font SIZE=1>{{$basic->NombInstituto}}</font></td>
                   
                </tr>


       <tr >
                    
                  
                     <th><font SIZE=1>Modo Ingreso:</font></th>
                    <td ><font SIZE=1>{{$basic->ModoIngreso}}</font></td><td></td>
                    <th><font SIZE=1>Especialidad a cursar 1:</font></th>
              <td colspan="4"><font SIZE=1>{{$basic->NombEspecialidad}}</font></td>

                </tr>
                <tr >
                <th><font SIZE=1>Especialidad a cursar 2:</font></th>
                <td><font SIZE=1>{{$basic->curso2}}</font></td>
                <th><font SIZE=1>Especialidad a cursar 3:</font></th>
                <td colspan="4"><font SIZE=1>{{$basic->curso3}}</font></td>
                </tr>
              
                <tr>
            <th colspan="10" height="2" width="2"  ></th>
          </tr>
                
                @endforeach
            
    <tr> <th colspan="12" height="2" width="1"  bgcolor="#6491EC" ><font SIZE=2>Datos Socio Económicos</font>
 </tr>
 <tr>
            <th colspan="12" height="2" width="2"></th>
          </tr>
             @foreach($SOCIOE as $socios)
        <tr>

             <th><font SIZE=1>Nivel de Instrucción de la Madre:</font></th>
            <td ><font SIZE=1>{{$socios->ContenidoSelect}}</font></td><td></td>
            @endforeach
             @foreach($sociopadre as $padre) 
             <th><font SIZE=1>Nivel de Instrucción de la Padre:</font></th> 
            <td ><font SIZE=1>{{$padre->ContenidoSelect}}</font></td>
           @endforeach
           </tr><tr>
            @foreach($ingresos as $ingre) 
            <th><font SIZE=1>Fuente de Ingreso de la Familia:</font></th>  
            <td ><font SIZE=1>{{$ingre->ContenidoSelect}}</font></td><td></td>
             @endforeach
              @foreach($Nivel_ingreso as $nivel) 
            
            <th><font SIZE=1>Nivel de Ingreso de la Familia:</font></th> 
            <td ><font SIZE=1>{{$nivel->ContenidoSelect}}</font></td>
            @endforeach
             </tr><tr>
                   @foreach($Condiciones_alojamiento as $alojamiento)
                    <th><font SIZE=1>Condiciones de Alojamiento de la Familia:</font></th>  
                    <td ><font SIZE=1>{{$alojamiento->ContenidoSelect}}</font></td><td></td>
                    @endforeach
                     @foreach($Tiempo_Traslado as $tiempo)
                      <th><font SIZE=1>Tiempo de Traslado de la Residencia al Instituto:</font></th>  
                    <td ><font SIZE=1>{{$tiempo->ContenidoSelect}}</font></td>
                    </tr>
                    @endforeach
                    @foreach($Costeo_Postgrado as $costeo) 
                    <tr>
                     <th><font SIZE=1>Costeo del Postgrado:</font></th>
                    <td ><font SIZE=1>{{$costeo->ContenidoSelect}}</font></td><td></td>
                     @endforeach

                @foreach($Numero_hijos as $hijos) 
                     <th><font SIZE=1>Cantida de Hijos:</font></th>
                    <td ><font SIZE=1>{{$hijos->ContenidoSelect}}</font></td>
               @endforeach

               @if($ACADEMICOAspi->count())
  <tr> <th colspan="12" height="2" width="1" bgcolor="#6491EC"  ><font SIZE=2>Datos Académicos</font>
 </tr>
      <tr>
            <th colspan="12" height="2" width="2"  ></th>
          </tr>
          @foreach($ACADEMICOAspi as $academic)
        <tr>
          
          <th><font SIZE=1>* Sistema de Estudio:</font></th>
          <td ><font SIZE=1>{{$academic->sistemaEstudio}}</font></td><td></td>
           <th><font SIZE=1>Nombre del Plantel:</font></th>
          <td ><font SIZE=1>{{$academic->namePlantel}}</font></td>
           </tr>

          <tr>
          <th><font SIZE=1>Dependencia del Plantel:</font></th>
          <td ><font SIZE=1>{{$academic->DependenciaPlantel}}</font></td><td></td>
          <th><font SIZE=1>Entidad Federal Plantel:</font></th>
          <td ><font SIZE=1>{{$academic->Estado}}</font></td>
          </tr>

          <tr>
          <th><font SIZE=1>Municipio Del Plantel:</font></th>
          <td ><font SIZE=1>{{$academic->Municipio}}</font></td><td></td>
           <th><font SIZE=1>Rama de Educación Media:</font></th>
          <td ><font SIZE=1>{{$academic->ramas}}</font></td>
          </tr><tr>
          <th><font SIZE=1>Promedio y Número RNI:</font></th>
          <td ><font SIZE=1>{{$academic->Promedio}}&nbsp;&nbsp;&nbsp;{{$academic->NumeroRNI}}</font></td><td></td>
           <th><font SIZE=1>Turno de Estudio</font></th>
          <td ><font SIZE=1>{{$academic->TurnoEstudio}}</font></td>
          
         
          <tr>
            <th bgcolor="#ffffff">
                    
                  </th>
                  <th bgcolor="#ffffff">
                    
                  </th>
          </tr>
           
        @endforeach
 
        @else
 
      @foreach($ACADEMICO as $datos)
        <tr>
          
          <th><font SIZE=1>* Tipo de Titulo:</font></th>
          <td ><font SIZE=1>{{$datos->TiposTitulo}}</font></td><td></td>
           <th><font SIZE=1>Titulo de Carrera:</font></th>
          <td ><font SIZE=1>{{$datos->TituloCarrera}}</font></td>
           </tr>

          <tr>
          <th><font SIZE=1>Fecha de Inicio:</font></th>
          <td ><font SIZE=1>{{$datos->FechaInicio}}</font></td><td></td>
          <th><font SIZE=1>Fecha de Culminacion:</font></th>
          <td ><font SIZE=1>{{$datos->fechaCulminacion}}</font></td>
          </tr>

          <tr>
          <th><font SIZE=1>Pais de Estudio:</font></th>
          <td ><font SIZE=1>{{$datos->Pais}}</font></td><td></td>
           <th><font SIZE=1>Universidad:</font></th>
          <td ><font SIZE=1>{{$datos->Universidad}}</font></td>
          </tr><tr>
          <th><font SIZE=1>Tipo de Organización:</font></th>
          <td ><font SIZE=1>{{$datos->tipoOrganizacion}}</font></td><td></td>
           <th><font SIZE=1>Fecha de Grado</font></th>
          <td ><font SIZE=1>{{$datos->FechaGrado}}</font></td>
          
             </tr><tr>
          <th><font SIZE=1>Escala:</font></th>
          <td ><font SIZE=1>{{$datos->Escala}}</font></td><td></td>
        <th><font SIZE=1>Puesto de Promocion:</font></th>
          <td ><font SIZE=1>{{$datos->PuestoPromocion}}</font></td>
          </tr><tr>
           <th><font SIZE=1>Promedio:</font></th> 
           <td ><font SIZE=1>{{$datos->Promedio}}</font></td>
          </tr>
          <tr>
            <th bgcolor="#ffffff">
                    
                  </th>
                  <th bgcolor="#ffffff">
                    
                  </th>
          </tr>
           
        @endforeach

@endif
           
             
<tr> <th colspan="12" bgcolor="#6491EC" width="1" ><font SIZE=2>Experiencia Laboral</font>
 </tr>
  <tr>
            <th colspan="12" height="2" width="2" ></th>
            @foreach($laboral as $Expe)
          </tr>
        <tr>
          <th><font SIZE=1>*Nombre de la Institución Donde Trabaja</font></th>
          <td ><font SIZE=1>{{$Expe->NombreInstitucion}}</font></td><td></td>
          <th><font SIZE=1>Año de Graduacion</font></th>
          <td ><font SIZE=1>{{$Expe->AñoGraduado}}</font></td>
          </tr><tr>
          <th><font SIZE=1>Años de Servicio</font></th>
           <td ><font SIZE=1>{{$Expe->AñoServicio}}</font></td><td></td>
  
        </tr>
 
  <tr>
                  <th bgcolor="#ffffff">
                    
                  </th>
                </tr>

        @endforeach


        </table>
       

        </thead>
 
</div></div></div>
</body>
</html>

