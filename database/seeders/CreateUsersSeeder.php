<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            'user1@gmail.com',
            'user2@gmail.com',
            'user3@gmail.com',
            'user4@gmail.com',
            'user5@gmail.com'

         ];

        foreach ($users as $key => $item) {
            $user = User::create([
                'name' => "User-$key",
                'email' => $item,
                'password' => bcrypt('12345678')
            ]);

            $role = Role::where(['name' => 'user'])->first();

            $user->assignRole([$role->id]);
        }
    }
}
