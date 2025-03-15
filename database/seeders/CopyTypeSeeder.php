<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CopyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('copy_types')->insert([
            ['name'=>'No Copy'],
            ['name'=>'Hard Copy'],
            ['name'=>'Soft Copy']
        ]);
    }
}
