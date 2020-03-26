<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pregrado | Admisión</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('./bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  
  <link rel="stylesheet" href="{{asset('./bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('./bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('./dist/css/AdminLTE.min.css')}}">
   <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/iCheck/all.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('./dist/css/skins/_all-skins.min.css')}}">

    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.css')}}">
     <link rel="shortcut icon" href="{{asset('img/funcionarios.png')}}"> 



		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{asset('wizard/stylesheets/theme.css')}}" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{asset('wizard/stylesheets/skins/default.css')}}" />




</head>
<body class="hold-transition skin-blue-light  sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <!-- <span class="logo-mini">  <img src="{{asset('img/upelll.png')}}"  width="90%" img align="rigth"></span> -->
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admisión</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
       <div class="pull-left image">
         <img src="{{ asset('img/upel.png') }}" width="90%" img align="rigth">
        </div>  

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <img src=" dist/img/{{ Auth::user()->avatar }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
                    <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset('img/images.png')}}" class="img-circle" alt="User Image">

                <p>
                 {{ Auth::user()->name }} & Aspirante
                  <small>Postgrado. 2019</small>
                </p>
              </li>
            
              <!-- Menu Footer-->
              <li class="user-footer">
                  <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();" class="btn btn-block btn-danger btn-sm">
                      <b>Cerrar Sección</b>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                     </form>
                             </li>
                  <li><a href="{{ url('Aspirante/Perfil') }}" class="btn btn-block btn-info btn-sm"><i class="fa fa-btn fa-user"></i>Perfil</a></li>
                   </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
      
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/{{ Auth::user()->avatar }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>  {{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Conectado</a>
        </div>
      </div>
  
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu Navegación</li>


       
            <li class="treeview">
              <a href="#">
                <i class="fa fa-street-view"></i>
                <span>Datos Personales</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('DatosAspirante')}}"><i class="fa fa-circle-o"></i> Datos Personales</a></li>
                
              </ul>

            </li>
@if(Auth::user()->datos_personales)

        <li class="treeview ">
            <a href="#">
                <i class="fa fa-clipboard"></i>
                <span>Datos Básicos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('Datosbasicos')}}"><i class="fa fa-circle-o"></i> Datos Básicos</a></li>
                
              </ul>
         
        </li>
  @else


@endif

@if(Auth::user()->datos_basicos)

        <li class="treeview">
          
              <a href="#">
                <i class="fa fa-graduation-cap"></i>
                <span>Datos Académicos</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="{{url('Academico')}}"><i class="fa fa-circle-o"></i> Datos Académicos</a></li>
                <li><a href="{{url('DatosAcademicos')}}"><i class="fa fa-circle-o"></i> Datos Académicos Docentes</a></li>
                
              </ul>
           
        </li>
 @else


@endif


@if(Auth::user()->datos_vocacional)

        <li class="treeview">
          <a href="#">
                <i class="  fa fa-suitcase"></i>
                <span>Experiencia Laboral</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('Esperiencia')}}"><i class="fa fa-circle-o"></i> Datos Experiencia</a></li>
                
              </ul>
        </li>
 @else


@endif

@if(Auth::user()->datos_Experiencia)
        <li class="treeview">
         <a href="#">
                <i class="fa fa-home"></i>
                <span>Socio Económicos</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('SocioEconomico')}}"><i class="fa fa-circle-o"></i>Datos Socio Económicos</a></li>
                
              </ul>
        </li>
 @else


@endif
@if(Auth::user()->datos_academico)
<li class="treeview">
          
          <a href="#">
            <i class="fa fa-graduation-cap"></i>
            <span>Prueba Diagnóstico</span>
             <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('Diagnostico')}}"><i class="fa fa-circle-o"></i> Instrumento Diagnóstico</a></li>
            
          </ul>
       
    </li>
    @else


@endif

@if(Auth::user()->datos_socioEconomico)

           <li class="treeview">
              <a href="#">
                <i class="fa fa-print"></i> <span >Imprimir Planilla</span>
               
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('Reporte')}}"><i class="fa fa-circle-o"></i>Reporte</a></li>
                
              </ul>
            </li>  
 @else


@endif

     
  
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
          <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-body">
                <div class="box-header with-border">
                  <h3 class="box">Sistema de Admisión Nivel Pregrado</h3> 
                    <!-- <h3 class="box-title">Bienvenid@ {{ Auth::user()->name }}</h3> -->

                </div>
                <!-- /.box-header -->
                
                    <div class="row">

                       <div class="container">
                            <div class="col-md-6">
                          @if(Session::has('notification'))
                              <div class="alert alert-success">
                              <button type="button" class="close" data-dismiss="alert"> 
                              &times;</button>
                              {{Session::get('notification')}}
                              </div>
                              @endif
                          </div>
                        </div>


                          
                          <div class="container">
                            <div class="col-md-6">
                          @if(Session::has('error'))
                              <div class="alert alert-danger">
                              <button type="button" class="close" data-dismiss="alert"> 
                              &times;</button>
                              {{Session::get('error')}}
                              </div>
                              @endif
                          </div>
                        </div>
                               <div class="col-md-12">   <!--Contenido-->
                              @yield('contenido')
                                  <!--Fin Contenido-->
                             </div>
                        </div>
                            
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
               </section><!-- /.content -->


    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b></b> 
    </div>
    <strong>Admision &copy; 2019.<strong> Universidad Pedagógica Experimental Libertador</strong> | Dirección de Informática.</a> </strong> <a href="http://www.upel.edu.ve/">www.upel.edu.ve/</a>
  </footer>


  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->


<script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
    <!-- <script src="{{asset('js/jquery-2.1.0.min.js')}}"></script>-->
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/moment.js')}}"></script>
    
   
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/adminlte.min.js')}}"></script>
    <script src="{{asset('js/sweetalert.min.js')}}"></script>
     <!--<script src="https://unpkg.com/axios/dist/axios.min.js"></script>-->
     <script src="{{asset('js/axios.min.js')}}"></script>
    <script src="{{asset('js/jquery.mask.js')}}"></script>
    <script src="{{asset('js/jquery-migrate-1.4.1.min.js')}}"></script>
   <script src="{{asset('datePicker/js/bootstrap-datepicker.js')}}"></script>
    <!-- Languaje -->
    <script src="{{asset('datePicker/locales/bootstrap-datepicker.es.min.js')}}"></script>
    <!--  <script src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js " ></script> -->


		
		<!-- Specific Page Vendor -->
		<script src="{{asset('wizard/vendor/jquery-validation/jquery.validate.js')}}"></script>
		<script src="{{asset('wizard/vendor/bootstrap-wizard/jquery.bootstrap.wizard.js')}}"></script>
		<!-- Examples -->
		<script src="{{asset('wizard/javascripts/forms/examples.wizard.js')}}"></script>
    <script src="{{asset('wizard/vendor/pnotify/pnotify.custom.js')}}"></script>



@yield('scripts')
@include('sweet::alert')
</body>
</html>