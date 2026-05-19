<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            'Manager',
            'Accountant',
            'Driver',
            'Programmer',
            'HR',
            'Logistician',
            'Operator',
            'Sales',
            'Director',
            'Administrator',
            'Security',
            'Engineer',
            'Technician',
            'Sales Manager',
            'Dispatcher',
            'Warehouse Manager',
        ];

        foreach ($positions as $position) {

            Position::firstOrCreate([
                'name' => $position,
            ]);

        }
    }
}
