
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pregrado | Registrar </title>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('../../plugins/iCheck/square/blue.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href=""><b>Admisión</b><S></S></a>
     <a href=""><b>Pregrado</b><S></S></a>
  </div>

  <div class="register-box-body">
    <h1 class="login-box-msg">Registrar Nuevo Usuario</h1>

     <form class="form-horizontal" method="POST" action="{{ route('register') }}">
         {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} has-feedback"> 
        <input id="name" type="text" class="form-control" name="name" placeholder="Nombre y Apellido" value="{{ old('name') }}" required autofocus>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>


                 @if ($errors->has('name'))
                    <span class="help-block">
                   <strong>{{ $errors->first('name') }}</strong>
                </span>
               @endif
           
          </div>    

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
        <input id="email" type="email" class="col-md-4 form-control" name="email" placeholder="Correo Electronico" value="{{ old('email') }}" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

            @if ($errors->has('email'))
                <span class="help-block">
                 <strong>{{ $errors->first('email') }}</strong>
                 </span>
              @endif
      </div>


           <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
                 <input  id="password" type="password" name="password" class="form-control" placeholder="Contraseña" required>
                 <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('password'))
                 <span class="help-block">
                 <strong>{{ $errors->first('password') }}</strong>
                  </span>
                 @endif
            </div>
                

                <div class="form-group">
                     <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Contraseña" required>
                        
            </div>



      
      <div class="row">
        
        <!-- /.col -->
       <div class="form-group">
          
              <div class="col-md-12">     
                 <div class="col-md-12 col-md-offset-3">
            <tr>
            <th>        
            <button class="btn btn-primary" type="submit" value="boton">Guardar</button>
        
            <a href="{{route('Aspirante.login')}}" class="btn btn-danger pull-center">CANCELAR</a>
            </div>
          </div>
        <!-- /.col -->
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



