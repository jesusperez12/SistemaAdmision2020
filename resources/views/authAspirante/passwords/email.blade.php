<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Restrablecer | Contraseña </title>
    
    <meta name="description" content="Free Admin Template Based On Twitter Bootstrap 3.x">
    <meta name="author" content="">
    
    <meta name="msapplication-TileColor" content="#5bc0de" />
    <meta name="msapplication-TileImage" content="assets/img/metis-tile.png" />
    
    <!-- Bootstrap -->
  <link rel="stylesheet" href="{{asset('../../bower_components/bootstrap/dist/css/bootstrap.min.css')}}">>
    
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
 <div class="logo">
 <a href="http://www.upel.edu.ve/" class="logo " rel="home" itemprop="url"><img  height="66" src="{{asset('img/logoupel.png')}}" class="logo " alt="" itemprop="logo"></a></div>
<body>
 <div class="hold-transition">
    <strong class="login-box-sm"><center><b>  Admisión Pregrado </b> </center> </strong>
  </div>
<div class="login-box">
    <div class="login-box-body">
    <strong class="login-box-sm"><center> <b> Restablecer Contraseña</b></center> </strong> 
    
 

     <div class="login-box-sm">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
    
         <form class="form-horizontal" method="POST" action="{{ route('Aspirante.password.email') }}">
                        {{ csrf_field() }}
        
        
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
         <input id="email" type="email" class="col-md-4 form-control" name="email" placeholder="Correo Electronico" value="{{ old('email') }}"  required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

            @if ($errors->has('email'))
                <span class="help-block">
                 <strong>{{ $errors->first('email') }}</strong>
                 </span>
              @endif
      </div>


                <div class="row">
        <div class="flex-center position-ref full-height">
        <!-- /.col -->
        <div class="col-xs-6">
          <button type="submit" class="btn btn-block btn-primary btn-sm">Enviar</button>
        </div>
        <div class="col-xs-6">
          <a href="{{ url('Aspirante/login') }}" class="btn btn-block btn-danger btn-sm" > Cancelar </a>
        </div>
        <!-- /.col -->
      </div>
      </div>
         

    </form>
</div>
  </div>
</div>

    <!--jQuery -->
    <script src="{{asset('js/jquery.js')}}"></script>

    <!--Bootstrap -->
    <script src="{{asset('js/bootstrap.js')}}"></script>

</body>

</html>






  