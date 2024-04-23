<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MediumsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            ['value' => 'Advertisement'],
            ['value' => 'Contacted by Equals'],
            ['value' => 'Existing Client'],
            ['value' => 'Internet'],
            ['value' => 'Referral'],
            ['value' => 'Social Media'],
            ['value' => 'Other'],
        ];

        DB::table('mediums')->insert($values);
    }
}
