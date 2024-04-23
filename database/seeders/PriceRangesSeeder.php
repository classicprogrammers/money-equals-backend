<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceRangesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            ['value' => '£0-£100k'],
            ['value' => '£100k-£250k'],
            ['value' => '£250k-£500k'],
            ['value' => '£500k-£1mil'],
            ['value' => '£1mil-£5mil'],
            ['value' => '£5mil+'],
        ];

        DB::table('price_ranges')->insert($values);
    }
}
