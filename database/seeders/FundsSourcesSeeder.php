<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class FundsSourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sources = [
            'Funding from your account',
            'Loan',
            'Payment(s) from linked company account',
            'Third party payment(s) from Customer',
            'Other Third party payment(s)'
        ];

        foreach ($sources as $source) {
            DB::table('funds_sources')->insert([
                'value' => $source,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
