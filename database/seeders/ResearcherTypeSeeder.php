<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ResearcherTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('researcher_types')->insert([
            ['name'=>'Student'],
            ['name'=>'Government'],
            ['name'=>'Private'],
            ['name'=>'Foriegner']
        ]);
    }
}
