<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tax;

class TaxesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tax::create([
            'ipn' => 0.10,
            'pension_contribution' => 0.10,
            'vosms' => 0.02,
            'osms' => 0.02,
            'social_contribution' => 0.035,
            'id_month' => 8,
            'id_year' => 2021
        ]);

      
    }
}
