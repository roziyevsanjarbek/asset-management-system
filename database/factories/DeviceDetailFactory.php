<?php

namespace Database\Factories;

use App\Models\Device;
use App\Models\DeviceDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeviceDetailFactory extends Factory
{
    protected $model = DeviceDetail::class;

    public function definition(): array
    {
        return [
            'device_id' => Device::query()
                ->inRandomOrder()
                ->value('id'),

            'key' => fake()->randomElement([
                'CPU',
                'RAM',
                'Storage',
                'OS',
                'IP Address',
                'MAC Address',
                'Graphic Card',
                'Battery',
            ]),

            'value' => fake()->randomElement([
                'Intel Core i7',
                '16 GB',
                '512 GB SSD',
                'Windows 11',
                fake()->localIpv4(),
                fake()->macAddress(),
                'NVIDIA RTX 3060',
                '85%',
            ]),
        ];
    }
}
