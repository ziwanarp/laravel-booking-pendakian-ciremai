<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'alamat' => 'admin',
            'role' => 'Admin',
            'jenis_kelamin' => 'L',
            'jenis_identitas' => 'KTP',
            'no_identitas' => '12345678910',
            'no_hp' => '12345678910',
            'foto_identitas' => 'admin.jpg',

            'password' => Hash::make('password'),

        ]);
    }
}
