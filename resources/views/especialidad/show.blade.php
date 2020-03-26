@include('layouts.diseño')


<div class="main_bg1">
<div class="wrap">  
    <div class="main1">
        <h4>PROGRAMAS</h4>
    </div>
</div>
</div> 
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-success">
                 <div class="panel-heading">Especialidad</div>
                <center>
                	<table class="table">
                <thead>
    <tr>
      <td><strong> Especialidad</strong></td>
      <td>{!!$especialidad->NombEspecialidad!!}</td>
      
    </tr>
 			 </thead>

 			 <tbody>
    <tr>
	 <td><strong> Sede</strong></td>
      <td>{!!$especialidad->NombSede!!}</td>
    </tr>
    <tr>
      <td><strong> Vigente</strong> </td>
      <td>{!!$especialidad->Vigente!!}</td>
    </tr>
	

  </tbody>
         </table>  
            
<a href="{{ route('especialidad.index') }}" class="btn btn-success pull-center">ATRÁS</a></h2>
			</center>
       
</div>	<br><br><br><br><br><br> <br><br><br><br><br><br> 	
<!-- start footer -->
<div class="footer_bg1">
<div class="wrap">
	<div class="footer">
		<!-- scroll_top_btn -->
	    <script type="text/javascript">
			$(document).ready(function() {
			
				var defaults = {
		  			containerID: 'toTop', // fading element id
					containerHoverID: 'toTopHover', // fading element hover id
					scrollSpeed: 1200,
					easingType: 'linear' 
		 		};
				
				
				$().UItoTop({ easingType: 'easeOutQuart' });
				
			});
		</script>
		 <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
		<!--end scroll_top_btn -->
		<div class="copy">
			<p class="link"> <strong> <center> Universidad Pedagógica Experimental Libertador</strong> | Dirección de Informática.</center> </a></p>
		</div>
		<div class="clear"></div>
	</div>
</div>
</div>
</body>
</html>
