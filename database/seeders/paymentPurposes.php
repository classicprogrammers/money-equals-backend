<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class paymentPurposes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $purposes = [
            'business acquisition',
            'business costs/revenue',
            'charity donation',
            'dividend payments',
            'incentives/grants',
            'intercompany transfers',
            'investment',
            'legal fees',
            'loan',
            'mortgage payments',
            'one off payment',
            'other',
            'paying overseas suppliers',
            'payment for services',
            'property maintenance',
            'property purchase',
            'property sale',
            'purchase of goods',
            'relocating abroad',
            'repatriation of funds',
            'royalties',
        ];

        foreach ($purposes as $purpose) {
            DB::table('payment_purposes')->insert([
                'value' => $purpose,
            ]);
        }
    }
}
