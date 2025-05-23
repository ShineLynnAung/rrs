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
        $this->call(CopyTypeSeeder::class);

        $this->call(CountrySeeder::class);

        $this->call(LocationSeeder::class);

        $this->call(ResearcherTypeSeeder::class);

        // $this->call(RoleSeeder::class);

        $this->call(UserSeeder::class);

        $this->call(GroupSeeder::class);
    }
}
