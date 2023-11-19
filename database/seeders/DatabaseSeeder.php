<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run() : void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'username' => 'gojooo',
            'name' => 'Gojo Satoru',
            'email' => 'gojo@gmail.com',
            'prof_pic' => 'prof-pic/user.png',
            'role' => 'member',
            'password' => Hash::make('gojooo')
        ]);
        User::create([
            'username' => 'admin_perpus',
            'name' => 'Admin Perpus',
            'email' => 'admin@gmail.com',
            'prof_pic' => 'prof-pic/user.png',
            'role' => 'admin',
            'password' => Hash::make('admin_perpus')
        ]);
        $this->call(BookSeeder::class);
        $this->call(TypeSeeder::class);
    }
}
