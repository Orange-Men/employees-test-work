<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $departments = ['Marketing', 'Sampling', 'Fabric'];

        foreach ($departments as $department) {
            Department::query()->firstOrCreate(['name' => $department]);
        }

        $departments = Department::all();

        Employee::factory(100)
            ->create()
            ->each(fn (Employee $employee) =>
                $employee->department()->associate($departments->random())->save()
            );
    }
}
