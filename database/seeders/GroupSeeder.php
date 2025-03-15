<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('groups')->insert([
            [
                'group_code' => 'AG',
                'name' => 'မော်ကွန်းစာတွဲ'
            ],
            [
                'group_code' => 'RG',
                'name' => 'မှတ်တမ်းစာတွဲ'
            ],
            [
                'group_code' => 'PA',
                'name' => 'စာအုပ်များ'
            ],
            [
                'group_code' => 'Gz',
                'name' => 'ပြန်တမ်းများ'
            ],
            [
                'group_code' => 'Ns',
                'name' => 'သတင်းစာများ'
            ],
            [
                'group_code' => 'Fl',
                'name' => 'Film'
            ],
            [
                'group_code' => 'Fc',
                'name' => 'Fiche'
            ],
            [
                'group_code' => 'Pt',
                'name' => 'Photo'
            ],
            [
                'group_code' => 'Sp',
                'name' => 'Speech'
            ],
            [
                'group_code' => 'Vd',
                'name' => 'Video'
            ],
            [
                'group_code' => 'Ad',
                'name' => 'Audio'
            ]
        ]);
    }
}
