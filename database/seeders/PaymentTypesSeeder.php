<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            ['value' => 'Charity'],
            ['value' => 'Limited Company'],
            ['value' => 'Partnership'],
            ['value' => 'Public Limited Company'],
            ['value' => 'Sole Trader'],
            ['value' => 'Other'],
        ];

        DB::table('payment_types')->insert($values);
    }
}
