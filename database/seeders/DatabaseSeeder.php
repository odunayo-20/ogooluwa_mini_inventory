<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Supplier::factory(5)->create();
        Customer::factory(5)->create();
        Category::factory(5)->create();

        User::factory()->create([
            'first_name' => 'Test User',
            'last_name' => 'User',
            'email' => 'student@gmail.com',
            'password' => '12345',
        ]);
    }
}
