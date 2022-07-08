<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'birthday' => fake()->date('Y-m-d', '-18 years'),
            'position' => Arr::random(['Controls Engineer',
                Arr::random(['Assembly Supervisor', 'Assistant Plant Manager', 'Chief Manufacturing Executive',
                    'Chief Quality Control Executive', 'Civil Engineering Supervisor', 'Controls Engineer',
                    'Distribution Manager'])
            ]),
            'payment_type' => $payment_type = Arr::random([Employee::STATUS_RATE, Employee::STATUS_HOURLY_RATE]),
            'payment' => $payment_type === Employee::STATUS_RATE
                ? rand(1000, 10000)
                : rand(10, 60),
        ];
    }
}
