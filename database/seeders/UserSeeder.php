<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $adminRoleId = Role::where('name', 'owner')->first();

        User::create([
            'name'              => $faker->name,
            'email'             => 'owner@mail.com',
            'password'          => Hash::make('password'),
            'role_id'           => $adminRoleId->id,
        ]);
    }
}