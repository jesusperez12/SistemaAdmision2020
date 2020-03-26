<table class="table table-hover">
                    <thead>
                    <tr >
          
          <th ><center>Nombre</center></th>
          <th ><center>Apellido</center></th>

           <th ><center>Correo</center></th>
           <th ><center>Datos Personales</center></th>
           <th ><center>Datos Basicos</center></th>
           <th ><center>Datos Academicos</center></th>
           <th ><center>Experiencia Laboral</center></th>
           <th ><center>Socio Economico</center></th>
           <th ><center>Prueba Diagnostico</center></th>
         
          <th colspan="3"></th>
                      </tr>
                    </thead>
                    @forelse($aspi as $aspirante)
                    <tbody>
      
         <td><center>{{ $aspirante->name}}</center></td>
         <td><center>{{ $aspirante->PrimerApellido }}</center></td>
     
         <td><center>{{ $aspirante->email }}</center></td>
          <td><center>{{ $aspirante->datos_personales }}</center></td>
           <td><center>{{ $aspirante->datos_basicos }}</center></td>
            <td><center>{{ $aspirante->datos_academico }}</center></td>
             <td><center>{{ $aspirante->datos_Experiencia }}</center></td>
          <td><center>{{ $aspirante->datos_socioEconomico }}</center></td>
            <td><center></center></td>
          @empty
                    <li>No hay usuarios registrados.</li>

  
                
                      </tr>
                      @endforelse
                     
                    </tbody>
                  </table>
                  <div class="text-center">
                  
    {{ $aspi->links() }}
</div>


