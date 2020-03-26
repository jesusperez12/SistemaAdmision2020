<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Users
        Permission::create([
            'name'          => 'Navegar usuarios',
            'slug'          => 'users.index',
            'description'   => 'Lista y navega todos los usuarios del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de usuario',
            'slug'          => 'users.show',
            'description'   => 'Ve en detalle cada usuario del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Edición de usuarios',
            'slug'          => 'users.edit',
            'description'   => 'Podría editar cualquier dato de un usuario del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar usuario',
            'slug'          => 'users.destroy',
            'description'   => 'Podría eliminar cualquier usuario del sistema',      
        ]);

        Permission::create([
            'name'          => 'Asignar nucleos al usuario',
            'slug'          => 'users.asignar',
            'description'   => 'Podría asignar nucleos a cualquier usuario del sistema',      
        ]);

        //Roles
        Permission::create([
            'name'          => 'Navegar roles',
            'slug'          => 'roles.index',
            'description'   => 'Lista y navega todos los roles del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un rol',
            'slug'          => 'roles.show',
            'description'   => 'Ve en detalle cada rol del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de roles',
            'slug'          => 'roles.create',
            'description'   => 'Podría crear nuevos roles en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de roles',
            'slug'          => 'roles.edit',
            'description'   => 'Podría editar cualquier dato de un rol del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar roles',
            'slug'          => 'roles.destroy',
            'description'   => 'Podría eliminar cualquier rol del sistema',      
        ]);

        //ofertas
        Permission::create([
            'name'          => 'Navegar ofertas',
            'slug'          => 'ofertas.index',
            'description'   => 'Lista y navega todos los productos del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de una oferta',
            'slug'          => 'ofertas.show',
            'description'   => 'Ve en detalle cada producto del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de la oferta',
            'slug'          => 'ofertas.create',
            'description'   => 'Podría crear nuevos productos en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de la oferta',
            'slug'          => 'ofertas.edit',
            'description'   => 'Podría editar cualquier dato de un producto del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar la oferta',
            'slug'          => 'ofertas.destroy',
            'description'   => 'Podría eliminar cualquier oferta del sistema',      
        ]);

        Permission::create([
            'name'          => 'ofertas por Aprobar',
            'slug'          => 'ofertas.consultaAprobacion',
            'description'   => 'Podría ver cualquier oferta creada en el sistema',      
        ]);

        Permission::create([
            'name'          => 'Aprobar oferta',
            'slug'          => 'ofertas.aprobar',
            'description'   => 'Podría Aprobar cualquier oferta del sistema',      
        ]);

        Permission::create([
            'name'          => 'ofertas para desaprobar',
            'slug'          => 'ofertas.desAprobarindex',
            'description'   => 'Podría ver cualquier oferta aprobada en el sistema',      
        ]);

        Permission::create([
            'name'          => 'Desaprobar oferta',
            'slug'          => 'ofertas.desaprobar',
            'description'   => 'Podría Desaprobar cualquier oferta del sistema',      
        ]);

        

        //especialidad
        Permission::create([
            'name'          => 'Navegar Especialidad',
            'slug'          => 'Especialidad.index',
            'description'   => 'Lista y navega todas las especialidades del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de una Especialidad',
            'slug'          => 'Especialidad.show',
            'description'   => 'Ve en detalle cada especialidades del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de la Especialidad',
            'slug'          => 'Especialidad.create',
            'description'   => 'Podría crear nuevas especialidades en el sistema',
        ]);
        

        Permission::create([
            'name'          => 'Edición de la Especialidad',
            'slug'          => 'Especialidad.edit',
            'description'   => 'Podría editar cualquier dato de una especialidad del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar la Especialidad',
            'slug'          => 'Especialidad.destroy',
            'description'   => 'Podría eliminar cualquier especialidad del sistema',      
        ]);



        //nueva Especialidad

        Permission::create([
            'name'          => 'Nueva Especialidad',
            'slug'          => 'NuevaEspecialidad.index',
            'description'   => 'Navegar nueva Especialidad para el sistema',      
        ]);
        
        Permission::create([
            'name'          => 'Editar Nueva Especialidad',
            'slug'          => 'NuevaEspecialidad.edit',
            'description'   => 'Editar Nueva Especialidad para el sistema',      
        ]);

        Permission::create([
            'name'          => 'Crear Nueva Especialidad',
            'slug'          => 'NuevaEspecialidad.create',
            'description'   => 'Crear Nueva Especialidad para el sistema',      
        ]);

        Permission::create([
            'name'          => 'Eliminar Nueva Especialidad',
            'slug'          => 'NuevaEspecialidad.destroy',
            'description'   => 'Eliminar Nueva Especialidad para el sistema',      
        ]);



        //periodo
        Permission::create([
            'name'          => 'Navegar Periodo',
            'slug'          => 'periodo.index',
            'description'   => 'Lista y navega todas las especialidades del sistema',
        ]);

        Permission::create([
            'name'          => 'Creación de Periodo',
            'slug'          => 'perido.create',
            'description'   => 'Podría crear nuevas especialidades en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de Periodo',
            'slug'          => 'periodo.edit',
            'description'   => 'Podría editar cualquier dato de una especialidad del sistema',
        ]);
        
      //Charts
      Permission::create([
        'name'          => 'Navegar Reporte',
        'slug'          => 'charts.index',
        'description'   => 'Lista y navega todos los reportes',
    ]);

    Permission::create([
        'name'          => 'Creación de Reporte',
        'slug'          => 'charts.create',
        'description'   => 'Podría crear reportes para el sistema',
    ]);
    
    Permission::create([
        'name'          => 'Edición de Reporte',
        'slug'          => 'charts.show',
        'description'   => 'Podría consultar los reportes creados por el funcionario',
    ]);

    }
}
