<?php

namespace App\Repositories;

use App\Models\DeviceAssignment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class DeviceAssignmentRepository
{

    public function getAll(): Collection
    {
        return DeviceAssignment::query()->with(['device', 'employee'])->get();
    }

    public function create(array $data)
    {
        return DeviceAssignment::query()->create($data);
    }

    public function find($id): Model|Collection|DeviceAssignment|null
    {
        return DeviceAssignment::query()->with(['device', 'employee'])->find($id);
    }

    public function update(DeviceAssignment $deviceAssignment, array $data): DeviceAssignment
    {
        $deviceAssignment->update($data);
        return $deviceAssignment;
    }

    public function delete(DeviceAssignment $deviceAssignment): ?bool
    {
        return $deviceAssignment->delete();
    }

    public function findByEmployeeId($employeeId): Collection
    {
        return DeviceAssignment::query()->where('employee_id', $employeeId)->with('device')->get();
    }

    public function findByDeviceId($deviceId): Collection
    {
        return DeviceAssignment::query()->where('device_id', $deviceId)->with('employee')->get();
    }

    public function findByEmployeeAndDeviceId($employeeId, $deviceId): ?DeviceAssignment
    {
        return DeviceAssignment::query()
            ->where('employee_id', $employeeId)
            ->where('device_id', $deviceId)
            ->first();
    }


}
