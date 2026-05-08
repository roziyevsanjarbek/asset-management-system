<?php

namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository
{
    public function getAll()
    {
        return Employee::query()->with('role')->get();
    }

    public function create(array $data)
    {
        return Employee::query()->create($data);
    }

    public function find($id)
    {
        return Employee::query()->find($id);
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
