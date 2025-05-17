<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'fullname' => 'John PM',
            'email' => 'john@mail.com',
            'password' => Hash::make('password'),
            'role' => 'ProjectManager'
        ]);

        User::create([
            'fullname' => 'Doe ENG',
            'email' => 'doe@mail.com',
            'password' => Hash::make('password'),
            'role' => 'Engineer'
        ]);
    }
}
