<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admision | Pregrado</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
     <link rel="shortcut icon" href="{{asset('img/funcionarios.png')}}">


</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
   <h2> <a><b>Admisión</a><br> <a> Pregrado 2020</b></a></h2>
  </div>
  <!-- User name 
  <div class="lockscreen-name">Identificar su usuario</div>-->

  <!-- START LOCK SCREEN ITEM -->
 
    <!-- lockscreen image -->
   <!-- <div class="lockscreen-image">
      <img src="{{asset('img/funcionarios.png')}}" alt="User Image">
    </div>-->
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <br>
    <br>
    <form class="">


        <!-- /.col -->
        <div class="col-xs-6">
         <a href="{{url('/login')}}" class="btn btn-block  btn-success ">Funcionarios</a>
        </div>
        <div class="col-xs-6">
           <a href="{{url('Aspirante/login')}}" class="btn btn-block  btn-success ">Aspirantes Pregrado</a>
        </div>
        <!-- /.col -->
      

    </form>


    <!-- /.lockscreen credentials -->

  
<br><br><br><br>

    <div class="lockscreen-item">
    <!-- lockscreen image -->
  
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->

    <!-- /.lockscreen credentials -->

  </div>

<br><br>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
   <strong> Elija su rol para poder iniciar Sección !!!</strong>
  </div>
   <!-- <div class="text-center">
    <a href="login.html">Or sign in as a different user</a>
  </div>-->

</div>
  <div class="lockscreen-footer text-center">
   <strong> Admision &copy; 2020. Universidad Pedagógica Experimental Libertador| Dirección de Informática.</a> </strong> <a href="http://www.upel.edu.ve/"><strong>www.upel.edu.ve</strong> </a>
  </footer>
  </div>
<!-- /.center -->

<!-- jQuery 3 -->
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
</body>
</html>