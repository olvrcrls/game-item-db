<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('Seeding the database...');
        $this->command->info('Seeding the User records...');
        \App\Models\User::factory(10)->create();

        $this->command->info('Seeding the Game records...');
        \App\Models\Game::factory(25)->create();

        $this->command->info('Seeding the Item records...');
        \App\Models\Item::factory(100)->create();
    }
}
