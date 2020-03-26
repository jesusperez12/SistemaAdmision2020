@extends ('layouts.admin')
@section ('contenido')
<div style="text-align:center;">
  <div class="row">
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              
                <div class="box-header">
                  <h3 class="box-title">REPORTES DEL SISTEMA</h3>
                  <div class="box box-success">
                  <div class="box-tools">
                    <div class="input-group" style="width: 20px;">
                      <div class="input-group-btn">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.box-header -->
                      <center>
                
                  
                  <table class="table table-hover" border="0">
                  <tr  bgcolor="LightCyan" height="10" >
                      <th colspan="4" height="10" width="5">N°</th>
                      <th>REPORTE</th>
                      <th colspan="2"><P align="right">VER</P></th>
                      <th><P align="left">DESCARGAR</P></th>
                    </tr>
                    <tr>
                      <td colspan="4" height="10" width="5">1</td>
                      <th> PLANILLA</th>
                      <td colspan="2"><P align="right"><a href="{{ route('veReporte',['ver'=>'pdf']) }}" target="_blank" ><button class="btn btn-primary fa fa-eye btn-sm"></button></a></P></td>

                      <td><P align="left"><a href="{{ route('vistaHTMLPDF',['descargar'=>'pdf']) }}" target="_blank" ><button class="btn btn-success fa fa-download btn-sm"></button></a></P></td>
                    
                    </tr>
                    @if (count($admitidos) > 0)
                    <tr>
                      <td colspan="4" height="10" width="5">2</td>
                      <th> Constancia de Admisión </th>
                      <td colspan="2"><P align="right"><a href="{{ route('planillaAdmitido',['ver'=>'pdf']) }}" target="_blank" ><button class="btn btn-primary fa fa-eye btn-sm"></button></a></P></td>

                      <td><P align="left"><a href="{{route('reporte.pdf')}}" target="_blank" ><button class="btn btn-success fa fa-download btn-sm"></button></a></P></td>
                    
                    </tr>
         @else
     
          @endif

                 
                   
                </table>
                </center><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
 </div>
 </div>
 @endsection