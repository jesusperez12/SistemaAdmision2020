@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-md-12">
								<section class="panel form-wizard" id="w5">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="fa fa-caret-down"></a>
											<a href="#" class="fa fa-times"></a>
										</div>
						
										<h2 class="panel-title">Pueba Diagnóstica</h2>
									</header>
									<div class="panel-body">
										<div class="wizard-tabs hidden">
										
											<ul class="wizard-steps">
											@foreach($grupos as $index => $grupo)  
												<li class="active">
													<a href="#w5-account" data-toggle="tab"><span class="badge">Intro</span>Ayuda</a>
												</li>
												@for($i = 0; $i < $grupo->count(); $i++)

													<li>

														<a href="#grupo{{ $i }}" data-toggle="tab">

															<span class="badge">2</span>Grupo $i

														</a>

													</li>

													@endfor
												
											
											</ul>
											@endforeach
										</div>
										<div class="progress progress-striped progress-xl m-md light">
											<div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
												<span class="sr-only">100%</span>
											</div>
										</div>
	

		<form class="form-horizontal" method="POST" name="pregunta[]"  action="{{ route('Diagnostico.store') }}">
										{{Form::token()}}
										<div id="rootwizard">
											<div class="tab-content">
												<div id="w5-account" class="tab-pane active">
												<b>
										<big>	INSTRUCCIONES. A continuación se le presenta una serie de actividades en grupos con (3) 
													items en cada grupo. Léalas con atención y decida cuál de esas tres es la que más le agrada, 
													marcando en la sección de respuestas la letra (A). Luego decida qué actividad le gusta menos 
													y seleccione la letra (B). Usted solo debe indicar una opción con la letra (A) la que más le agrada 
													y una sola con la letra (B).
										</b>
										<strong>
											<p>
															
														Usted solo debe indicar una respuesta con la letra (A) 
														y una sola respuesta con la letra (B) POR GRUPO

														Ejemplo:
													</p>
										</strong>
											</big>
									<div class="box ">
											
										<div class="box-body">
											<div class="form-group">	
												<strong>	1. Asistir a una exposición de arte contemporaneo</strong>	

												
												<label>
												<input type="checkbox" name="r1" class="minimal"  disabled>
												</label>
												<label>
												<strong>A</strong>

												<label>
												<input type="checkbox" name="r1" class="minimal" checked disabled>
												</label>
												<label>
												<strong>B</strong>
												
												</div>

												<div class="form-group">
												<strong>2. Dar una charla sobre la violencia en la Televisión</strong>	

													
												<label>
												<input type="checkbox" name="r1" class="minimal"  disabled>
												</label>
												<label>
												<strong>A</strong>

												<label>
												<input type="checkbox" name="r1" class="minimal"  disabled>
												</label>
												<label>
												<strong>B</strong>
										
												</div>
										
												<div class="form-group">
												<strong>3. Hacer una expedición con tus amigos</strong>	

												
												<label>
												<input type="checkbox" name="r1" class="minimal" checked disabled>
												</label>
												<label>
												<strong>A</strong>

												<label>
												<input type="checkbox" name="r1" class="minimal"  disabled>
												</label>
												<label>
												<strong>B</strong>
												</div>
										</div>
									</div>
											</br>
											<b>
										<big>	En este ejemplo la persona ha indicado que, de las (3) tres actividades expuestas,
											LO QUE MÁS LE AGRADA ES HACER UNA EXPEDICIÓN CON SUS AMIGOS, y 
											la que MENOS LE GUSTA ES ASISTIR A UNA EXPOSICIÓN DE ARTE CONTEMPORANÉO.
											 Aquella que le es indiferente o no le agrada o desagrada quedará sin marca.
											  En algunos casos encontrará que las tres actividades son igualmente agradables 
											  o desagradables; sin embargo, debe indicar las que escogería para dar respuesta 
											  completa al planteamiento. No discuta las opciones con nadie; la respuesta no es 
											  válida, a menos que haya sido decidida por usted
											</b>
										</big>

									</div>
									
									

									
														@foreach($grupos as $index => $grupo)                                
																		

														<div id="grupo{{ $index }}" class="tab-pane">

															<div class="box ">

																<div class="box-body">


																		
																		
																		
																			<button type="button" class="btn btn-block btn-default btn-xs button-reset" data-grupo-input="{{ $grupo->id }}">Reiniciar respuestas</button>
																		
																		
																		
																				@foreach($grupo->pregunta as $preguntas)
																		<div class="form-group{{ $errors->has('respuest') ? ' has-error' : '' }}">	
																			<div class="col-md-6 col-md-offset-2">
																		{{$preguntas->preguntas}}
																			</div>
															
															
																<label>
																<input type="checkbox" name="respuest[{{$preguntas->id}}]" value="A" class="flat-red" data-grupo="{{ $grupo->id }}" required>
																</label>
																<label>
																<strong>A</strong>
																<label>
																<input type="checkbox" name="respuest[{{$preguntas->id}}]" value="B" class="flat-red" data-grupo="{{ $grupo->id }}"  required>
																</label>
																<label>
																<strong>B</strong>


																@if ($errors->has('respuest'))
																<span class="help-block-left">
																&nbsp;
																	<strong>{{ $errors->first('respuest') }}</strong>
																</span>
																@endif
																										
															</div>
																
																

														@endforeach	
																
																
																

																</div>
																	</div>
																
																</div>
																	
																@endforeach 
															






									<div class="panel-footer">
										<ul class="pager">
											<li class="previous disabled">
												<a><i class="fa fa-angle-left"></i> Previous</a>
											</li>
											<li class="finish hidden pull-right">
											{!!Form::submit('GUARDAR', ['class' => 'btn btn-success', 'id'=>'boton_enviar'])!!}
											</li>
										  
										
											<li class="next">
												<a>Next <i class="fa fa-angle-right"></i></a>
											</li>
										</ul>
									</div>
									</div>
									</form>											
	
								</section>
							</div>
						</div>
						
			
 
@endsection

@section ('scripts')
<script type ="text/javascript"> 


	var contador = [];
	var control = $("#myCheck");


        $('.flat-red').each(function () {

            let grupo = $(this).data('grupo');

            contador[grupo] = {a: 0, b: 0, preguntas: []};

       		 });
        		$('.flat-red').change(function () {

            let input = $(this);

            let grupo = input.data('grupo');

                        

            if (input.is(':checked')) {

                if (input.val() === "A") {

                    contador[grupo].a += 1;

                    if (contador[grupo].b && contador[grupo].b > 1) {

                        contador[grupo].b -= 1;

                    }

                } 

                else if (input.val() === "B") {

                    if (contador[grupo].a && contador[grupo].a > 1) {

                        contador[grupo].a -= 1;

                    }

                    contador[grupo].b += 1;

                }


                 if (! contador[grupo].preguntas.includes(input.attr('name'))) {

                    contador[grupo].preguntas.push(input.attr('name'));

                } 

            }
			

            	if (contador[grupo].a > 1 && contador[grupo].b > 1) {
				
                console.log('Seleccione respuestas diferentes');

           	 }

            	else

            	{

                $('[data-grupo="' + grupo + '"]').each(function () {

                    let inputGrupo = $(this);


                    if (contador[grupo].a === 1 && contador[grupo].b === 1) {

                        /* if (! inputGrupo.is(':checked') && ! contador[grupo].preguntas.includes(inputGrupo.attr('name'))) { */

                        if (! inputGrupo.is(':checked')) {

                            inputGrupo.attr('disabled', true);

                        } 
					

                    }

                });

            }



        })

		$('.button-reset').click(function () { 
		
			let input = $(this);

			let grupo = input.data('grupo-input');

			contador[grupo] = {a: 0, b: 0, preguntas: []};

			$('input[data-grupo="' + grupo + '"]').each(function () {
				let inputGrupo = $(this);
					if (inputGrupo.is(':checked')) {
					inputGrupo.prop('checked', false);
					} else {
						inputGrupo.prop('disabled', false);
					}
				});
		})

</script>
@endsection