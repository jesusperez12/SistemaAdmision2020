@extends ('layouts.diseño')
@section ('contenido')
<section class="content">
<div class="box-header with-border panel-info">

<center><h3 class="box">Consulta al Aspirante</h3></center>
</div>
      <!-- Small boxes (Stat box) -->


  

<div id="DatCOmpletos" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"> Datos Completoss</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <div class="panel-body">
               <div id="list-product"></div>


          </div>
               
            </div>
            <!-- /.box-body -->
        
           
</div>
</div>
<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
    </div>
   
</div>


<div id="DatIncompletosModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"> Aspirantes con datos incompletos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <div class="panel-body">
               <div id="list-incomplet"></div>

          </div>
              
            </div>
</div>
</div>
<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
    </div>
</div>

<div id="Datostodos" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"> Datos Completos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table class="table table-hover">
                       {!! $chart->render() !!}
                  </table>
              
            </div>
            
</div>
</div>
<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
    </div>
</div>


<div id="aspirantesregistrados" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table class="table table-hover">
                    <thead>
                    <tr >
          
          <th ><center>Nombre</center></th>

           <th ><center>Correo</center></th>
         
          <th colspan="3"></th>
                      </tr>
                    </thead>
                    @forelse($users as $aspirante)
                    <tbody>
      
         <td><center>{{ $aspirante->name}}</center></td>
         <td><center>{{ $aspirante->email }}</center></td>
            <td><center></center></td>
          @empty
                    <li>No hay usuarios registrados.</li>

  
                
                      </tr>
                      @endforelse
                     
                    </tbody>
                  </table>
              
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul>
            </div>
</div>
</div>
<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
    </div>
</div>







<div class="col-md-12 col-lg-6 col-xl-6">
									<section class="panel panel-featured-left panel-featured-quartenary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-quartenary">
														<i class="fa fa-user"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Aspirantes registrados en el sistema</h4>
														<div class="info">
															<strong class="amount">{{ $users_count }}</strong>
														</div>
                          </div>
                          
													<div class="summary-footer">
                          <a href="#aspirantesregistrados" class="small-box-footer" data-toggle="modal">ver tabla <i class="fa fa-arrow-circle-right"></i></a>
                          <a href="#Datostodos" class="small-box-footer" data-toggle="modal">ver en grafica<i class="fa fa-arrow-circle-right"></i></a>
                        </div>
												</div>
											</div>
										</div>
									</section>
								</div>

                <div class="col-md-12 col-lg-6 col-xl-6">
									<section class="panel panel-featured-left panel-featured-tertiary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-tertiary">
                          <i class="  fa fa-user-plus"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Aspirantes con Datos de registros completos</h4>
														<div class="info">
															<strong class="amount">{{$records}}</strong>
														</div>
													</div>
													<div class="summary-footer">
                          <a href="#DatCOmpletos" role="button" class="small-box-footer" data-toggle="modal">Más Información <i class="fa fa-arrow-circle-right"></i></a>
													</div>
												</div>
											</div>
										</div>
									</section>
                </div>
                

                <div class="col-md-12 col-lg-6 col-xl-6">
									<section class="panel panel-featured-left panel-featured-tertiary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-green">
														<i class="  fa fa-user-times fa-sm"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title"> Aspirantes con datos incompletos</h4>
														<div class="info">
															<strong class="amount">{{$incompletos}}</strong>
														</div>
													</div>
													<div class="summary-footer">
                          <a href="#DatIncompletosModal" role="button" class="small-box-footer" data-toggle="modal">Más Información <i class="fa fa-arrow-circle-right"></i></a>
													</div>
												</div>
											</div>
										</div>
									</section>
                </div>
                
      @endsection

      @section ('scripts')
 <script type="text/javascript">
 $(document).ready(function(){
        listProduct();
        //listincompleto();
    });

   

     $(document).on("click",".pagination li a",function(a) {
        a.preventDefault();
        var url = $(this).attr("href");
       // alert(url);

        $.ajax({
            type:'get',
            url:url,
            success: function(data){
              $('#list-product').empty().html(data);
             // $('#list-incomplet').empty().html(data);
            }
        });

       
    });


   




    var listProduct = function()
  {
      $.ajax({
          type:'get',
          url:'{{ url('listall')}}',
         
          success: function(data){
            console.log(data);
              $('#list-product').empty().html(data);
          }
      });
  }

  
  /*var listincompleto = function()
  {
      $.ajax({
          type:'get',
          url:'{{ url('Datos')}}',
         
          success: function(data){
            console.log(data);
              $('#list-incomplet').empty().html(data);
          }
      });
  }*/
  </script>
@endsection
