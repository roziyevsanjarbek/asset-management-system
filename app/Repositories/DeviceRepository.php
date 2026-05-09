<?php

namespace App\Repositories;

use App\Models\Device;
use Illuminate\Database\Eloquent\Collection;

class DeviceRepository
{

    public function getAll(): Collection
    {
        return Device::query()->get();
    }

    public function create(array $data)
    {
        return Device::query()->create($data);
    }

    public function find($id): \Illuminate\Database\Eloquent\Model|Device|Collection|null
    {
        return Device::query()->find($id);
    }

    public function update(Device $device, array $data): Device
    {
        $device->update($data);
        return $device;
    }

    public function delete(Device $device): ?bool
    {
        return $device->delete();
    }
}
