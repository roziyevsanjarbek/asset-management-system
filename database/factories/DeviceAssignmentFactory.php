<?php

namespace Database\Factories;

use App\Models\Device;
use App\Models\DeviceAssignment;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeviceAssignmentFactory extends Factory
{
    protected $model = DeviceAssignment::class;

    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('-1 year', 'now');

        return [
            'device_id' => Device::query()
                ->inRandomOrder()
                ->value('id'),

            'employee_id' => Employee::query()
                ->inRandomOrder()
                ->value('id'),

            'start_date' => $startDate,

            'end_date' => fake()->optional(0.3)
                ->dateTimeBetween($startDate, 'now'),

            'status' => fake()->randomElement([
                'active',
                'returned',
                'repair',
            ]),
        ];
    }
}
