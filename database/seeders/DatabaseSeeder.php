<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        User::create([
            'name' => 'khoiruddoa',
            'email' => 'khoiruddoa@gmail.com',
            'password' => bcrypt('password'),
            'role' => true
        ]);

        User::factory(5)->create();
    }
}
