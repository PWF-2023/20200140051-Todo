<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create(
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$AXT0rtSDq9FcVp.4CgcgHeKnQYZSMfECpA.qU8036AF9ElHl8IGuO', // password
                'remember_token'=> Str::random(10),
                'is_admin' => true
            ]
        );
        User::factory(100)->create();
        Todo::factory(500)->create();
    }
}
