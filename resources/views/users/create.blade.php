@extends ('layouts.diseño')
@section ('contenido')


        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-info">
                <div class="panel-heading"><center><h5><strong>Registro de Usuario</strong></h5></center></div>
                 <form class="form-groub" method="POST" action="{{ route('users.store') }}"><br>
                {{ csrf_field() }}
                    @include('users.fragment.form')
                    </form>
                </div>
        </div>
    



@endsection

