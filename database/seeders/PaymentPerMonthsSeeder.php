<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentPerMonthsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            ['value' => '0-5 payments per month'],
            ['value' => '6-10 payments per month'],
            ['value' => '11-25 payments per month'],
            ['value' => '26-100 payments per month'],
            ['value' => '100+ payments per month'],
        ];

        DB::table('payment_per_months')->insert($values);
    }
}
