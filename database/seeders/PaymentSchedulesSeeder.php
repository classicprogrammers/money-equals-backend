<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            ['value' => 'Daily'],
            ['value' => 'Weekly'],
            ['value' => 'Monthly'],
            ['value' => 'Quarterly'],
            ['value' => 'Annually'],
            ['value' => 'One-Off'],
        ];

        DB::table('payment_schedules')->insert($values);
    }
}
