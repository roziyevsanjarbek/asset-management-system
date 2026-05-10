<?php

namespace App\Services;

use App\Models\DeviceAssignment;
use App\Repositories\DeviceAssignmentRepository;

class DeviceAssignmentService
{
    public function __construct(
        private DeviceAssignmentRepository $deviceAssignmentRepository
    ){}

    public function getAll()
    {
        return $this->deviceAssignmentRepository->getAll();
    }

    public function create(array $data)
    {
        return $this->deviceAssignmentRepository->create($data);
    }

    public function find($id)
    {
        return $this->deviceAssignmentRepository->find($id);
    }

    public function update(DeviceAssignment $deviceAssignment, array $data)
    {
        return $this->deviceAssignmentRepository->update($deviceAssignment, $data);
    }

    public function delete(DeviceAssignment $deviceAssignment)
    {
        return $this->deviceAssignmentRepository->delete($deviceAssignment);
    }

}
