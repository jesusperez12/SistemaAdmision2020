@extends ('layouts.diseño')
@section ('contenido')

<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-md-offset-2">
<div class="box box-primary">
      
         
             <div class="panel-heading"><center><h5><strong>Crear Indice Admision</strong> </h5></center> </div>
             
       




                
                <div class="panel-body">

                   

                    {!!Form::open(['route'=>'indice.store'])!!}
                    
                @include('IndiceAdmision.fornularios.form') 

                  {!!Form::close()!!}
                  
                      
                </div>
            </div>
            </div>  
@endsection