<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Candidates;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([LanguagesSeeder::class]);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin1@admin.com',
        ]);

        Candidates::factory()->count(50)->create();
    }
}
