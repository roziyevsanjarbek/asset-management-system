<?php

namespace Database\Factories;

use App\Models\DeviceType;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeviceTypeFactory extends Factory
{
    protected $model = DeviceType::class;

    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
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
            ]),
        ];
    }
}
