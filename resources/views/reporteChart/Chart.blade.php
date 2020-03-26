@extends ('layouts.diseño')
@section ('contenido')

<div class="container">

		<h1>reporte de grafico</h1>

		{!! $chart->render() !!}

	</div>
@endsection