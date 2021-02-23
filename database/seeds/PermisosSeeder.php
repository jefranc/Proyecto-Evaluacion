<?php

use App\Ciclo;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;
use App\Categoria;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        //permisos generales
        $per_resultados = Permission::create(['name' => 'resultados']);
        $per_misresultados = Permission::create(['name' => 'misresultados']);
        $per_todosresultados = Permission::create(['name' => 'todosresultados']);
        $per_areas = Permission::create(['name' => 'areas']);

        //Permisos Coevaluador
        $per_coevaluacion = Permission::create(['name' => 'coevaluar']);

        //Permisos Director
        $per_ver_docentes = Permission::create(['name' => 'ver_docentes']);

        //Permisos Docente
        $per_evaluar = Permission::create(['name' => 'evaluar']);

        //Permisos Administrador
        $per_dar_permisos = Permission::create(['name' => 'dar_permisos']);
        
        //roles para Coevaluador
        $role_coevaluador = Role::create(['name' => 'coevaluador']);
        $role_coevaluador->givePermissionTo($per_coevaluacion);
        $role_coevaluador->givePermissionTo($per_resultados);

        //Roles Director
        $role_director = Role::create(['name' => 'director']);
        $role_director->givePermissionTo($per_ver_docentes);
        $role_director->givePermissionTo($per_resultados);
        $role_director->givePermissionTo($per_todosresultados);
        $role_director->givePermissionTO($per_areas);

        //Roles para Docente
        $role_docente = Role::create(['name'=> 'docente']);
        $role_docente->givePermissionTo($per_evaluar);
        $role_docente->givePermissionTo($per_resultados);
        $role_docente->givePermissionTo($per_misresultados);

        //Roles para Admin
        $role_admin = Role::create(['name' => 'admin']);
        $role_admin->givePermissionTO($per_dar_permisos);
        $role_admin->givePermissionTO($per_areas);

        //creacion de las categorias
        $categoriaTics = Categoria::insert([
            'nombre' => 'Tics'
        ]);
        $categoriaPeda = Categoria::insert([
            'nombre' => 'Pedagógica'
        ]);
        $categoriaDida = Categoria::insert([
            'nombre' => 'Didáctica'
        ]);
        


        //creacion de usuarios preterminados
        $user = User::create([
            'name' => 'Styde',    //coevaluador
            'apellido' => 'Cuesta',
            'email' => 'admin@styde.net',
            'cedula' => '1478521462',
            'password' => bcrypt('secret'),
            'imagen' => 'fotoperfil/defecto.png',
            'status' => '0',
            'auto' => '0'
        ]);


        $user2 = User::create([    //director
            'name' => 'Jean',
            'apellido' => 'Mosquera',
            'email' => 'jefranc_10@hotmail.com',
            'cedula' => '0706256468',
            'password' => bcrypt('oliver123*'),
            'imagen' => 'fotoperfil/defecto.png',
            'status' => '0',
            'auto' => '0'
        ]);

        $user3 = User::create([
            'name' => 'Erika',    //docente
            'apellido' => 'Mosquera',  
            'email' => 'erika@hotmail.com',
            'cedula' => '0704568910',
            'password' => bcrypt('oliver123*'),
            'imagen' => 'fotoperfil/defecto.png',
            'status' => '0',
            'auto' => '0'
        ]);

        $user4 = User::create([
            'name' => 'admin',
            'apellido' => 'admin',    //admin
            'email' => 'admin@hotmail.com',
            'cedula' => '0993453080',
            'password' => bcrypt('oliver123*'),
            'imagen' => 'fotoperfil/defecto.png',
            'status' => '0',
            'auto' => '0'
        ]);
        // Asignación del rol
        $user->assignRole('coevaluador');
        $user2->assignRole('director');
        $user3->assignRole('docente');
        $user4->assignRole('admin');


        

    }
}
