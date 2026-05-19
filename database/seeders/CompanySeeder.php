<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            ['name' => 'EGS'],
            ['name' => 'INCOTRUCK'],
            ['name' => 'EASTLINE EXPRESS'],
            ['name' => 'TRANSCEKA'],
            ['name' => 'KGS'],
            ['name' => 'CARGOMOST'],
            ['name' => 'LOGEEL'],
            ['name' => 'WESTLINE'],
        ];

        foreach ($companies as $company) {
            Company::firstOrCreate($company);
        }
    }
}
