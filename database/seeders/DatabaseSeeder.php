<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test',
            'email' => 'test@gmail.com',
            'password' => Hash::make('shimanto'),
            'role' => 'user',
            'email_verified_at' => now(),
            'remember_token' => \Illuminate\Support\Str::random(60),
        ]);

        Product::factory()->create([
            'name' => 'Test Product',
            'description' => 'lorem ipsum dolor sit amet',
            'price' => '1000',
            'stock' => '10',
            'created_at' => now(),
        ]);

        $this->call([
            AdminUserSeeder::class,
        ]);
    }
}