<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Ofertas | en Curso </title>
    
    <meta name="description" content="Free Admin Template Based On Twitter Bootstrap 3.x">
    <meta name="author" content="">
    
    <meta name="msapplication-TileColor" content="#5bc0de" />
    <meta name="msapplication-TileImage" content="assets/img/metis-tile.png" />
    
    <!-- Bootstrap -->
  <link rel="stylesheet" href="{{asset('../../bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    
    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="{{asset('css/main.css')}}">

       <link rel="stylesheet" href="{{asset('css/AdminLTE.css')}}">
    
    <!-- metisMenu stylesheet -->
    <link rel="stylesheet" href="{{asset('metismenu/metisMenu.css')}}">
    
    <!-- onoffcanvas stylesheet -->
    <link rel="stylesheet" href="{{asset('onoffcanvas/onoffcanvas.css')}}">
    
    <!-- animate.css stylesheet -->
    <link rel="stylesheet" href="{{asset('animate.css/animate.css')}}">

  <link rel="stylesheet" href="{{ asset('css/planilla.css') }}" > 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<br>
<br>
<br>
 <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="box">
            <div class="box-header">

                       <center><h4>Institutos y Ofertas Aprobadas</h4></center>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 200px;">
                   
                  
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
    @if($ofertasaprobadas->count())
          
            
                  <table class="table table-hover">
   
                    <thead>
               
                      <tr>
                     <th >Modo Ingreso</center></th>
                      <th >Institutos</center></th>
                      <th >Programas</center></th>
                      <th >Especialidades</center></th>

                      </tr>
                    </thead>
                  @foreach($ofertasaprobadas as $oferta)
                    <tbody>
                      <tr>
                      <td>{{$oferta->ModoIngreso}}</td>
                      <td>{{$oferta->NombInstituto}}</td>
                      <td>{{$oferta->NombProgramas}}</td>
                      <td>{{$oferta->NombEspecialidad}}</td>
  
                
                      </tr>
                      @endforeach
                     
                    </tbody>
                   
                  </table>
   </div>
            <!-- /.box-body -->
          </div>
              <div class="col-md-6 ">     
                 <div class="col-md-3 col-md-offset-10">
            <tr>
            <th>        
            <a href="login" class="btn btn-block btn-danger">ATRAS</a>
        
            
            </div>
          </div>
       
        </div>
      </div>

@else

  <center> <h1>  No hay información  </h1></center>
  
@endif



    <!--jQuery -->
    <script src="{{asset('js/jquery.js')}}"></script>

    <!--Bootstrap -->
    <script src="{{asset('js/bootstrap.js')}}"></script>

</body>

</html>

