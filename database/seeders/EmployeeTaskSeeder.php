<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\EmployeeTask;

class EmployeeTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $employees = Employee::all();
        foreach ($employees as $employee) {
            for ($i = 0; $i < 1000; $i++) {
                EmployeeTask::factory()->create([
                    'employee_id' => $employee->id,
                    'description' => "Task " . ($i + 1) . " for " . $employee->name
                ]);
            }
        }
    }
}
