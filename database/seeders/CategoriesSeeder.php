<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            ['value' => 'Administrative and Support Services'],
            ['value' => 'Adult & Dating Services'],
            ['value' => 'Agriculture, Forestry and Fishing'],
            ['value' => 'Aircraft'],
            ['value' => 'Arts, Entertainment and Recreation'],
            ['value' => 'Banking, Finance & Insurance Activities'],
            ['value' => 'Bloodstock and domestic animal breeding'],
            ['value' => 'CBD,Tobacco & Vape'],
            ['value' => 'CFD and spreadbetting'],
            ['value' => 'Charity'],
            ['value' => 'Construction'],
            ['value' => 'Crypto Currency & Digital Assets'],
            ['value' => 'Education & Training'],
            ['value' => 'Energy & Fossil Fuels'],
            ['value' => 'Gambling'],
            ['value' => 'Government'],
            ['value' => 'Health and Social Work Activities'],
            ['value' => 'Hospitallity and Food Services'],
            ['value' => 'Information and Communication'],
            ['value' => 'Logistics, storage and transportation'],
            ['value' => 'Manufacture & Repair'],
            ['value' => 'Marine Vessels & Watercraft'],
            ['value' => 'Media'],
            ['value' => 'Mining and Quarrying'],
            ['value' => 'Other Service Activities'],
            ['value' => 'Pharmaceuticals including Medicinal Cannabis'],
            ['value' => 'Professional, Scientific and Technical Activities'],
            ['value' => 'Property & Real Estate'],
            ['value' => 'Retail and Wholesale including Online Stores'],
            ['value' => 'Retail Stores'],
            ['value' => 'Vehicles, plant and machinery'],
            ['value' => 'Waste Management and Remediation Activities'],
            ['value' => 'Weapons, Blades, Self-Defence and Military'],
        ];

        DB::table('categories')->insert($values);
    }
}
