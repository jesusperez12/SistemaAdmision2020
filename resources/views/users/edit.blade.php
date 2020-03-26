@extends ('layouts.diseño')
@section ('contenido')

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
           
             
               
                {{ csrf_field() }}
                    {!!Form::model($user,['route'=>['users.update',$user->id],'method'=>'PUT'])!!}
                    
                    @include('users.fragment.edit')
                </div>
        </div>
    



@endsection

        
@section ('scripts')
    <script type ="text/javascript">
    $(document).ready(function() {
    $('.select2').select2();
    });

             
$(function () { 
            $('#sede').change(function(){
                var valor = $(this).val();
            $("#nucle").empty();
            axios.get('{{ route("get-nucleos")}}',{
                params: {
                valor : valor
                
            }
        }).then(response =>{
                //alert(response.data);
                $('#nucle').append('<option>--Seleccione--</option>');
                response.data.forEach(nucleo => {
                $('#nucle').append('<option value="'+nucleo.id+'">'+nucleo.NombInstituto+'</option>');
                
            });
        
            }); 
        });
    });        
</script>
@endsection