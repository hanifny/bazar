<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Hanif Nuryanto', 
            'email' => 'hanif@right.devv',
            'password' => bcrypt('password')
        ]);

        Role::create(['name' => 'admin']);
        $user->assignRole('admin');
    }
}
