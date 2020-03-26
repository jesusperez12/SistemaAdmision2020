   <div class="form-group">
                        <div class="col-md-6">
                        {!!Form::label('sede')!!}
                        <select name ="sede_id" id="sede">
                        <option value="">Seleccione</option>
                        @foreach($sed as $es)
                         <option value="{{$es->id_sede}}">{{$es->NombSede}}</option>
                        @endforeach
                        </select>
                        </div>    
                        </div>

                        
             <div class="form-group">
                  <div class="col-md-6">
                        {!!Form::label('prueba')!!}
                    <select name ="" id="nucle">
                        
                 </select>
                </div>    
             </div>


