<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'phone_number' => fake()->phoneNumber(),
            'email' => fake()->safeEmail(),

            'company_id' => Company::query()
                ->inRandomOrder()
                ->value('id'),

            'position_id' => Position::query()
                ->inRandomOrder()
                ->value('id'),
        ];
    }
}
