
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pregrado| Login</title>
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

  
</head>

 <div class="logo">
 <a href="http://www.upel.edu.ve/" class="logo " rel="home" itemprop="url"><img width="450" height="66" src="{{asset('img/logoupel.png')}}" class="logo " alt="" itemprop="logo"></a></div>

<body>
    <div class="row">
        <div class="col-md-3 col-md-offset-4"">
     
                          @if(Session::has('success'))
                              <div class="alert alert-success">
                              <button type="button" class="close" data-dismiss="alert"> 
                              &times;</button>
                              {{Session::get('success')}}
                              </div>
                              @endif
                          </div>
</div>




      <div class="hold-transition">
                           
    <strong class="login-box-sm"><center><b> Admisión Pregrado </b> </center> </strong>
  </div><br><br><br>

 </div>

<div class="login-box">


 <div class="login-box-body">
  
    <strong class="login-box-sm"><center> <b> Acceder</b></center> </strong>

    <form class="form-horizontal" method="POST" action="{{ route('Aspirante.login.submit') }}">
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
      <!-- <div class="form-group ">
                            <div class="col-md-12 col-md-offset-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordar Contraseña
                                    </label>
                                </div>
                            </div>
                        </div>-->

      <div class="row">
        <div class="flex-center position-ref full-height">
        <!-- /.col -->
        <div class="col-md-6">
          <button type="submit" class="btn btn-block btn-success Active info button btn-sm">Iniciar</button>
        </div>
        <div class="col-md-6">
          <a href="{{ url('Aspirante/register') }}" class="btn btn-block btn-primary Active info button btn-sm" > Registrar </a>
        </div>
      
        <!-- /.col -->
      </div>
      </div>
  

    <!-- /.social-auth-links -->
  <div class="login">
      
<a class="btn btn-link col-md-offset-2" href="{{ route('Aspirante.password.request') }}" style="color:#1C300C;">
      <strong> Olvidaste tu Contraseña? </strong>     
         </a>

   </form>
  </div>
   
  </div>

  <!-- /.login-box-body -->

<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{asset('js/sweetalert.min.js')}}"></script>
<script src="{{asset('../../bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('../../bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('../../plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('js/sweetalert.min.js')}}"></script>
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

