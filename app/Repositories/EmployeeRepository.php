<?php

namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository
{
    public function getAll()
    {
        return Employee::with(['devices.type', 'position', 'company'])->get();
    }

    public function create(array $data)
    {
        return Employee::query()->create($data);
    }

    public function find($id)
    {
        return Employee::with(['devices.type', 'position', 'company'])->find($id);
    }

    public function update(Employee $employee, array $data)
    {
        $employee->update($data);
        return $employee;
    }

    public function delete(Employee $employee)
    {
        return $employee->delete();
    }

}
