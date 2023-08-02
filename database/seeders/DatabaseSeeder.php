<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\identitas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        identitas::create([
            'nama' => "RSUD " . fake()->name(),
            'alamat' => fake()->address(),
            'video' => 'video.ikon',
            'deskripsi' => fake()->sentence(10),
            'logo' => 'logo.png'
        ]);
    }
}
