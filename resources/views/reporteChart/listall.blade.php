<table class="table table-hover">
                    <thead>
                    <tr >
         
          <th ><center>Cédula</center></th>
           <th ><center>Pasaporte</center></th>
          <th ><center>Nombre</center></th>
          <th ><center>Apellido</center></th>
         
          <th ><center>Institutos/Extensiones</center></th>
           <th ><center>Especialidad</center></th>
            <th ><center>Cupos Dirigido</center></th>
          <th ><center>Correo</center></th>
          <th ><center>Telefono Movil</center></th>
         
          <th colspan="3"></th>
                      </tr>
                   
                    </thead>
                    @forelse($datcompletos as $datos)
                    <tbody>
      
         <td><center>{{ $datos->Cedula}}</center></td>
         <td><center>{{ $datos->NumPasaporte}}</center></td>
         <td><center>{{ $datos->name}}</center></td>
         <td><center>{{ $datos->PrimerApellido }}</center></td>
         
         <td><center>{{ $datos->NombInstituto }}</center></td>
         <td><center>{{ $datos->NombEspecialidad }}</center></td>
         <td><center>{{ $datos->Cupos}}</center></td>
         <td><center>{{ $datos->email }}</center></td>
         <td><center>{{ $datos->TelefonoMovil }}</center></td>
       
          @empty
                    <li>No hay usuarios registrados.</li>

  
                
                      </tr>
                      @endforelse
                     
                    </tbody>
            
                  </table>
                  <div class="text-center">
               
    {{ $datcompletos->links() }}
</div>


