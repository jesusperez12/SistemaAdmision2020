<!DOCTYPE html>
<html>
 <head>
  
  <title>Pregrado</title>
  
   

<body>
<table width="100%" border="0" bgborder="#000000">
<tr>
 <th>
        
        <img src="img/images.png" width="50px"></th>
  
     <th height="50" valign="top"> <font SIZE=2><div align="left">República Bolivariana de Venezuela <br>Universidad Pedagógica Experimental Libertador <br> Secretaria - Coordinación Nacional  de Admisión</div></font></th>
      <th><nav>
        <a><font SIZE=2>Proceso Nacional de Admisión {{ $prueb }}</font></a>
        <br>
        <a><font SIZE=2> {{ $fechas }}</font></a>
      </nav></th></tr>

    <tr><th colspan="3">
    <h4><center>Constancia de Admisión {{ $prueb }}</center></h4></th></tr>
  </table>

 <table class="table table-hover table-striped" border="0" cellpadding="4" width="100%">
<tr> <th colspan="10" height="2" width="" bgcolor="#6491EC"  ><font SIZE="2" class="page-header">Datos Basicos</font>  </th>
 </tr>

  @foreach($admitidos as $datos)

   <tr >
                    <th>
                    <font SIZE="2" >Nacionalidad:</font></th>
                    <td >
                    <font SIZE=2>{{$datos->Nacionalidad}}</font></td>
              <td></td>
                    <th><font SIZE=2>Cédula:</font></th>
                    <td ><font SIZE=2 >{{$datos->Cedula}}</font></td>

                </tr>

                   <tr >
                    <th>
                    <font SIZE="2" >Modo Ingreso:</font></th>
                    <td >
                    <font SIZE=2>{{$datos->ModoIngreso}}</font></td>
              <td></td>
                    <th><font SIZE=2>Tipo Aspirante:</font></th>
                    <td ><font SIZE=2 >{{$Modingreso}}</font></td>

                </tr>
                  

                   <tr >
                    <th>
                    <font SIZE="2" >Sede Pedagógica:</font></th>
                    <td >
                    <font SIZE=2>{{$datos->NombInstituto}}</font></td>
              <td></td>

                </tr>
   <tr >
                    <th>
                    <font SIZE="2" >Especialidad:</font></th>
                    <td >
                    <font SIZE=2>{{$datos->NombEspecialidad}}</font></td>
              <td></td>

                </tr>
                <br><br><br>
                <tr> <th colspan="10" height="2" width="" bgcolor="#6491EC"  ><font SIZE="2" class="page-header">Datos Personales</font>  </th>
 </tr>

  <tr >
                <th><font SIZE=2>Apellido(s):</font></th>
                    <td ><font SIZE=2 >{{$datos->PrimerApellido}} {{$datos->SegundoApellido}}</font></td>
  <td></td>
                  <th>
                    <font SIZE="2" >Nombre(s):</font></th>
                    <td >
                    <font SIZE=2>{{$datos->PrimerNombre}} {{$datos->SegundoNombre}}</font></td>
                </tr>

                <tr >
                <th><font SIZE=2>Estado Civil:</font></th>
                    <td ><font SIZE=2 >{{$datos->EstadoCivil}}</font></td>
  <td></td>
                  <th>
                    <font SIZE="2" >Sexo:</font></th>
                    <td >
                    <font SIZE=2>{{$datos->Genero}}</font></td>
                </tr>




    @endforeach
  
 <tr><th colspan="3">
    <h4>Estimado Aspitrante,</h4></th>
    </tr>
    <tr>
    <td colspan="6"><font SIZE=2>
    ¡Felicitaciones! Usted ha sido <strong>admitido(a)</strong> para iniciar sus estudios de pregrado conducentes al titulo de <strong>Profesor(a)</strong> en la especialidad seleccionada.
    <br>
    La Universidad Pedagógica Experimental Libertador (UPEL), dada a su solida y larga trayectoria, le brindará experiencias de aprendizaje novedosas y significativas que consolidarán su formacion integral como profesinal de la docencia para contribuir con el desarrollo y transformacion de nuestro pais.
    <br>
    ¡Bienvenido! a la Universidad de los Maestros
    <br>
    <center>
      <strong>Atentamente,
      <br>
      Dra. Nilva Liuval Moreno de Tovar
      <br>
      Secretaría</strong>
    </center>
    </font></td>
    </tr>


  <tr> <th colspan="10" height="1" width="" bgcolor="#6491EC"  ><font SIZE="2" class="page-header">Documentos que debe consignar al momento de la incripción</font>  </th>
 </tr>
 @if ($Idmodoingre == 1)
 <tr><th colspan="3">
    <h5>Bachilleres</h5></th>
    </tr>
    <tr>
    <td colspan="6"><font SIZE=2>
    - Constancia de Admisión On-line<br>
    - Titulo de Bachiller o su equivalente.(Art.1°, Resolución N° 004 delCNU de fecha 07-03-07- Publicada en Gaceta Oficial           38.645 el 15-03-07)
    <br>
    - Original Notas Certificadas de Bachiller en formato vigente
    <br>
    - Partida de Nacimiento Original
    <br>
    - Fotocopia ampliada de la Cédula de Identidad
    <br>
    - Una (1) fotografia tipo carnet, reciente y a color
    <br>
    - Fotocopia del Registro Único del Sistema Nacional de Ingreso de Educación Universitaria. (requisito obligatorio)
    </font></td>
    </tr>

<br>
@elseif($Idmodoingre == 2)
 <tr><th colspan="3">
    <h5>Docentes en Servicio</h5></th>
    </tr>
    <tr>
    <td colspan="6"><font SIZE=2>
    - Constancia de Admisión On-line<br>
    - Titulo de Bachiller o su equivalente.(Art.1°, Resolución N° 004 delCNU de fecha 07-03-07- Publicada en Gaceta Oficial 38.645 el 15-03-07)
    <br>
    - Notas Certificadas de Bachiller en formato vigente Original y Copia
    <br>
    - Partida de Nacimiento Original
    <br>
    - Fotocopia ampliada de la Cédula de Identidad
    <br>
    - Una (1) fotografia tipo carnet, reciente y a color
    <br>
    - Constancia de trabajo expedida por la Autoridad de la Zona Educativa, Secretaría de Educación del Estado, o Secretaría de Educación Municipal, según sea el caso, en el cual se indique titularidad del cargo docente, área de trabajo, nivel o modalidad en la cual labora.
    <br>
    - Fotocopia del último recibo de pago
    </font></td>
    </tr>

    @else

 <tr><th colspan="3">
    <h5>Egresados Universitarios en Ejercicio de la Docen</h5></th>
    </tr>
    <tr>
    <td colspan="6"><font SIZE=2>
    - Constancia de Admisión On-line
    <br>
    - Fondo negro brillante del titulo de egresado universitario(legalizado y traducido, si ha sido obtenido en una Universidad del exterior), con vista al original
    <br>
    - Original de las Notas Certificadas que correspondan con el titulo del egresado universitario que presenta.
    <br>
    - Partida de Nacimiento Original
    <br>
    - Fotocopia ampliada de la Cédula de Identidad
    <br>
    - Una (1) fotografia tipo carnet, reciente y a color
    <br>
    - Orinal de la certificaión de los programas de las asinaturas aprobadas en la carrera profesional.
    <br>
    - Constancia de trabajo expedida por la Autoridad de la Zona Educativa, Secretaría de Educación del Estado, o Secretaría de Educación Municipal, según sea el caso, en el cual se indique titularidad del cargo docente, área de trabajo, nivel o modalidad en la cual labora.
    <br>
    - Fotocopia del último recibo de pago
    <br>
    - Comprobante de cancelación de arancel de inscripción. Ver página Web del Pedagógico repectivo.
    </font></td>
    </tr>

    @endif



        </table>
       

        </thead>
 
</div></div></div>
</body>
</html>