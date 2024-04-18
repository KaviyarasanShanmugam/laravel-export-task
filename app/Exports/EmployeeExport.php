<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Employee::select('employees.name', 'employee_tasks.description', )->leftJoin('employee_tasks', 'employees.id' , '=', 'employee_tasks.employee_id')->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Description',
        ];
    }
}
