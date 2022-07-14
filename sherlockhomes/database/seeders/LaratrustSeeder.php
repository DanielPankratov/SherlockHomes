<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config\laratrust;

class LaratrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin  = Role::create(['name' => 'admin']);
        $superadmin = Role::create(['name'=> 'superadmin']);

        $user = User::create([
            'email' => 'superadmin@gmail.com',
            'name' => 'Super Admin',
            'password' => Hash::make('Daniel+333')
        ]);

        $user->attachRole('superadmin');
        $user->attachRole('admin');
        
    }
}

