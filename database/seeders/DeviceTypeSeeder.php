<?php

namespace Database\Seeders;

use App\Models\DeviceType;
use Illuminate\Database\Seeder;

class DeviceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Laptop',
            'Computer',
            'Monitor',
            'Printer',
            'Scanner',
            'Phone',
            'Tablet',
            'Keyboard',
            'Mouse',
            'Router',
            'Switch',
            'Server',
            'Camera',
            'Projector',
        ];

        foreach ($types as $type) {

            DeviceType::firstOrCreate([
                'name' => $type,
            ]);

        }
    }
}
