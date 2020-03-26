<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Admisión</title>
    <!-- Tell the browser to be responsive to screen width -->
  
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
   
    
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
    //puedo eliminar uno de estos?? --> 

   <link rel="stylesheet" href="{{asset('css/sweetalert.min.css')}}">


    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->

    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
     
   <link href="{{ asset('css/planilla.css') }}" rel="stylesheet"> 
     
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
  
   <link rel="shortcut icon" href="{{asset('img/funcionarios.png')}}">  


     <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
 

  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset('bower_components/morris.js/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('bower_components/jvectormap/jquery-jvectormap.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  	<!-- Theme CSS -->
		<link rel="stylesheet" href="{{asset('wizard/stylesheets/theme.css')}}" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{asset('wizard/stylesheets/skins/default.css')}}" />
  {!! Charts::assets() !!}

 
</head>
<!-- ADD THE CLASS sidebar-collapse TO HIDE THE SIDEBAR PRIOR TO LOADING THE SITE -->
<!--<body class="hold-transition skin-green-light sidebar-collapse sidebar-mini">-->
<body class="hold-transition skin-blue  sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a class="logo">
      <!-- mini logo se  for sidebar mini 50x50 pixels -->
      
      <!-- logo for regular state and mobile devices -->
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
    <div class="pull-left image">
         <img src="{{ asset('img/upel.png') }}" width="90%" img align="rigth">
        </div>  
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
   
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('img/usuario.jpg')}}" class="user-image" alt="User Image">
          
               {{ Auth::user()->name }} <span class="caret"></span>
             
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset('img/images.png')}}" class="img-circle" alt="User Image">

                <p>
                 {{ Auth::user()->name }}
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
                   </ul>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar  una Toggle Button -->
        
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
    
      <div class="user-panel">
        <div class="pull-left image">
         <img  class="img-circle">
        </div> 
        <div class="pull-left info">
          <p>  {{ Auth::user()->name}}</p>
          <a><i class="fa fa-circle text-success"></i> Conectado</a>
          <p></p>
        </div><br><br>
      </div>
  
      <ul class="sidebar-menu" data-widget="tree">
     


      @can('periodo.index')
        <li class="treeview ">
            <a href="#">
                <i class="fa fa-hourglass-start"></i>
                <span>Periodo</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
             
              <li class="nav-item">
                <a class="nav-link" href="{{ route('periodo.index') }}">Nuevo Periodo</a>
              </li>
                
              </ul>
          </li>  
          @endcan 

          @can('indice.index')
        <li class="treeview ">
            <a href="#">
                <i class="fa fa-hourglass-start"></i>
                <span>Indice Admision</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
             
              <li class="nav-item">
                <a class="nav-link" href="{{ route('indice.index') }}">Asignar Indice de Admision</a>
              </li>
                
              </ul>
          </li>  
          @endcan 



         @can('users.index')
         <li class="treeview ">
            <a href="#">
                <i class="fa fa-group"></i>
                <span>usuarios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li class="nav-item">
              <a class="nav-link" href="{{ route('users.index') }}">Usuarios</a>
             </li>
     
              </ul>
          </li>


                        
         @endcan
       

          @can('Especialidad.index')

        <li class="treeview ">
            <a href="#">
                <i class="fa fa-graduation-cap"></i>
                <span>Especialidad</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              @can('Especialidad.index')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('Especialidad.index') }}">Asignar Especialidad</a>
              </li>
              @endcan
              @can('NuevaEspecialidad.index')
              <li class="nav-item">
              <a class="nav-link" href="{{ route('NuevaEspecialidad.index') }}">Nueva Especialidad</a>
             </li>
             @endcan 
              </ul>
          </li>    
          @endcan 

       

          @can('ofertas.index')
     
        <li class="treeview ">
            <a href="#">
                <i class="fa fa-server"></i>
                <span>Ofertas Academicas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                
              
              <li class="nav-item">
                            <a class="nav-link" href="{{ route('ofertas.index') }}">OFERTAS</a>
              </li>
                  
     
              </ul>
          </li>           
          @endcan  

          @can('ofertas.consultaAprobacion')
     
     <li class="treeview ">
         <a href="#">
             <i class="fa fa-thumbs-up"></i>
             <span>Ofertas</span>
             <i class="fa fa-angle-left pull-right"></i>
           </a>
           <ul class="treeview-menu">
             
           @can('ofertas.consultaAprobacion')
           <li class="nav-item">
             <a class="nav-link" href="{{ route('ofertas.consultaAprobacion') }}">Aprobar Ofertas</a>
             </li>
             @endcan  
             @can('ofertas.desAprobarindex')
             <li class="nav-item">
             <a class="nav-link" href="{{ route('ofertas.desAprobarindex') }}">Desaprobar Ofertas</a>
             </li>
             @endcan      
  
           </ul>
       </li>           
       @endcan  

       @can('Admitidos.index')
         <li class="treeview ">
            <a href="#">
                <i class="fa fa-street-view"></i>
                <span>Proceso de Admitidos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
             
              <li class="nav-item">                            
           <a class="nav-link" href="{{ route('no_Aptos') }}">Aptos</a>
              </li>
              </ul>
          </li>


                        
         @endcan

         @can('roles.index')
         <li class="treeview ">
            <a href="#">
                <i class="fa fa-street-view"></i>
                <span>Roles</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li class="nav-item">                            
           <a class="nav-link" href="{{ route('roles.index') }}">Roles</a>
              </li>
     
              </ul>
          </li>


                        
         @endcan
       
         @can('charts.index')
         <li class="treeview ">
            <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Reportes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              @can('charts.index')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('charts.index') }}">Graficas</a>
              </li>
              @endcan
              @can('charts.index')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('consulta.index') }}">Excel</a>
                </li>
                @endcan     
                @can('charts.index')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('AspiranteRegistrados.index') }}">Listado de Asp Registrado</a>
                </li>
                @endcan 
                @can('charts.index')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('AspPreinscritos.index') }}">Aspirantes Preinscritos</a>
                </li>
                @endcan     


              @can('charts.index')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('tipoCupo.index') }}">Aspirante por cupos</a>
                </li>
                @endcan 

                @can('charts.index')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('AspRegisDisca.index') }}">Aspirantes con Discapacidad</a>
                </li>
                @endcan  

               
     
              </ul>
          </li> 
          @endcan 



    </section>
    <!-- /.sidebar -->
  </aside>


  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
 

     <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
       <h4 class="box">Sistema de Admisión Nivel Pregrado  - Módulo Funcionario | {{ Auth::user()->name }}  </th> 


                    </h4> 
                    <!-- <h3 class="box-title">Bienvenid@ {{ Auth::user()->name }}</h3> -->

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                          <div class="col-md-12">
                      
                                  <!--Contenido-->
                              @yield('contenido')
                                  <!--Fin Contenido-->
                           </div>
                       
                            
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
               </section><!-- /.content -->

  </div>

  <!-- /.content-wrapper -->

 <footer class="main-footer">
    <div class="pull-right hidden-xs">
     
    </div>
    <strong>Admision &copy; 2019.<strong> Universidad Pedagógica Experimental Libertador</strong> | Dirección de Informática.</a> </strong> <a href="">www.upel.edu.ve</a>
  </footer>

 
  <div class="control-sidebar-bg"></div>
</div>

    <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
    
    
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/loader.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('js/select2.full.min.js')}}"></script>
    <!-- AdminLTE App -->
   
    <script src="{{asset('js/sweetalert.min.js')}}"></script>
    <script src="{{asset('js/axios.js')}}"></script>
    <script src="{{asset('js/axios.min.js')}}"></script>
     <!--<script src="https://unpkg.com/axios/dist/axios.min.js"></script>-->
   <!-- <script src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js " ></script>  -->
    <script src=  "{{asset('js/app.js')}}"></script>
     <script src="{{asset('js/jquery.mask.js')}}"></script>


    
@yield('scripts')
@include('sweet::alert')
  </body>
</html>