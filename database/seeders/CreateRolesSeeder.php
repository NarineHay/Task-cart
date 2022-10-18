<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'moderator',
            'organizer',
            'visitor',
            'user'
         ];

         foreach ($roles as $item) {

              $role = Role::create(['name' => $item]);

              $permissions = Permission::pluck('id','id')->all();

              $role->syncPermissions($permissions);

         }
    }
}
