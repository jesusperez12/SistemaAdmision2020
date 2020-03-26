<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pregrado| Login</title>
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

   <link rel="stylesheet" href="{{asset('css/AdminLTE.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/iCheck/square/blue.css')}}">

  <link rel="stylesheet" href="{{ asset('css/planilla.css') }}" > 

 
   <link rel="shortcut icon" href="{{asset('img/funcionarios.png')}}">
 

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
   <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
</head>
 <div class="logo">
 <a href="http://www.upel.edu.ve/" class="logo " rel="home" itemprop="url"><img  height="66" src="{{asset('img/logoupel.png')}}" class="logo " alt="" itemprop="logo"></a></div>
<body>

<div class="hold-transition">
    <strong class="login-box-sm"><center> <b> Admisión Pregrado Funcionario </b></center> </strong>
  </div><br><br><br>
<div class="login-box">

   
  <!-- /.login-logo -->
  <div class="login-box-body">
    <strong class="login-box-sm"><center> <b> Iniciar Sección</b> </center> </strong>

    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback" >
       <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
         @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
          @endif
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

     <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
       <input id="password" type="password" class="form-control" name="password" required placeholder="Password">
        @if ($errors->has('password'))
             <span class="help-block">
               <strong>{{ $errors->first('password') }}</strong>
             </span>
           @endif
           <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      


      <div class="row">
        <div class="flex-center position-ref full-height">
        <!-- /.col -->
        <div class="col-md-10">     
                 <div class="col-sm-10 col-md-offset-2">
          <button type="submit" class="btn btn-block Active info button btn-success ">Iniciar</button>
        </div>


  <div class="flex-center position-ref full-height">
  
        <br>
  
        <a class="btn btn-link col-md-offset-3" href="{{ route('password.request') }}" style="color:#1C300C;">
      <strong> Olvidaste tu Contraseña? </strong>     
         </a>

          

  </div>

     
        <!-- /.col -->
      </div>
      </div>
    </form>

    <!-- /.social-auth-links -->
   <div class="flex-center position-ref full-height">
  
        
      
      

          

  </div>
   
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="js/sweetalert.min.js"></script>
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
 @include('sweet::alert')
</body>
</html>
