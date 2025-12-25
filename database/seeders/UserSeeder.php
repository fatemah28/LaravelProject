<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Pest\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $adminUser= User::create([
            'name' => 'Admin',
            'email'=>'admin@admin.com',
            'email_verified_at'=>now(),
            'password' =>Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        $fatemahUser=User::create([
            'name' => 'Fatemah',
            'email'=>'fatemah@fatemah.com',
            'email_verified_at'=>now(),
            'password' =>Hash::make('fatemah'),
            'remember_token' => Str::random(10),
        ]);
        $adminRole=Role::where('name','Admin')->firstOrFail();
        $userRole=Role::where('name','User')->firstOrFail();
        $adminUser->roles()->attach($adminRole->id);
        $fatemahUser->roles()->attach($userRole->id);
    }
}
