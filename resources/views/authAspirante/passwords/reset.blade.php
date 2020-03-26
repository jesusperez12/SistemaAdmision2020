

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admision | Recuperación De Contraseña </title>
  <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('../../bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('../../bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('../../bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('../../dist/css/AdminLTE.min.css')}}">

     <link rel="stylesheet" href="{{asset('css/AdminLTE.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('../../plugins/iCheck/square/blue.css')}}">

    <link rel="stylesheet" href="{{ asset('css/planilla.css') }}" > 

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
 <a href="http://www.upel.edu.ve/" class="logo " rel="home" itemprop="url"><img width="450" height="66" src="{{asset('img/logoupel.png')}}" class="logo " alt="" itemprop="logo"></a></div>
<body>
   <div class="hold-transition">
    <strong class="login-box-sm"><center> <b> Admisión Pregrado </b> </center> </strong>
  </div> <br><br><br>
<div class="login-box">
  <div class="login-box-body">
     <strong class="login-box-sm"><center> <b> Restablecer Contraseña</b> </center> </strong>
    
         <form class="form-horizontal" method="POST" action="{{ route('Aspirante.password.request') }}">
         {{ csrf_field() }}
          <input type="hidden" name="token" value="{{ $token }}">

        
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
         <input id="email" type="email" class="col-md-4 form-control" name="email" placeholder="Correo Electronico" value="{{ $email or old('email') }}" required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

            @if ($errors->has('email'))
                <span class="help-block">
                 <strong>{{ $errors->first('email') }}</strong>
                 </span>
              @endif
      </div>


             


           <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
                 <input  id="password" type="password" name="password" class="form-control" placeholder="Contraseña Nueva" required>
                 <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('password'))
                 <span class="help-block">
                 <strong>{{ $errors->first('password') }}</strong>
                  </span>
                 @endif
            </div>
                

          <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} has-feedback">
             <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Contraseña Nueva" required>
              @if ($errors->has('password_confirmation'))
                   <span class="help-block">
                   <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
             @endif
         </div>

 <div class="row">
        <div class="flex-center position-ref full-height">
        <!-- /.col -->
        <div class="col-xs-6">  
          <button type="submit" class="btn btn-block btn-primary Active info button btn-sm" value="boton">Guardar</button>
        </div>
        <div class="col-xs-6">
          <a href="{{route('Aspirante.login')}}" class="btn btn-block btn-danger Active info button btn-sm" > Cancelar </a>
        </div>
        <!-- /.col -->
      </div>
      </div>

      
     
    </form>

 
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="js/sweetalert.min.js"></script>
<script src="{{asset('../../bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('../../bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('../../plugins/iCheck/icheck.min.js')}}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>







