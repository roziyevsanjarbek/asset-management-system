<?php

namespace App\Services;

use App\Models\Employee;
use App\Repositories\EmployeeRepository;

class EmployeeService
{
    public function __construct(
        private EmployeeRepository $employeeRepository
    ){}


    public function getAll()
    {
        return $this->employeeRepository->getAll();
    }

    public function create(array $data)
    {
        return $this->employeeRepository->create($data);
    }

    public function find($id)
    {
        return $this->employeeRepository->find($id);
    }

    public function update(Employee $employee, array $data)
    {
        return $this->employeeRepository->update($employee, $data);
    }

    public function delete(Employee $employee)
    {
        return $this->employeeRepository->delete($employee);
    }
}
