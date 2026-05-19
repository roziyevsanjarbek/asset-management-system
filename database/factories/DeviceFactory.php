<?php

namespace Database\Factories;

use App\Models\Device;
use App\Models\DeviceType;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeviceFactory extends Factory
{
    protected $model = Device::class;

    public function definition(): array
    {
        return [
            'device_type_id' => DeviceType::query()
                ->inRandomOrder()
                ->value('id'),

            'inventory_number' => 'INV-' . fake()->unique()->numberBetween(1000, 99999),

            'serial_number' => strtoupper(fake()->bothify('SN-########')),

            'name' => fake()->randomElement([
                'Dell Latitude',
                'HP ProBook',
                'MacBook Pro',
                'Lenovo ThinkPad',
                'Asus VivoBook',
                'Canon Printer',
                'Samsung Monitor',
                'iPhone',
                'iPad',
                'MikroTik Router',
            ]),
        ];
    }
}
